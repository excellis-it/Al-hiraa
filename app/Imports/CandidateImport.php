<?php

namespace App\Imports;

use App\Models\Candidate;
use App\Models\CandidateActivity;
use App\Models\CandidateFieldUpdate;
use App\Models\CandidateLicence;
use App\Models\CandidatePosition;
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
            // '*.dob' => 'required',
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
            $candidate->last_update_date = ($row['last_update_date'] != null) ?  date('Y-d-m', strtotime($row['last_update_date'])) : '';
            $candidate->full_name = $row['full_name'] ?? '';
            $candidate->gender = $row['gender'] ?? '';
            $candidate->date_of_birth = date('Y-d-m', strtotime($row['dob'])) ?? '';
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
            $candidate->english_speak = $row['english_speak'] ?? '';
            $candidate->arabic_speak = $row['arabic_speak'] ?? '';
            $candidate->return = ($row['return'] == 'Yes') ? 1 : 0;
            $candidate->indian_exp = $row['indian_exp'] ?? '';
            $candidate->abroad_exp = $row['abroad_exp'] ?? '';

            $position_1_count = CandidatePosition::where('id', $row['position_applied_for_1'])->count();
            $position_2_count = CandidatePosition::where('id', $row['position_applied_for_2'])->count();
            $position_3_count = CandidatePosition::where('id', $row['position_applied_for_3'])->count();

            if ($row['position_applied_for_1']) {
                if ($position_1_count > 0) {
                    $candidate->position_applied_for_1 = $row['position_applied_for_1'];
                } else {
                    $second_position_1_count = CandidatePosition::where('name', $row['position_applied_for_1'])->count();
                    if ($second_position_1_count > 0) {
                        $candidate->position_applied_for_1 = CandidatePosition::where('name', $row['position_applied_for_1'])->first()->id;
                    } else {
                        $candidate_position_1 = new CandidatePosition();
                        $candidate_position_1->user_id = Auth::user()->id;
                        $candidate_position_1->name = $row['position_applied_for_1'];
                        $candidate_position_1->is_active = 0;
                        $candidate_position_1->save();
                        $candidate->position_applied_for_1 = $candidate_position_1->id;
                    }
                }
            } else {
                $candidate->position_applied_for_1 = null;
            }

            if ($row['position_applied_for_2']) {
                if ($position_2_count > 0) {
                    $candidate->position_applied_for_2 = $row['position_applied_for_2'];
                } else {
                    $second_position_2_count = CandidatePosition::where('name', $row['position_applied_for_2'])->count();
                    if ($second_position_2_count > 0) {
                        $candidate->position_applied_for_2 = CandidatePosition::where('name', $row['position_applied_for_2'])->first()->id;
                    } else {
                        $candidate_position_2 = new CandidatePosition();
                        $candidate_position_2->user_id = Auth::user()->id;
                        $candidate_position_2->name = $row['position_applied_for_2'];
                        $candidate_position_2->is_active = 0;
                        $candidate_position_2->save();
                        $candidate->position_applied_for_2 = $candidate_position_2->id;
                    }
                }
            } else {
                $candidate->position_applied_for_2 = null;
            }

            if ($row['position_applied_for_3']) {
                if ($position_3_count > 0) {
                    $candidate->position_applied_for_3 = $row['position_applied_for_3'];
                } else {
                    $second_position_3_count = CandidatePosition::where('name', $row['position_applied_for_3'])->count();
                    if ($second_position_3_count > 0) {
                        $candidate->position_applied_for_3 = CandidatePosition::where('name', $row['position_applied_for_3'])->first()->id;
                    } else {
                        $candidate_position_3 = new CandidatePosition();
                        $candidate_position_3->user_id = Auth::user()->id;
                        $candidate_position_3->name = $row['position_applied_for_3'];
                        $candidate_position_3->is_active = 0;
                        $candidate_position_3->save();
                        $candidate->position_applied_for_3 = $candidate_position_3->id;
                    }
                }
            } else {
                $candidate->position_applied_for_3 = null;
            }

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
}
