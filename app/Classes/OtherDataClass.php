<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\OtherData;
use App\Models\OtherDataLanguage;
use App\Models\User;

class OtherDataClass
{
    public function saveOtherData($request) {
        $user = $request->user();
        if (!empty($request->user_id)) {
            $user = User::find($request->user_id);
        }

        $otherData = $user->otherData;
        if (empty($otherData)) {
            $otherData = new OtherData;
            $otherData->user_id = $user->id;
        }

        $otherData->ethnicity_id = $request->ethnicity_id;
        $otherData->disabled = $request->disabled;
        $otherData->disability_id = $request->disability_id;
        $otherData->save();

        $this->saveOtherDataLanguage($request->language, $otherData);
    }

    protected function saveOtherDataLanguage($languageArray, $otherData) {
        OtherDataLanguage::where("other_data_id", $otherData->id)->each(function($row) {
            $row->delete();
        });

        foreach ($languageArray as $key => $value) {
            $otherDataLanguage = new OtherDataLanguage;
            $otherDataLanguage->other_data_id = $otherData->id;
            $otherDataLanguage->language_id = $value;
            $otherDataLanguage->save();
        }
    }
}
