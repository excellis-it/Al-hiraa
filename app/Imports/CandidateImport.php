<?php

namespace App\Imports;

use App\Models\Candidate;
use App\Models\CandidateFieldUpdate;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class CandidateImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.full_name' => 'required',
            '*.dob' => 'required',
            '*.contact_no' => 'required|numeric|unique:candidates|digits:10',
            '*.email' => 'nullable|email|unique:candidates',
            '*.position_applied_for_1' => 'required',
        ])->validate();
        // dd($rows[0]['last_update_date']);
        foreach ($rows as $row) {
            $candidate = new Candidate();
            $candidate->enter_by = Auth::user()->id;
            $candidate->cnadidate_status_id = 1;
            $candidate->mode_of_registration = $row['mode_of_registration'] ?? '';
            $candidate->source = $row['source'] ?? '';
            $candidate->referred_by = $row['referred_by'] ?? '';
            $candidate->last_update_date = ($row['last_update_date'] != null) ?  date('Y-d-m',strtotime($row['last_update_date'])) : '';
            $candidate->full_name = $row['full_name'] ?? '';
            $candidate->gender = $row['gender'] ?? '';
            $candidate->date_of_birth = date('Y-d-m',strtotime($row['dob'])) ?? '';
            $candidate->age = date_diff(date_create($row['dob']), date_create('today'))->y;
            $candidate->education = $row['education'] ?? '';
            $candidate->other_education = $row['other_education'] ?? '';
            $candidate->contact_no = $row['contact_no'] ?? '';
            $candidate->alternate_contact_no = $row['alternate_contact_no'] ?? '';
            $candidate->email = $row['email'] ?? '';
            $candidate->whatapp_no = $row['whatapp_no'] ?? '';
            $candidate->city = $row['city'] ?? '';
            $candidate->religion = $row['religion'] ?? '';
            $candidate->ecr_type = $row['ecr_type'] ?? '';
            $candidate->indian_driving_license = $row['indian_driving_license'] ?? '';
            $candidate->international_driving_license = $row['international_driving_license'] ?? '';
            $candidate->english_speak = $row['english_speak'] ?? '';
            $candidate->arabic_speak = $row['arabic_speak'] ?? '';
            $candidate->return = ($row['return'] == 'Yes') ? 1 : 0;
            $candidate->indian_exp = $row['indian_exp'] ?? '';
            $candidate->abroad_exp = $row['abroad_exp'] ?? '';
            $candidate->remarks = $row['remark'] ?? '';
            $candidate->position_applied_for_1 = $row['position_applied_for_1'] ?? '';
            $candidate->position_applied_for_2 = $row['position_applied_for_2'] ?? '';
            $candidate->position_applied_for_3 = $row['position_applied_for_3'] ?? '';
            $candidate->save();

            if (isset($row->position_applied_for)) {
                $candidatePosition = new CandidateFieldUpdate();
                $candidatePosition->user_id = Auth::user()->id;
                $candidatePosition->candidate_id = $candidate->id;
                $candidatePosition->status = 1;
                $candidatePosition->save();
            }
        }
    }


    public function headingRow(): int
    {
        return 1;
    }
}
