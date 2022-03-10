<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Imports\UsersImport;
use Excel;
use Validator;

class UsersImportController extends Controller
{
    public function store(Request $request) {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        if ($extension!="csv") {
            return customResponse()
                ->data(null)
                ->message("The file must be a file of type: csv.")
                ->failed()
                ->generate();
        }
        
        // Excel::import(new UsersImport, $file);
        // (new UsersImport)->import($file);
        $import = new UsersImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return customResponse()
                ->data($import->failures())
                ->message("The email has already been taken.")
                ->failed()
                ->generate();
        }
        

        return customResponse()
            ->data(null)
            ->message('Excel file imported successfully.')
            ->success()
            ->generate();
    }
}
