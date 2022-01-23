<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\DocumentData;
use App\Models\DocumentFileData;
use App\Models\User;

use App\Classes\ResidenceApplicationClass;
use App\Classes\PersonalDataClass;

class DocumentDataClass
{
    public function saveDocumentData($request) {
        $userData = $request->user();
        if (!empty($request->user_id)) {
            $userData = User::find($request->user_id);
        }

        $documentData = DocumentData::where("user_id", $userData->id)
            ->where("document_id", $request->document_id)
            ->first();
        if (empty($documentData)) {
            $documentData = new DocumentData;
        }

        $documentData->user_id = $userData->id;
        $documentData->document_id = $request->document_id;
        $documentData->path_name = "";
        $documentData->file_name = "";
        $documentData->save();

        DocumentFileData::where("document_data_id", $documentData->id)->each(function($row){
            $row->delete();
        });

        $fileArray = $request->file("document_file");
        
        if ($request->hasFile('document_file')) {
            foreach ($fileArray as $key => $file) {
                $document = new DocumentFileData;

                $path = 'images/documents';

                $image = $file;
                $imageName = $image->getClientOriginalName();

                $file->storeAs("public/".$path,$imageName);
                
                $document->document_data_id = $documentData->id;
                $document->path_name = $path.'/'.$imageName;
                $document->file_name = $imageName;
                $document->save();
            }
        }

        if (!empty($request->is_residence)) {
            $personalDataClass = new PersonalDataClass;
            $personalDataClass->savePersonalData($request);
        }
    }
}
