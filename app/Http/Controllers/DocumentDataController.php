<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Classes\DocumentDataClass;

use App\Models\DocumentFile;
use App\Models\User as UserModel;

class DocumentDataController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'document_file' => 'mimes:jpg,bmp,png,jpeg'
        ]);

        $class = new DocumentDataClass;
        $class->saveDocumentData($request);

        return customResponse()
            ->data(null)
            ->message('Document(s) has been saved.')
            ->success()
            ->generate();
    }

    public function getDocumentData(Request $request, $id) {
        $userData = UserModel::find($id);
        if (empty($userData)) {
            return customResponse()
                ->message("No data")
                ->data(null)
                ->failed()
                ->generate();
        }
        
        $documentData = $userData->documentData;

        return customResponse()
            ->message("Document data.")
            ->data($userData)
            ->success()
            ->generate();
    }

    public function getDocumentFileList(Request $request) {
        $documentList = DocumentFile::select(
            'id',
            'type',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of documents.")
            ->data($documentList)
            ->success()
            ->generate();
    }
}
