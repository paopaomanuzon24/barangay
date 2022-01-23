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

use App\Models\DocumentData;
use App\Models\DocumentFile;
use App\Models\User as UserModel;

class DocumentDataController extends Controller
{
    public function getDocumentData(Request $request, $id) {
        $documentData = DocumentData::select(
            'document_data.id',
            'document_data.user_id',
            'document_data.document_id'
        )
        ->with("documentFileData")
        ->find($id);

        if (empty($documentData)) {
            return customResponse()
                ->message("No data.")
                ->data(null)
                ->failed()
                ->generate();
        }

        return customResponse()
            ->message("Document data.")
            ->data($documentData)
            ->success()
            ->generate();
    }

    public function list(Request $request, $id) {
        $userData = UserModel::find($id);
        if (empty($userData)) {
            return customResponse()
                ->message("No data")
                ->data(null)
                ->failed()
                ->generate();
        }

        $documentDataList = DocumentData::select(
            'document_data.id',
            'document_data.user_id',
            'document_data.document_id',
            'documents.description as document_desc'
        )
        ->join("documents", "documents.id", "document_data.document_id")
        ->where("document_data.user_id", $userData->id)
        ->with("documentFileData")
        ->paginate(
            (int) $request->get('per_page', 10),
            ['*'],
            'page',
            (int) $request->get('page', 1)
        );

        return customResponse()
            ->message("Document data.")
            ->data($documentDataList)
            ->success()
            ->generate();
    }

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

    public function destroy(Request $request, $id) {
        $documentData = DocumentData::find($id);

        if (!empty($documentData)) {
            $documentData->delete();
            return customResponse()
                ->data(null)
                ->message('Record has been deleted.')
                ->success()
                ->generate();
        }

        return customResponse()
            ->message("No data.")
            ->data(null)
            ->failed()
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
