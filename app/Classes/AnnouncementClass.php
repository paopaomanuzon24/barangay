<?php

namespace App\Classes;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

use App\Models\Announcement;
use App\Models\User;

class AnnouncementClass
{
    public function announcementList($request) {
        $announcementList = Announcement::select(
            'announcements.id',
            'announcements.title',
            'announcements.content',
            'announcements.date_from',
            'announcements.date_to',
            'announcements.barangay_id',
            'barangays.description as barangay_desc',
            DB::raw(
                'CONCAT(users.first_name, " ", users.last_name) AS created_by'
            )
        )
        ->join("users", "users.id", "announcements.created_by")
        ->leftJoin("barangays", "barangays.id", "announcements.barangay_id");

        if ($request->search) {
            $announcementList = $announcementList->where(function($q) use($request){
                $q->orWhereRaw("announcements.title LIKE ?","%".$request->search."%");
                $q->orWhereRaw("announcements.content LIKE ?","%".$request->search."%");
                $q->orWhereRaw("CONCAT_WS(' ',CONCAT(users.last_name,','),users.first_name,users.first_name) LIKE ?","%".$request->search."%");
            });
        }

        if ($request->barangay_id) {
            $announcementList = $announcementList->where("announcements.barangay_id", $request->barangay_id);
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
            'announcements.pinned',
            'announcements.title',
            'announcements.content',
            'announcements.img_path',
            'announcements.img_name',
            'announcements.date_from',
            'announcements.date_to',
            'announcements.barangay_id',
            'barangays.description as barangay_desc',
            DB::raw(
                'CONCAT(users.first_name, " ", users.last_name) AS created_by'
            )
        )
        ->join("users", "users.id", "announcements.created_by")
        ->leftJoin("barangays", "barangays.id", "announcements.barangay_id")
        ->orderBy("announcements.pinned", "desc")
        ->orderBy("announcements.id", "desc");

        if (!empty($userData->barangay_id)) {
            $announcementList = $announcementList->where(function($query) use($userData){
                $query->whereNull("announcements.barangay_id");
                $query->orWhere("announcements.barangay_id", $userData->barangay_id);
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

        $announcementData = Announcement::find($request->announcement_id);
        if (empty($announcementData)) {
            $announcementData = new Announcement;
        }

        // if (!empty($request->pinned)) {
        //     $this->removePinned();
        // }

        $announcementData->barangay_id = $request->barangay_id;
        $announcementData->title = $request->title;
        $announcementData->content = $request->content;

        if (!empty($request->date_from) && !empty($request->date_to)) {
            $announcementData->date_from = date("Y-m-d", strtotime($request->date_from));
            $announcementData->date_to = date("Y-m-d", strtotime($request->date_to));
        }

        if ($request->hasFile('img_file')) {
            $primaryPath = 'images/announcement';
            $primaryFile = $request->file("img_file");
            $primaryFileName = $primaryFile->getClientOriginalName();

            $request->file('img_file')->storeAs("public/".$primaryPath, $primaryFileName);

            $announcementData->img_path = $primaryPath.'/'.$primaryFileName;
            $announcementData->img_name = $primaryFileName;
        }

        $announcementData->pinned = $request->pinned;
        $announcementData->created_by = $userData->id;
        $announcementData->save();
    }

    protected function removePinned() {
        $announcementList = Announcement::whereNotNull("pinned")->each(function($row){
            $row->pinned = 0;
            $row->save();
        });
    }
}
