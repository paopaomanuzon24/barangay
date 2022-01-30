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
use App\Models\Country;
use App\Models\Province;
use App\Models\Municipality;

class PersonalDataController extends Controller
{
    public function store(Request $request) {
        $params = [
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
        ];

        if (empty($request->user_id)) {
            $params['email'] = 'required|string|email|unique:users';
        } else {
            $userData = UserModel::find($request->user_id);
            $checkEmail = $userData->email != $request->email ? true : false;
            if ($checkEmail) {
                $emaiLData = UserModel::where("email", $request->email)->first();
                if (!empty($emaiLData)) {
                    $params['email'] = 'required|string|email|unique:users';
                }
            }
        }

        $validator = Validator::make($request->all(), $params);

        if ($validator->fails()) {
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $class = new PersonalDataClass;
        $personalData = $class->savePersonalData($request);

        return customResponse()
            ->data($personalData)
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
    
    public function getCountryList(Request $request) {
        $list = Country::select(
            'id',
            'name'
        )
        ->get();

        return customResponse()
            ->message("List of country.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getProvinceList(Request $request) {
        $list = Province::select(
            'id',
            'description'
        )
        ->orderBy("description", "asc")
        ->get();

        return customResponse()
            ->message("List of province.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getMunicipalityList(Request $request) {
        $list = Municipality::select(
            'id',
            'description'
        )
        ->orderBy("description", "asc")
        ->get();

        return customResponse()
            ->message("List of municipality.")
            ->data($list)
            ->success()
            ->generate();
    }
}
