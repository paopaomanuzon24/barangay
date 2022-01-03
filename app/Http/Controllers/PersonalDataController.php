<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Classes\PersonalDataClass;

use App\Models\MaritalStatus;
use App\Models\Religious;
use App\Models\Citizenship;
use App\Models\ResidenceStatus;
use App\Models\User as UserModel;

class PersonalDataController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'gender' => 'required',
            'marital_status_id' => 'required',
            'religious_id' => 'required',
            // 'citizenship' => 'required',
            'birth_date' => 'required',
            'birth_place' => 'required',
            'contact_no' => 'required|digits:10',
            'email' => 'required|string|email|confirmed',
        ]);

        if ($validator->fails()) {
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $class = new PersonalDataClass;
        $class->savePersonalData($request);

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate(); 
    }

    public function profile(Request $request) {
        $validator = Validator::make($request->all(), [
            'profile' => 'mimes:jpg,bmp,png,jpeg|required'
        ]);

        $class = new PersonalDataClass;
        $profileData = $class->saveProfile($request);

        return customResponse()
            ->data($profileData)
            ->message('Profile has been saved.')
            ->success()
            ->generate(); 
    }

    public function getProfile(Request $request, $id) {
        $userData = UserModel::find($id);
        if (empty($userData)) {
            return customResponse()
                ->message("No data")
                ->data(null)
                ->failed()
                ->generate();
        }
        
        $personalData = $userData->profilePicture;

        return customResponse()
            ->message("Profile picture.")
            ->data($userData)
            ->success()
            ->generate();
    }

    public function getPersonalData(Request $request, $id) {
        $userData = UserModel::find($id);
        $personalData = $userData->personalData;
        $residenceApplicationStatusData = $userData->residenceApplicationStatus;

        return customResponse()
            ->message("Personal data.")
            ->data($userData)
            ->success()
            ->generate();
    }

    public function getRadioGender(Request $request) {
        return customResponse()
            ->message("List of genders.")
            ->data(Helpers::getRadioGender())
            ->success()
            ->generate();
    }

    public function getRadioCitizen(Request $request) {
        return customResponse()
            ->message("Radio citizen.")
            ->data(Helpers::getRadioCitizen())
            ->success()
            ->generate();
    }
    
    public function getMaritalStatusList(Request $request) {
        $maritalStatusList = MaritalStatus::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of marital status.")
            ->data($maritalStatusList)
            ->success()
            ->generate();
    }
    
    public function getReligiousList(Request $request) {
        $religiousList = Religious::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of religious.")
            ->data($religiousList)
            ->success()
            ->generate();
    }

    public function getCitizenshipList(Request $request) {
        $citizenshipList = Citizenship::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of citizenship.")
            ->data($citizenshipList)
            ->success()
            ->generate();
    }

    public function getResidenceStatusList(Request $request) {
        $statusList = ResidenceStatus::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of residence status.")
            ->data($statusList)
            ->success()
            ->generate();
    }
}
