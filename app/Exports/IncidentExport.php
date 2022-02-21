<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\IncidentData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IncidentExport implements FromCollection, WithHeadings
{
    protected $params;
    
    function __construct($params) {
        $this->params = $params;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $params = $this->params;
        $incidentTypeIDArray = array_filter($params['incident_type_id']);
        $incidentStatusIDArray = array_filter($params['incident_status_id']);
        $barangayIDArray = array_filter($params['barangay_id']);

        $incidentList = IncidentData::select(
            'barangays.description as barangay_desc',
            'incident_data.incident_no',
            'users.first_name',
            'users.last_name',
            'users.address',
            'users.contact_no',
            'incident_type.description as incident_type_desc',
            'incident_data.incident_message',
            'incident_data.incident_address',
            'incident_data.created_at as incident_date_reported',
            'incident_data.incident_date_resolved',
            'incident_status.description as incident_status_desc'
        )
        ->join('users', 'users.id', 'incident_data.user_id')
        ->join('barangays', 'barangays.id', 'incident_data.barangay_id')
        ->join('incident_status', 'incident_status.id', 'incident_data.incident_status_id')
        ->join('incident_type', 'incident_type.id', 'incident_data.incident_type_id')
        ->orderBy('barangays.id', "ASC")
        ->orderBy('incident_data.created_at', "ASC");

        if (count($incidentTypeIDArray) > 0) {
            $incidentList = $incidentList->whereIn('incident_data.incident_type_id', $incidentTypeIDArray);
        }

        if (count($incidentStatusIDArray) > 0) {
            $incidentList = $incidentList->whereIn('incident_data.incident_status_id', $incidentStatusIDArray);
        }

        if (count($barangayIDArray) > 0) {
            $incidentList = $incidentList->whereIn('incident_data.barangay_id', $barangayIDArray);
        }

        if (!empty($params['last_week'])) {
            $lastWeek = Carbon::now()->subDays(7);
            $startOfLastweek = Carbon::now()->subDays(14);

            $incidentList = $incidentList->whereDate('incident_data.created_at', ">=", $startOfLastweek)
                ->whereDate('incident_data.created_at', "<=", $lastWeek);
        }

        if (!empty($params['last_month'])) {
            $start = new Carbon('first day of last month');
            $start->startOfMonth();
            $end = new Carbon('last day of last month');
            $end->endOfMonth();

            $incidentList = $incidentList->whereDate('incident_data.created_at', ">=", $start)
                ->whereDate('incident_data.created_at', "<=", $end);
        }

        if (!empty($params['date_from']) && !empty($params['date_to'])) {
            $from = date('Y-m-d', strtotime($params['date_from']));
            $to = date('Y-m-d', strtotime($params['date_to']));

            $incidentList = $incidentList->whereDate('incident_data.created_at', ">=", $from)
                ->whereDate('incident_data.created_at', "<=", $to);
        }

        $incidentList = $incidentList->get();

        $incidentArray = [];
        foreach ($incidentList as $row) {
            $incidentArray[] = array(
                $row->barangay_desc,
                $row->incident_no,
                $row->first_name,
                $row->last_name,
                $row->address,
                $row->contact_no,
                $row->incident_type_desc,
                $row->incident_message,
                $row->incident_address,
                date('Y-m-d', strtotime($row->incident_date_reported)),
                !empty($row->incident_date_resolved) ? date('Y-m-d', strtotime($row->incident_date_resolved)) : "",
                $row->incident_status_desc
            );
        }

        return collect($incidentArray);
    }

    public function headings():array{
        return [
            'Barangay',
            'Ticket No.',
            'First Name',
            'Last Name',
            'Address',
            'Contact No.',
            'Type',
            'Message',
            'Incident Address',
            'Date Reported',
            'Date Resolved',
            'Status'
        ];
    }
}
