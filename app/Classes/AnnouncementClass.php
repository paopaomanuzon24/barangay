<?php

namespace App\Classes;

use Helpers;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

use App\Models\AnnouncementImage;
use App\Models\Announcement;
use App\Models\User;

class AnnouncementClass
{
    public function announcementList($request) {
        $announcementList = Announcement::select(
            'announcements.id',
            'announcements.barangay_id',
            'announcements.barangay_desc',
            'announcements.tag',
            'announcements.embedded',
            'announcements.title',
            'announcements.content',
            'announcements.pinned',
            'announcements.is_city_hall',
            DB::raw(
                'CONCAT(users.first_name, " ", users.last_name) AS created_by'
            ),
            'announcements.created_at'
        )
        ->join("users", "users.id", "announcements.created_by")
        ->with(['images']);
        // ->leftJoin("barangays", "barangays.id", "announcements.barangay_id");

        if ($request->search) {
            $announcementList = $announcementList->where(function($q) use($request){
                $q->orWhereRaw("announcements.title LIKE ?","%".$request->search."%");
                $q->orWhereRaw("announcements.content LIKE ?","%".$request->search."%");
                $q->orWhereRaw("CONCAT_WS(' ',CONCAT(users.last_name,','),users.first_name,users.first_name) LIKE ?","%".$request->search."%");
            });
        }

        if ($request->barangay_id) {
            $announcementList = $announcementList->whereRaw('FIND_IN_SET(?,announcements.barangay_id)', [$request->barangay_id]);
        }

        $announcementList = $announcementList->paginate(
            (int) $request->get('per_page', 10),
            ['*'],
            'page',
            (int) $request->get('page', 1)
        );

        return $announcementList;
    }

    public function displayAnnouncement($request) {
        $userData = $request->user();

        $announcementList = Announcement::select(
            'announcements.id',
            'announcements.barangay_id',
            'announcements.barangay_desc',
            'announcements.tag',
            'announcements.embedded',
            'announcements.title',
            'announcements.content',
            'announcements.pinned',
            'announcements.is_city_hall',
            DB::raw(
                'CONCAT(users.first_name, " ", users.last_name) AS created_by'
            ),
            'announcements.created_at'
        )
        ->join("users", "users.id", "announcements.created_by")
        ->with(['images'])
        ->orderBy("announcements.pinned", "desc")
        ->orderBy("announcements.id", "desc");

        if (!empty($userData->barangay_id)) {
            $announcementList = $announcementList->where(function($query) use($userData){
                $query->whereNull("announcements.barangay_id");
                $query->orWhereRaw('FIND_IN_SET(?,announcements.barangay_id)', [$userData->barangay_id]);
            });
        }

        $announcementList = $announcementList->paginate(
            (int) $request->get('per_page', 10),
            ['*'],
            'page',
            (int) $request->get('page', 1)
        );

        return $announcementList;
    }

    public function displayCHAnnouncement($request) {
        $userData = $request->user();

        $announcementList = Announcement::select(
            'announcements.id',
            'announcements.barangay_id',
            'announcements.barangay_desc',
            'announcements.tag',
            'announcements.embedded',
            'announcements.title',
            'announcements.content',
            'announcements.pinned',
            'announcements.is_city_hall',
            DB::raw(
                'CONCAT(users.first_name, " ", users.last_name) AS created_by'
            ),
            'announcements.created_at'
        )
        ->join("users", "users.id", "announcements.created_by")
        ->where("announcements.is_city_hall", 1)
        ->with(['images'])
        ->orderBy("announcements.pinned", "desc")
        ->orderBy("announcements.id", "desc");

        if (!empty($userData->barangay_id)) {
            $announcementList = $announcementList->where(function($query) use($userData){
                $query->whereNull("announcements.barangay_id");
                $query->orWhereRaw('FIND_IN_SET(?,announcements.barangay_id)', [$userData->barangay_id]);
            });
        }

        $announcementList = $announcementList->paginate(
            (int) $request->get('per_page', 10),
            ['*'],
            'page',
            (int) $request->get('page', 1)
        );

        return $announcementList;
    }

    public function saveAnnouncement($request) {
        $userData = $request->user();

        $barangayArray = array_filter($request->barangay_id);
        $barangayDescArray = [];
        if (!empty($barangayArray)) {
            if (count($barangayArray) > 0) {
                $barangayList = Helpers::getBarangayList();
                foreach ($barangayArray as $brgyID) {
                    $barangayDescArray[] = $barangayList[$brgyID];
                }
            }
        }
        $tagArray = array_filter($request->tag);

        $barangaySelected = implode($barangayArray, ",");
        $barangayDescSelected = implode($barangayDescArray, ",");
        $tagSelected = implode($tagArray, ",");

        $announcementData = Announcement::find($request->announcement_id);
        if (empty($announcementData)) {
            $announcementData = new Announcement;
        }

        $announcementData->barangay_id = $barangaySelected;
        $announcementData->barangay_desc = $barangayDescSelected;
        $announcementData->tag = $tagSelected;
        $announcementData->title = $request->title;
        $announcementData->content = $request->content;
        $announcementData->embedded = $request->embedded;
        $announcementData->pinned = !empty($request->pinned) ? $request->pinned : 0;
        $announcementData->created_by = $userData->id;
        if ($userData->user_type_id==1) {
            $announcementData->is_city_hall = 1;
        }
        $announcementData->save();

        if ($request->hasFile('img_file')) {
            foreach ($request->file('img_file') as $key => $file) {
                $primaryPath = 'images/announcement';
                $primaryFile = $file;
                $primaryFileName = $primaryFile->getClientOriginalName();
                $primaryFileExtension = $primaryFile->getClientOriginalExtension();
                $newFileName = strtotime($announcementData->created_at) . $announcementData->id . "." . $primaryFileExtension;

                $file->storeAs("public/".$primaryPath, $newFileName);

                $announcementImg = new AnnouncementImage;
                $announcementImg->announcement_id = $announcementData->id;
                $announcementImg->img_path = $primaryPath.'/'.$newFileName;
                $announcementImg->img_name = $newFileName;
                $announcementImg->save();
            }
        }
    }
}
