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

        $data = SessionToken::where("user_id", Auth::user()->id)->first();

        $sessionId = Session::getId();
        $token = $request->bearerToken();

        if (!($data->session_id == $sessionId && $token == $data->token)) {
            return customResponse()
                ->data(null)
                ->message('Unauthorized.')
                ->unauthorized()
                ->generate();
        }

        return $next($request);
    }

}
