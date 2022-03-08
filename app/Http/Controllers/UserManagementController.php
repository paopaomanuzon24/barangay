<?php

namespace App\Http\Controllers;

use Hash;
use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Classes\UserManagementClass;

use App\Models\User;
use App\Models\UserAccountStatus;

class UserManagementController extends Controller
{
    public function statusHistory(Request $request, $id) {
        $statusHistoryList = UserAccountStatus::select(
                'user_account_statuses.user_id',
                DB::raw('(CASE WHEN user_account_statuses.is_active = 1 THEN "Activate account" ELSE "Deactivate account" END) AS status'),
                'user_account_statuses.remarks',
                'user_account_statuses.created_at',
                'user_account_statuses.created_by'
            )
            ->where("user_account_statuses.user_id", $id)
            ->with(['userAccount', 'createdBy'])
            ->get();
        return customResponse()
            ->data($statusHistoryList)
            ->message('History')
            ->success()
            ->generate();
    }

    public function show(Request $request, $id) {
        $userData = User::select(
            'id',
            'user_type_id',
            'last_name',
            'first_name',
            'email',
            'contact_no',
            'gender',
            'birth_date',
            'address',
            'barangay_id'
        )->find($id);

        return customResponse()
            ->data($userData)
            ->message('User Data.')
            ->success()
            ->generate();
    }

    public function store(Request $request) {
        $params = [
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email|string',
            // 'contact_no' => 'required|digits:10',
            // 'gender' => 'required',
            // 'birth_date' => 'string',
            // 'address' => 'required|string'
        ];

        if (empty($request->user_id)) {
            $params['email'] = 'required|string|email|unique:users';
            // $params['password'] = 'required|string';
        } else {
            $userData = User::find($request->user_id);
            $checkEmail = $userData->email != $request->email ? true : false;
            if ($checkEmail) {
                $emaiLData = User::where("email", $request->email)->first();
                if (!empty($emaiLData)) {
                    $params['email'] = 'required|string|email|unique:users';
                }
            }
        }

        $validator = Validator::make($request->all(), $params);

        if ($validator->fails()) {
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $class = new UserManagementClass;
        $class->saveUser($request);

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate();
    }

    public function deactivate(Request $request, $id) {
        $userData = User::find($id);
        if (empty($userData)) {
            return customResponse()
                ->data(null)
                ->message("No user found.")
                ->failed()
                ->generate();
        }

        $validator = Validator::make($request->all(),[
            'remarks' => 'required',
        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $userData->is_active = 0;
        $userData->save();

        $this->saveHistory($userData->id, 0, $request->remarks);

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate();
    }

    public function activate(Request $request, $id) {
        $userData = User::find($id);
        if (empty($userData)) {
            return customResponse()
                ->data(null)
                ->message("No user found.")
                ->failed()
                ->generate();
        }

        $validator = Validator::make($request->all(),[
            'remarks' => 'required',
        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $userData->is_active = 1;
        $userData->save();

        $this->saveHistory($userData->id, 1, $request->remarks);

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate();
    }

    private function saveHistory($userID, $status, $remarks) {
        $historyData = new UserAccountStatus;
        $historyData->user_id = $userID;
        $historyData->is_active = $status;
        $historyData->remarks = $remarks;
        $historyData->created_by = Auth::user()->id;
        $historyData->save();
    }

}
