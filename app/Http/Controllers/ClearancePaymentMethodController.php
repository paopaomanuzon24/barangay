<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClearancePaymentMethod;

class ClearancePaymentMethodController extends Controller
{

    public function list(Request $request){
        $paymentMethodData = ClearancePaymentMethod::all();

        return customResponse()
            ->data($paymentMethodData)
            ->message("Payment method list.")
            ->success()
            ->generate();
    }
}
