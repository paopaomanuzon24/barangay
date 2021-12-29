<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function userData($id) {
        $userData = Auth::user();

        if (!empty($id)) {
            $userData = User::find($id);
        }

        return $userData;
    }

    public function validator($request, $params) {
        $response = [
            'status' => false,
            'message' => ""
        ];

        $validator = Validator::make($request->all(), $params);

        if ($validator->fails()) {
            $response['status'] = $validator->fails();
            $response['message'] = $validator->errors()->all()[0];
        }
        
        return $response;
    }
}
