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
use App\Models\User as UserModel;

class HouseKeeperController extends Controller
{
    public function userList(Request $request, $id) {
        $houseKeeperList = HouseKeeper::where("user_id", $id)->get();

        $houseKeeperArray = [
            $id
        ];

        foreach ($houseKeeperList as $row) {
            $houseKeeperArray[] = $row->house_keeper_type_id;
        }

        $userList = UserModel::select(
            'users.id',
            'first_name',
            'middle_name',
            'last_name',
            'barangay_id',
            'barangays.description as barangay_desc',
            'user_type_id',
            'user_type.name as user_type_desc',
            'contact_no',
            'address'
        )
        ->join("barangays", "barangays.id", "users.barangay_id")
        ->join("user_type", "user_type.id", "users.user_type_id");

        if ($request->search) {
            $userList = $userList->where(function($q) use($request){
                $q->orWhereRaw("CONCAT_WS(' ',CONCAT(last_name,','),first_name,first_name) LIKE ?","%".$request->search."%");
            });
        }

        if ($request->barangay_id) {
            $userList = $userList->where("users.barangay_id", $request->barangay_id);
        }

        if ($request->user_type) {
            $userList = $userList->where("users.user_type_id", $request->user_type);
        }

        if (count($houseKeeperArray) > 0) {
            $userList = $userList->whereNotIn("users.id", $houseKeeperArray);
        }

        $userList = $userList->paginate(
            (int) $request->get('per_page', 10),
            ['*'],
            'page',
            (int) $request->get('page', 1)
        );
        
        return customResponse()
            ->message("Family data.")
            ->data($userList)
            ->success()
            ->generate();
    }
    
    public function list(Request $request, $id) {
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
            'house_keeper_data.house_keeper_user_id',
            'house_keeper_data.house_keeper_type_id',
            'house_keeper_type.description as house_keeper_type_desc',
            'users.first_name',
            'users.middle_name',
            'users.last_name',
            'users.birth_date',
            'users.contact_no',
            'users.address'
        )
        ->leftJoin("house_keeper_type", "house_keeper_type.id", "house_keeper_data.house_keeper_type_id")
        ->leftJoin("users", "users.id", "house_keeper_data.house_keeper_user_id")
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

    public function getHouseKeeperData(Request $request, $id) {
        $houseKeeperData = HouseKeeper::select(
            'house_keeper_data.id',
            'house_keeper_data.user_id',
            'house_keeper_data.house_keeper_user_id',
            'house_keeper_data.house_keeper_type_id',
            'house_keeper_type.description as house_keeper_type_desc',
            'users.first_name',
            'users.middle_name',
            'users.last_name',
            'users.birth_date',
            'users.contact_no',
            'users.address'
        )
        ->leftJoin("house_keeper_type", "house_keeper_type.id", "house_keeper_data.house_keeper_type_id")
        ->leftJoin("users", "users.id", "house_keeper_data.house_keeper_user_id")
        ->find($id);

        return customResponse()
            ->message("Housekeeper Data.")
            ->data($houseKeeperData)
            ->success()
            ->generate();
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

    public function destroy(Request $request, $id) {
        $houseKeeperData = HouseKeeper::find($id);
        if (!empty($houseKeeperData)) {
            $houseKeeperData->delete();
            return customResponse()
                ->message("Record has been deleted.")
                ->data(null)
                ->success()
                ->generate();
        }

        return customResponse()
            ->message("No data.")
            ->data(null)
            ->failed()
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
