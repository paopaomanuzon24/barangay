<?php

namespace App\Classes;

use App\Models\UserActivityLog;
use Carbon\Carbon;

class UserActivityLogClass
{

    public const EVENT_LOGIN = 'login';
    public const EVENT_LOGOUT = 'logout';
    public const EVENT_RESET = 'reset';
    public const EVENT_FORGOT_PASSWORD = 'forgot';

    public function insert($userId,$eventType){

        $dateNow = Carbon::now();

        $data = array(
            'user_id' => $userId,
            'ip_address' => request()->ip(),
            'event' => $eventType,
            'created_at' => $dateNow
        );

        UserActivityLog::insert($data);
    }
}
