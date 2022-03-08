<?php

namespace App\Http\Controllers;

use Helpers;
use Session;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\IncidentData;
use App\Models\IncidentType;
use App\Models\User as UserModel;

use App\Exports\IncidentExport;
use Excel;

class IncidentController extends Controller
{
    public function getIncidentReport(Request $request) {
        $incidents = IncidentType::select(
                'id',
                'description'
            )
            ->get();

        $incidentReport = [];
        foreach ($incidents as $row) {
            $count = IncidentData::where("incident_type_id", $row->id);
            if (!empty($request->barangay_id)) {
                $count = $count->where("barangay_id", $request->barangay_id);
            }
            $count = $count->count();
            $incidentReport[] = array(
                'description' => $row->description,
                'count' => $count
            );
        }

        $countToday = IncidentData::whereDate("created_at", Carbon::now());
            if (!empty($request->barangay_id)) {
                $countToday = $countToday->where("barangay_id", $request->barangay_id);
            }
        $countToday = $countToday->count();
        $incidentReport[] = array(
            'description' => 'Today',
            'count' => $countToday
        );

        $countSolved = IncidentData::where("incident_status_id", "=", 1);
            if (!empty($request->barangay_id)) {
                $countSolved = $countSolved->where("barangay_id", $request->barangay_id);
            }
        $countSolved = $countSolved->count();
        $incidentReport[] = array(
            'description' => 'Solved',
            'count' => $countSolved
        );

        $countActionTaken = IncidentData::where("incident_status_id", "=", 2);
            if (!empty($request->barangay_id)) {
                $countActionTaken = $countActionTaken->where("barangay_id", $request->barangay_id);
            }
        $countActionTaken = $countActionTaken->count();
        $incidentReport[] = array(
            'description' => 'Action Taken',
            'count' => $countActionTaken
        );

        $countPending = IncidentData::where("incident_status_id", "=", 3);
            if (!empty($request->barangay_id)) {
                $countPending = $countPending->where("barangay_id", $request->barangay_id);
            }
        $countPending = $countPending->count();
        $incidentReport[] = array(
            'description' => 'Pending',
            'count' => $countPending
        );

        $countTotal = new IncidentData;
            if (!empty($request->barangay_id)) {
                $countTotal = $countTotal->where("barangay_id", $request->barangay_id);
            }
        $countTotal = $countTotal->count();
        $incidentReport[] = array(
            'description' => 'Total',
            'count' => $countTotal
        );

        return customResponse()
            ->message("Incidents Report.")
            ->data($incidentReport)
            ->success()
            ->generate();
    }
    
    public function countIncident(Request $request) {
        $incidentCount = IncidentData::where("mark_as_read", "!=", 1)->count();
        $display = [
            'notification_count' => $incidentCount
        ];

        return customResponse()
            ->message("Incident Count.")
            ->data($display)
            ->success()
            ->generate();
    }

    public function incidentList(Request $request) {
        $incidentList = IncidentData::select(
            'incident_data.id',
            'incident_data.user_id',
            'incident_data.barangay_id',
            'barangays.description as barangay_desc',
            'users.first_name',
            'users.last_name',
            'users.address',
            'users.contact_no',
            'incident_data.incident_type_id',
            'incident_type.description as incident_type_desc',
            'incident_data.incident_message',
            'incident_data.incident_resolution',
            'incident_data.incident_address',
            'incident_data.incident_latitude',
            'incident_data.incident_longitude',
            'incident_data.created_at as incident_date_reported',
            'incident_data.incident_status_id',
            'incident_status.description as incident_status_desc',
            'incident_data.incident_no',
            'incident_data.incident_date_resolved',
            'incident_data.incident_date_action_taken'
        )
        ->join('users', 'users.id', 'incident_data.user_id')
        ->join('barangays', 'barangays.id', 'incident_data.barangay_id')
        ->join('incident_status', 'incident_status.id', 'incident_data.incident_status_id')
        ->join('incident_type', 'incident_type.id', 'incident_data.incident_type_id');

        if ($request->search) {
            $incidentList = $incidentList->where(function($q) use($request){
                $q->orWhereRaw("CONCAT_WS(' ',CONCAT(last_name,','),first_name,first_name) LIKE ?","%".$request->search."%");
                $q->orWhereRaw("incident_data.incident_no LIKE ?","%".$request->search."%");
            });
        }

        if ($request->incident_type_id) {
            $incidentList = $incidentList->where("incident_data.incident_type_id", $request->incident_type_id);
        }

        if ($request->barangay_id) {
            $incidentList = $incidentList->where("users.barangay_id", $request->barangay_id);
        }

        $incidentList = $incidentList->paginate(
            (int) $request->get('per_page', 10),
            ['*'],
            'page',
            (int) $request->get('page', 1)
        );

        return customResponse()
            ->message("Incident list.")
            ->data($incidentList)
            ->success()
            ->generate();
    }

    public function list(Request $request, $id) {
        $incidentList = IncidentData::select(
            'incident_data.id',
            'incident_data.user_id',
            'incident_data.barangay_id',
            'barangays.description as barangay_desc',
            'users.first_name',
            'users.last_name',
            'users.address',
            'users.contact_no',
            'incident_data.incident_type_id',
            'incident_type.description as incident_type_desc',
            'incident_data.incident_message',
            'incident_data.incident_resolution',
            'incident_data.incident_address',
            'incident_data.incident_latitude',
            'incident_data.incident_longitude',
            'incident_data.created_at as incident_date_reported',
            'incident_data.incident_status_id',
            'incident_status.description as incident_status_desc',
            'incident_data.incident_no',
            'incident_data.incident_date_resolved',
            'incident_data.incident_date_action_taken'
        )
        ->join('users', 'users.id', 'incident_data.user_id')
        ->join('barangays', 'barangays.id', 'incident_data.barangay_id')
        ->join('incident_status', 'incident_status.id', 'incident_data.incident_status_id')
        ->join('incident_type', 'incident_type.id', 'incident_data.incident_type_id')
        ->where("incident_data.user_id", $id);

        if ($request->search) {
            $incidentList = $incidentList->where(function($q) use($request){
                $q->orWhereRaw("incident_data.incident_no LIKE ?","%".$request->search."%");
            });
        }

        if ($request->barangay_id) {
            $incidentList = $incidentList->where("users.barangay_id", $request->barangay_id);
        }

        if ($request->incident_type_id) {
            $userList = $userList->where("incident_data.incident_type_id", $request->incident_type_id);
        }

        $incidentList = $incidentList->paginate(
            (int) $request->get('per_page', 10),
            ['*'],
            'page',
            (int) $request->get('page', 1)
        );

        return customResponse()
            ->message("Incident list.")
            ->data($incidentList)
            ->success()
            ->generate();
    }

    public function show(Request $request, $id) {
        $incidentData = IncidentData::select(
            'incident_data.id',
            'incident_data.user_id',
            'incident_data.barangay_id',
            'barangays.description as barangay_desc',
            'users.first_name',
            'users.last_name',
            'users.address',
            'users.contact_no',
            'incident_data.incident_type_id',
            'incident_type.description as incident_type_desc',
            'incident_data.incident_message',
            'incident_data.incident_resolution',
            'incident_data.incident_address',
            'incident_data.incident_latitude',
            'incident_data.incident_longitude',
            'incident_data.created_at as incident_date_reported',
            'incident_data.incident_status_id',
            'incident_status.description as incident_status_desc',
            'incident_data.incident_no',
            'incident_data.incident_date_resolved',
            'incident_data.incident_date_action_taken'
        )
        ->join('users', 'users.id', 'incident_data.user_id')
        ->join('barangays', 'barangays.id', 'incident_data.barangay_id')
        ->join('incident_status', 'incident_status.id', 'incident_data.incident_status_id')
        ->join('incident_type', 'incident_type.id', 'incident_data.incident_type_id')
        ->find($id);

        if (empty($incidentData)) {
            return customResponse()
                ->message("No data.")
                ->data(null)
                ->failed()
                ->generate();
        }

        return customResponse()
            ->message("Incident data.")
            ->data($incidentData)
            ->success()
            ->generate();
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'barangay_id' => 'required',
            'incident_type_id' => 'required',
            'incident_message' => 'required'
        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $userData = $request->user();
        if (!empty($request->user_id)) {
            $userData = UserModel::find($request->user_id);
        }

        $incidentData = IncidentData::find($request->incident_id);
        if (empty($incidentData)) {
            $incidentData = new IncidentData;
        }

        $incidentData->user_id = $userData->id;
        $incidentData->barangay_id = $request->barangay_id;
        $incidentData->incident_type_id = $request->incident_type_id;
        $incidentData->incident_message = $request->incident_message;
        $incidentData->incident_address = $request->incident_address;
        $incidentData->incident_latitude = $request->incident_latitude;
        $incidentData->incident_longitude = $request->incident_longitude;
        $incidentData->incident_status_id = 3;
        $incidentData->save();

        if (empty($request->incident_id)) {
            $defSeq = "00000000";
            $sequence = substr($defSeq, strlen($incidentData->id)) . $incidentData->id;
            $incidentNo = "#INCDT" . date("Y") . $sequence;

            $incidentData->incident_no = $incidentNo;
            $incidentData->save();
        }

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate(); 
    }

    public function resolution(Request $request, $id) {
        $validator = Validator::make($request->all(),[
            'incident_resolution' => 'required',
            'incident_status_id' => 'required'
        ]);

        if($validator->fails()){
            return customResponse()
                ->data(null)
                ->message($validator->errors()->all()[0])
                ->failed()
                ->generate();
        }

        $incidentData = IncidentData::find($id);

        if (empty($incidentData)) {
            return customResponse()
                ->data(null)
                ->message("No data.")
                ->failed()
                ->generate();
        }
        $incidentData->mark_as_read = 1;
        $incidentData->incident_resolution = $request->incident_resolution;
        $incidentData->incident_status_id = $request->incident_status_id;
        if ($request->incident_status_id==1) {
            $incidentData->incident_date_resolved = date("Y-m-d H:i:s");
        }
        if ($request->incident_status_id==2) {
            $incidentData->incident_date_action_taken = date("Y-m-d H:i:s");
        }
        $incidentData->save();

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate(); 
    }

    public function takeAction(Request $request, $id) {
        $incidentData = IncidentData::find($id);
        if (empty($incidentData)) {
            return customResponse()
                ->data(null)
                ->message("No data.")
                ->failed()
                ->generate();
        }

        $incidentData->mark_as_read = 1;
        $incidentData->incident_status_id = 1;
        $incidentData->incident_date_resolved = date("Y-m-d H:i:s");
        $incidentData->save();

        return customResponse()
            ->data(null)
            ->message('Record has been saved.')
            ->success()
            ->generate(); 
    }

    public function markAsRead(Request $request, $id) {
        $incidentData = IncidentData::find($id);
        if (empty($incidentData)) {
            return customResponse()
                ->message("No data.")
                ->data(null)
                ->failed()
                ->generate();
        }

        $incidentData->mark_as_read = 1;
        $incidentData->save();

        return customResponse()
            ->message("Record has been updated.")
            ->data(null)
            ->success()
            ->generate();
    }

    public function destroy(Request $request, $id) {
        $incidentData = IncidentData::find($id);
        if (empty($incidentData)) {
            return customResponse()
                ->message("No data.")
                ->data(null)
                ->failed()
                ->generate();
        }

        $incidentData->delete();

        return customResponse()
            ->message("Record has been deleted.")
            ->data(null)
            ->success()
            ->generate();
    }

    public function getIncidentTypeList(Request $request) {
        $list = IncidentType::select(
            'id',
            'description'
        )
        ->get();

        return customResponse()
            ->message("List of incident report type.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function getIncidentStatusList(Request $request) {
        $list = Helpers::getIncidentStatusList();

        return customResponse()
            ->message("List of incident status.")
            ->data($list)
            ->success()
            ->generate();
    }

    public function exportIntoExcel(Request $request) {
        $params = $request->input();
        return Excel::download(new IncidentExport($params), 'incident-report.xlsx');
    }

    public function exportIntoCSV(Request $request) {
        $params = $request->input();
        return Excel::download(new IncidentExport($params), 'incident-report.csv');
    }

}
