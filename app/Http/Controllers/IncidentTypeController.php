<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;
use App\Models\IncidentType;

class IncidentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'description' => 'required'
        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $store = new IncidentType;
        $store->description = $request->description;
        $store->save();

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'description' => 'required'
        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $update = IncidentType::find($id);
        if (empty($update)) {
            return customResponse()
                ->data(null)
                ->message("No data.")
                ->failed()
                ->generate();
        }

        $update->description = $request->description;
        $update->save();

        return customResponse()
            ->data(null)
            ->message('Record has been updated.')
            ->success()
            ->generate();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = IncidentType::find($id);
        if (empty($destroy)) {
            return customResponse()
                ->data(null)
                ->message("No data.")
                ->failed()
                ->generate();
        }

        $destroy->delete();

        return customResponse()
            ->data(null)
            ->message('Record has been deleted.')
            ->success()
            ->generate();
    }
}
