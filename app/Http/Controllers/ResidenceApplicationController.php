<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Classes\ResidenceApplicationClass;

class ResidenceApplicationController extends Controller
{
    public function update(Request $request) {
        $class = new ResidenceApplicationClass;
        $class->updateResidenceApplication($request);

        return response()->json([
            'message' => 'Status has been updated.'
        ], 201);
    }
}
