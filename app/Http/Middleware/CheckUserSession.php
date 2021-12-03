<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use App\Models\SessionToken;
use Session;

class CheckUserSession
{

    public function handle($request, Closure $next)
    {

        $data = SessionToken::where("user_id",Auth::user()->id)->first();

        $sessionid = Session::getId();
        $token = $request->bearerToken();


        if (!($data->session_id==$sessionid && $token == $data->token)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        return $next($request);
    }

}
