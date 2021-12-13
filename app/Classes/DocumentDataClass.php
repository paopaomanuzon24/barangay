<?php

namespace App\Classes;

use Carbon\Carbon;

use App\Models\DocumentData;
use App\Models\User;

class DocumentDataClass
{
    public function saveDocumentData($request) {
        $userData = $request->user();
        if (!empty($request->user_id)) {
            $userData = User::find($request->user_id);
        }

        DocumentData::where("user_id", $userData->id)->where("status_id", "")->each(function($row){
            $row->delete();
        });

        $fileArray = $request->file("document_file");

        if ($request->hasFile('document_file')) {
            foreach ($fileArray as $key => $file) {
                $document = new DocumentData;

                $path = 'images/documents';

                $image = $file;
                $imageName = $image->getClientOriginalName();

                $file->storeAs("public/".$path,$imageName);
                
                $document->user_id = $userData->id;
                $document->document_id = $request->document_id[$key];
                $document->path_name = $path.'/'.$imageName;
                $document->file_name = $imageName;
                $document->save();
            }
        }
    }
}
