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

use App\User;

use App\Classes\UserClass;
use App\Classes\UserActivityLogClass;

use App\Models\SessionToken;
use App\Models\User as UserModel;
use App\Models\Barangay;
use App\Models\UserType;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|string|unique:users',
            'contact_no' => 'required|digits:10',
            'gender' => 'required',
            'address' => 'required|string',
            'barangay_id' => 'required',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        $user = new User([
            'username' => $request->username,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'gender' => strtoupper($request->gender),
            'address' => $request->address,
            'barangay_id' => $request->barangay_id,
            'password' => Hash::make($request->password),
            'user_type_id' => 6
        ]);

        $user->save();

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        $credentials = [
            "username" => $request->username,
            "password" => $request->password
        ];

        if(!Auth::attempt($credentials)) {
            $credentials = [
                "email" => $request->username,
                "password" => $request->password
            ];

            if(!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            }
        }

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');
        $eventType = UserActivityLogClass::EVENT_LOGIN;

        $userActivityLog = new UserActivityLogClass;
        $userActivityLog->insert(Auth::user()->id, $eventType);

        $request->session()->regenerate();

        $params = array(
            'user_id' => Auth::user()->id,
            'session_id' => Session::getId(),
            'token' => $tokenResult->plainTextToken
        );

        SessionToken::insert($params);

        return response()->json([
            'access_token' => $tokenResult->plainTextToken,
            'user' => $user,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                Carbon::now()->addDays(1)
            )->toDateTimeString()
        ]);
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        $request->session()->invalidate();
        $request->user()->sessionToken->delete();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->all()
            ], 400);
        }

        $user = $request->user();
        if (!empty($request->user_id)) {
            $user = UserModel::find($request->user_id);
        }

        if (!(Hash::check($request->old_password, $user->password))) {
            return response()->json([
                'status' => 'error',
                'message' => "Current Password did not match"
            ], 400);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'Password has been changed.'
        ]);
    }

    public function list(Request $request){
        $class = new UserClass;
        $userList = $class->getUserList($request);

        return customResponse()
            ->message("User account list")
            ->data($userList)
            ->success()
            ->generate();
    }

    public function show(Request $request, $id){
        $userData = UserModel::find($id);

        return customResponse()
            ->message("User account data")
            ->data($userData)
            ->success()
            ->generate();
    }

    public function user(Request $request){
        return response()->json($request->user());
    }

    public function getBarangayList(Request $request) {
        $barangayList = Barangay::select(
            "id",
            "description"
        )->get();

        return customResponse()
            ->message("List of barangay")
            ->data($barangayList)
            ->success()
            ->generate();
    }

    public function getUserTypeList(Request $request) {
        $userTypeList = UserType::select(
            "id",
            "name",
            "level"
        )->get();
        
        return customResponse()
            ->message("List of user type")
            ->data($userTypeList)
            ->success()
            ->generate();
    }
}
