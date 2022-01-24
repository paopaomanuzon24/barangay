<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PermitType;




use App\Models\PermitPaymentMethod;


class PermitPaymentMethodController extends Controller
{


    public function list(Request $request){


     #   $paymentMethodData = PermitPaymentMethod::all();
        $paymentMethodData = PermitPaymentMethod::where("id",1)->get();




        return customResponse()
            ->data($paymentMethodData)
            ->message("Payment method list.")
            ->success()
            ->generate();
    }




}
