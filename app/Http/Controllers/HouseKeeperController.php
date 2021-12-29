<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

use App\Classes\HouseKeeperClass;

class HouseKeeperController extends Controller
{
    public function index(Request $request, $id) {
        $userData = $this->userData($id);
        if (empty($userData)) {
            return customResponse()
                ->message("User not found.")
                ->data(null)
                ->failed()
                ->generate();
        }

        $houseKeeperList = $userData->houseKeeper;

        return customResponse()
            ->message("Housekeeper data.")
            ->data($userData)
            ->success()
            ->generate();
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'house_keeper_type_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'required',
            'contact_no' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $class = new HouseKeeperClass;
        $class->saveHouseKeeper($request);

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate();  
    }
}
