<?php

namespace App\Imports;

use Hash;
use Throwable;
use App\Models\AddressData;
use App\Models\Barangay;
use App\Models\BarangayIDSequence;
use App\Models\PersonalData;
use App\Models\ResidenceApplication;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToCollection, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure, WithChunkReading
{
    use Importable, SkipsErrors, SkipsFailures;

    public function collection(Collection $rows) {
        foreach ($rows as $row) {
            $user = User::create([
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'email' => $row['email'],
                'contact_no' => $row['contact_no'],
                'gender' => strtoupper($row['gender']),
                'birth_date' => date("Y-m-d", strtotime($row['birth_date'])),
                'address' => $row['full_address'],
                'barangay_id' => $row['barangay_id'],
                'password' => Hash::make($row['last_name']),
                'user_type_id' => $row['user_type_id']
            ]);

            if ($row['user_type_id']==5 && !empty($row['barangay_id'])) {
                $residenceApplication = new ResidenceApplication;
                $residenceApplication->user_id = $user->id;
                $residenceApplication->status_id = 1;
                $residenceApplication->remarks = "";
                $residenceApplication->save();

                $barangay = Barangay::find($row['barangay_id']);
                $brgyIDSequence = BarangayIDSequence::where("barangay_id", $row['barangay_id'])->where("current_year", date('Y'))->first();
                if (empty($brgyIDSequence)) {
                    $brgyIDSequence = new BarangayIDSequence;
                    $brgyIDSequence->barangay_id = $row['barangay_id'];
                    $brgyIDSequence->current_year = date('Y');
                    $brgyIDSequence->sequence = 0;
                }
                $defSeq = "00000000";
                $sequence = $brgyIDSequence->sequence + 1;
                $newSequence = substr($defSeq, strlen($sequence)) . $sequence;
                $brgyIDSequence->sequence = $sequence;
                $brgyIDSequence->save();
                $residentID = $barangay->code . $brgyIDSequence->current_year . $newSequence;

                $personalData = new PersonalData;
                $personalData->user_id = $user->id;
                $personalData->application_id = date("Y") . $residenceApplication->id;
                $personalData->resident_id = $residentID;
                $personalData->last_name = $row['last_name'];
                $personalData->first_name = $row['first_name'];
                $personalData->middle_name = $row['middle_name'];
                $personalData->gender = strtoupper($row['gender']);
                $personalData->birth_date = date("Y-m-d", strtotime($row['birth_date']));
                $personalData->birth_place = $row['birth_place'];
                $personalData->contact_no = $row['contact_no'];
                $personalData->email = $row['email'];
                $personalData->additional_contact_no = $row['additional_contact_no'];
                $personalData->emergency_contact_no = $row['emergency_contact_no'];
                $personalData->save();

                $addressData = new AddressData;
                $addressData->user_id = $user->id;
                $addressData->blk = !empty($row['blk']) ? $row['blk'] : "";
                $addressData->street = !empty($row['street']) ? $row['street'] : "";
                $addressData->barangay_id = !empty($row['barangay_id']) ? $row['barangay_id'] : "";
                $addressData->district = !empty($row['district']) ? $row['district'] : "";
                $addressData->zip_code = !empty($row['zip_code']) ? $row['zip_code'] : "";
                $addressData->full_address = !empty($row['full_address']) ? $row['full_address'] : "";
                $addressData->address_type = 1;
                $addressData->starting_from = "2000-01-01";
                $addressData->primary_id_path = "";
                $addressData->primary_id_name = "";
                $addressData->secondary_id_path = "";
                $addressData->secondary_id_name = "";
                $addressData->save();
            }
        }
    }

    public function rules(): array {
        return [
            '*.email' => ['email', 'unique:users,email']
        ];
    }

    public function chunkSize(): int {
        return 1000;
    }
}
