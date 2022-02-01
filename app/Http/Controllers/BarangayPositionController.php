<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\BarangayPosition;

class BarangayPositionController extends Controller
{



    public function list(Request $request){

        $barangayData = BarangayPosition::all();


        return customResponse()
            ->message("Barangay position list")
            ->data($barangayData)
            ->success()
            ->generate();

    }


}
