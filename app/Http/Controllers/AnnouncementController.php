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

    public function show(Request $request, $id) {
        $announcementData = Announcement::find($id);
        
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
            // 'title' => 'required',
            'tag' => 'required',
            'content' => 'required',
            'img_file' => 'mimes:jpg,bmp,png,jpeg'
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
}
