<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\User;

class UserClass
{
    public function getUserList($request) {
        $userList = User::select(
            'id',
            'first_name',
            'middle_name',
            'last_name',
            'barangay_id',
            'user_type_id'
        );

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

        $userList = $userList->get();
        
        return $userList;
    }
}
