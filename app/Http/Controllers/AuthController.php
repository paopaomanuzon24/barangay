<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Hash;
use Validator;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Classes\UserActivityLogClass;
use Session;

use App\Models\SessionToken;


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
            'password' => Hash::make($request->password)
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

    public function user(Request $request){
        return response()->json($request->user());
    }


}
