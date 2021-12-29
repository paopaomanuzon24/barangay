<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Classes\OtherDataClass;

use App\Models\Ethnicity;
use App\Models\Language;
use App\Models\Disability;
use App\Models\User as UserModel;

class OtherDataController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'language' => 'required',
            'disabled' => 'required'
        ]);

        if ($validator->fails()) {
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $class = new OtherDataClass;
        $class->saveOtherData($request);

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate(); 
    }

    public function getOtherData(Request $request, $id) {
        $userData = UserModel::find($id);
        if (empty($userData)) {
            return customResponse()
                ->message("No data")
                ->data(null)
                ->failed()
                ->generate();
        }
        
        $otherData = $userData->otherData;
        $otherDataLanguage = !empty($userData->otherData->language) ? $userData->otherData->language : "";

        return customResponse()
            ->message("Other data.")
            ->data($userData)
            ->success()
            ->generate();
    }

    public function getEthnicityList(Request $request) {
        $ethnicityList = Ethnicity::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of ethnicity.")
            ->data($ethnicityList)
            ->success()
            ->generate();
    }

    public function getLanguageList(Request $request) {
        $languageList = Language::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of language.")
            ->data($languageList)
            ->success()
            ->generate();
    }

    public function getDisabilityList(Request $request) {
        $disabilityList = Disability::get();

        return customResponse()
            ->message("List of disability.")
            ->data($disabilityList)
            ->success()
            ->generate();
    }

}
