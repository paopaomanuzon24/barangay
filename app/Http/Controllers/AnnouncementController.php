<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Classes\AnnouncementClass;

use App\Models\Announcement;
use App\Models\User as UserModel;

class AnnouncementController extends Controller
{
    public function index(Request $request) {
        $class = new AnnouncementClass;
        $announcementList = $class->announcementList($request);

        return customResponse()
            ->data($announcementList)
            ->message('Announcement List.')
            ->success()
            ->generate(); 
    }

    public function display(Request $request) {
        $class = new AnnouncementClass;
        $announcementList = $class->displayAnnouncement($request);

        return customResponse()
            ->data($announcementList)
            ->message('Display Announcement.')
            ->success()
            ->generate(); 
    }

    public function cityHall(Request $request) {
        $class = new AnnouncementClass;
        $announcementList = $class->displayCHAnnouncement($request);

        return customResponse()
            ->data($announcementList)
            ->message('Display City Hall Announcement.')
            ->success()
            ->generate(); 
    }

    public function show(Request $request, $id) {
        $announcementData = Announcement::select(
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
        ->find($id);
        
        if (empty($announcementData)) {
            return customResponse()
                ->data(null)
                ->message("No Data.")
                ->failed()
                ->generate();
        }

        return customResponse()
            ->data($announcementData)
            ->message('Announcement Data.')
            ->success()
            ->generate(); 
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'tag' => 'required',
            'content' => 'required',
            // 'img_file' => 'mimes:jpg,bmp,png,jpeg'
        ]);

        if ($validator->fails()) {
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $class = new AnnouncementClass;
        $class->saveAnnouncement($request);
        
        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate(); 
    }

    public function destroy(Request $request, $id) {
        $announcement = Announcement::find($id);
        if (empty($announcement)) {
            return customResponse()
                ->data(null)
                ->message('No data.')
                ->failed()
                ->generate();
        }

        $announcement->delete();

        return customResponse()
            ->data(null)
            ->message('Record has been deleted.')
            ->success()
            ->generate(); 
    }
}
