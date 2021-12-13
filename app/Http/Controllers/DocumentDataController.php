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

class DocumentDataController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'document_file' => 'mimes:jpg,bmp,png,jpeg|required|array'
        ]);

        $class = new DocumentDataClass;
        $class->saveDocumentData($request);

        return response()->json([
            'message' => 'Document(s) has been saved.'
        ], 201);
    }

    public function getDocumentData(Request $request) {
        $userData = $request->user();
        $documentData = $request->user()->documentData;
        return response()->json($userData);
    }

    public function getDocumentFileList(Request $request) {
        return response()->json(Helpers::getDocumentFileList());
    }
}
