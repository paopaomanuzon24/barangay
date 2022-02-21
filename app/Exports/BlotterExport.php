<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\BlotterAndComplain;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BlotterExport implements FromCollection, WithHeadings
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
        $blotterStatusArray = array_filter($params['blotter_status_id']);
        $barangayIDArray = array_filter($params['barangay_id']);

        $blotterList = BlotterAndComplain::select(
            'blotter_and_complain_data.barangay_id',
            'barangays.description as barangay_desc',
            'blotter_and_complain_data.id as blotter_id',
            'blotter_and_complain_data.blotter_no',
            'blotter_and_complain_data.blotter_complainant_id',
            'blotter_and_complain_data.blotter_complainee_id',
            'blotter_and_complain_data.blotter_address',
            'blotter_and_complain_data.blotter_subject',
            'blotter_and_complain_data.blotter_complaint_content',
            'blotter_and_complain_data.created_at as blotter_date_reported',
            'blotter_and_complain_data.blotter_status_id',
            'blotter_status.description as blotter_status_desc',
            'blotter_and_complain_data.blotter_agreement_content',
            'blotter_and_complain_data.blotter_amount',
            'blotter_and_complain_data.blotter_payment_method_id',
            'permit_payment_method.description as blotter_payment_method_desc',
            'blotter_and_complain_data.blotter_receipt_file_path',
            'blotter_and_complain_data.blotter_receipt_file_name',
            'blotter_and_complain_data.is_waived',
            'blotter_and_complain_data.blotter_waive_reason',
            'blotter_and_complain_data.blotter_date_resolved'
        )
        ->leftJoin('barangays', 'barangays.id', 'blotter_and_complain_data.barangay_id')
        ->leftJoin('blotter_status', 'blotter_status.id', 'blotter_and_complain_data.blotter_status_id')
        ->leftJoin('blotter_type', 'blotter_type.id', 'blotter_and_complain_data.blotter_type_id')
        ->leftJoin('permit_payment_method', 'permit_payment_method.id', 'blotter_and_complain_data.blotter_payment_method_id')
        ->with(['complainantData', 'complaineeData']);

        if (count($blotterStatusArray) > 0) {
            $blotterList = $blotterList->whereIn('blotter_and_complain_data.blotter_status_id', $blotterStatusArray);
        }

        if (count($barangayIDArray) > 0) {
            $blotterList = $blotterList->whereIn('blotter_and_complain_data.barangay_id', $barangayIDArray);
        }

        if (!empty($params['last_week'])) {
            $lastWeek = Carbon::now()->subDays(7);
            $startOfLastweek = Carbon::now()->subDays(14);

            $blotterList = $blotterList->whereDate('blotter_and_complain_data.created_at', ">=", $startOfLastweek)
                ->whereDate('blotter_and_complain_data.created_at', "<=", $lastWeek);
        }

        if (!empty($params['last_month'])) {
            $start = new Carbon('first day of last month');
            $start->startOfMonth();
            $end = new Carbon('last day of last month');
            $end->endOfMonth();

            $blotterList = $blotterList->whereDate('blotter_and_complain_data.created_at', ">=", $start)
                ->whereDate('blotter_and_complain_data.created_at', "<=", $end);
        }

        if (!empty($params['date_from']) && !empty($params['date_to'])) {
            $from = date('Y-m-d', strtotime($params['date_from']));
            $to = date('Y-m-d', strtotime($params['date_to']));

            $blotterList = $blotterList->whereDate('blotter_and_complain_data.created_at', ">=", $from)
                ->whereDate('blotter_and_complain_data.created_at', "<=", $to);
        }

        $blotterList = $blotterList->get();

        $blotterArray = [];
        foreach ($blotterList as $row) {
            $complainant = $row['complainantData']->first_name . " " . $row['complainantData']->last_name;
            $complainee = $row['complaineeData']->first_name . " " . $row['complaineeData']->last_name;
            $blotterArray[] = array(
                $row->barangay_desc,
                $row->blotter_no,
                $complainant,
                $complainee,
                $row->blotter_address,
                $row->blotter_subject,
                $row->blotter_complaint_content,
                $row->blotter_agreement_content,
                date('Y-m-d', strtotime($row->blotter_date_reported)),
                !empty($row->blotter_date_resolved) ? date('Y-m-d', strtotime($row->blotter_date_resolved)) : "",
                $row->blotter_status_desc
            );
        }
        
        return collect($blotterArray);
    }

    public function headings():array{
        return [
            'Barangay',
            'Ticket No.',
            'Complainant',
            'Complainee',
            'Address',
            'Complainant Subject',
            'Facts of the complaint',
            'Resolution and Agreement',
            'Date Reported',
            'Date Resolved',
            'Status'
        ];
    }
}
