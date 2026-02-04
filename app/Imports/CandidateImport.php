<?php

namespace App\Imports;

use App\Models\Candidate;
use App\Models\CandidateActivity;
use App\Models\CandidateFieldUpdate;
use App\Models\CandidateLicence;
use App\Models\City;
use App\Models\CandidatePosition;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
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

        $rows = $rows->filter(function ($row) {
            return array_filter($row->toArray());
        });

        $cleanedRows = $rows->map(function ($row) {
            $row['dob'] = $this->formatExcelDate($row['dob']);
            $row['last_update_date'] = $this->formatExcelDate($row['last_update_date']);
            return $row;
        });
        // dd(($rows));
        Validator::make($cleanedRows->toArray(), [
            '*.full_name' => 'required',
            '*.dob' => 'required|date|before:today',
            '*.contact_no' => 'required|numeric|unique:candidates|digits:10',
            '*.email' => 'nullable|email|unique:candidates',
            '*.position_applied_for_1' => 'required',
            '*.whatapp_no' => 'nullable|digits:10|numeric',

        ])->validate();


        foreach ($rows as $row) {
            // get state from city
            $city = City::whereRaw('LOWER(TRIM(name)) = ?', [strtolower(trim($row['city']))])->first();
            $state_id = $city ? $city->state_id : null;
            $city_id = $city ? $city->id : null;

            $candidate = new Candidate();
            $candidate->enter_by = Auth::user()->id;
            $candidate->cnadidate_status_id = 1;
            $candidate->mode_of_registration = $row['mode_of_registration'] ?? '';
            $candidate->source = $row['source'] ?? '';
            $candidate->referred_by = $row['referred_by'] ?? '';
            $candidate->last_update_date = $this->formatExcelDate($row['last_update_date'] ?? null) ;
            $candidate->full_name = $row['full_name'] ?? '';
            $candidate->gender = $row['gender'] ?? '';
            $dob = $this->formatExcelDate($row['dob'] ?? null); // Safely format DOB

            $candidate->date_of_birth = $dob;

            if ($dob) {
                try {
                    $candidate->age = \Carbon\Carbon::parse($dob)->age;
                } catch (\Exception $e) {
                    $candidate->age = null; // Fallback if parsing fails
                }
            } else {
                $candidate->age = null;
            }

            $candidate->education = $row['education'] ?? '';
            $candidate->other_education = $row['other_education'] ?? '';
            $candidate->contact_no = $row['contact_no'] ?? '';
            $candidate->alternate_contact_no = $row['alternate_contact_no'] ?? '';
            $candidate->email = $row['email'] ?? '';
            $candidate->whatapp_no = $row['whatapp_no'] ? '+91'.$row['whatapp_no'] : '';
            $candidate->state_id = $state_id ?? null;
            $candidate->city = $city_id ?? null;
            $candidate->religion = $row['religion'] ?? '';
            $candidate->ecr_type = $row['ecr_type'] ?? '';
            $candidate->english_speak = $row['english_speak'] ?? '';
            $candidate->arabic_speak = $row['arabic_speak'] ?? '';
            $candidate->return = ($row['return'] == 'Yes') ? 1 : 0;
            $candidate->indian_exp = $row['indian_exp'] ?? '';
            $candidate->abroad_exp = $row['abroad_exp'] ?? '';



            // Assigning all 3 positions:
            $candidate->position_applied_for_1 = $this->resolvePositionId($row['position_applied_for_1'] ?? null);
            $candidate->position_applied_for_2 = $this->resolvePositionId($row['position_applied_for_2'] ?? null);
            $candidate->position_applied_for_3 = $this->resolvePositionId($row['position_applied_for_3'] ?? null);


            $candidate->passport_number = $row['passport_number'] ?? '';
            $candidate->save();

            if ($row['remark']) {
                $candidate_activity = new CandidateActivity();
                $candidate_activity->candidate_id = $candidate->id;
                $candidate_activity->user_id = Auth::user()->id;
                $candidate_activity->remarks = $row['remark'] ?? '';
                $candidate_activity->call_status = '';
                $candidate_activity->save();
            }

            if ($row['international_driving_license']) {
                $candidate_licence = new CandidateLicence();
                $candidate_licence->candidate_id = $candidate->id;
                $candidate_licence->licence_type = 'gulf';
                $candidate_licence->licence_name = $row['international_driving_license'] ?? '';
                $candidate_licence->save();
            }

            if ($row['indian_driving_license']) {
                $candidate_licence = new CandidateLicence();
                $candidate_licence->candidate_id = $candidate->id;
                $candidate_licence->licence_type = 'indian';
                $candidate_licence->licence_name = $row['indian_driving_license'] ?? '';
                $candidate_licence->save();
            }

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

    public function resolvePositionId($input)
    {
        if (is_numeric($input)) {
            // Check if position with given ID exists
            return CandidatePosition::where('id', $input)->exists() ? (int) $input : null;
        }

        if (is_string($input) && trim($input) !== '') {
            $normalized = trim(strtolower($input));

            $existing = CandidatePosition::whereRaw('LOWER(TRIM(name)) = ?', [$normalized])->first();
            if ($existing) {
                return $existing->id;
            }

            // Create new position
            $new = new CandidatePosition();
            $new->user_id = Auth::id();
            $new->name = $input; // Keep original case
            $new->is_active = 0;
            $new->save();

            return $new->id;
        }

        return null;
    }

    private function formatExcelDate($value)
    {
        if (empty($value)) {
            return null;
        }

        if (is_numeric($value)) {
            try {
                return Date::excelToDateTimeObject($value)->format('d-m-Y');
            } catch (\Exception $e) {
                return null;
            }
        }

        try {
            return \Carbon\Carbon::parse($value)->format('d-m-Y');
        } catch (\Exception $e) {
            return null;
        }
    }
}
