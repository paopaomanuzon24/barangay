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

class UserManagementController extends Controller
{
    public function store(Request $request) {
        $params = [
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'contact_no' => 'required|digits:10',
            'gender' => 'required',
            'birth_date' => 'string',
            'address' => 'required|string'
        ];

        if (empty($request->user_id)) {
            $params['email'] = 'required|string|unique:users';
            $params['password'] = 'required|string';
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
}
