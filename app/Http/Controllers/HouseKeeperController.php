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

use App\Models\HouseKeeper;
use App\Models\HouseKeeperType;

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

        // $houseKeeperList = $userData->houseKeeper;

        $houseKeeperList = HouseKeeper::select(
            'house_keeper_data.id',
            'house_keeper_data.user_id',
            'house_keeper_data.house_keeper_type_id',
            'house_keeper_type.description as house_keeper_type_desc',
            'house_keeper_data.personal_data_id',
            'personal_data.first_name',
            'personal_data.middle_name',
            'personal_data.last_name',
            'personal_data.birth_date',
            'personal_data.contact_no',
            'address_data.full_address'
        )
        ->leftJoin("house_keeper_type", "house_keeper_type.id", "house_keeper_data.house_keeper_type_id")
        ->leftJoin("users", "users.id", "house_keeper_data.user_id")
        ->where("house_keeper_data.user_id", $userData->id)
        ->paginate(
            (int) $request->get('per_page', 10),
            ['*'],
            'page',
            (int) $request->get('page', 1)
        );

        return customResponse()
            ->message("Housekeeper list.")
            ->data($houseKeeperList)
            ->success()
            ->generate();
    }

    public function list(Request $request) {
        dd($request->input());
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'house_keeper_type_id' => 'required'
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

    public function getHouseKeeperType(Request $request) {
        $list = HouseKeeperType::select(
            "id",
            "description"
        )
        ->get();

        return customResponse() 
            ->message("List of housekeeper type.")
            ->data($list)
            ->success()
            ->generate();
    }
}
