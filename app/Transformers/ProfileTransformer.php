<?php

namespace App\Transformers;

use App\Models\Candidate;
use League\Fractal\TransformerAbstract;

class ProfileTransformer extends TransformerAbstract
{

    public function transform(Candidate $candidate)
    {
        if ($candidate->referred_by_id != null) {
            $referred_by = $candidate->referredBy->full_name;
        } else {
            $referred_by = $candidate->referred_by;
        }

        return [
            'id' => $candidate->id,
            'full_name' => $candidate->full_name,
            'email' => $candidate->email ?? null,
            'phone' => $candidate->contact_no,
            'enter_by' => $candidate->enterBy->full_name ?? null,
            'status' => $candidate->candidateStatus->name ?? null,
            'passport_no' => $candidate->passport_number ?? null,
            'mode_of_registration' => $candidate->mode_of_registration ?? null,
            'referred_by' => $referred_by ?? null,
            'last_updated_at' => $candidate->updated_at != null ? date('d.m.Y', strtotime($candidate->updated_at)) : '',
            'gender' => $candidate->gender ?? null,
            'dob' => $candidate->date_of_birth != null ? date('d.m.Y', strtotime($candidate->date_of_birth)) : null,
            'age' => $candidate->date_of_birth != null ? date_diff(date_create($candidate->date_of_birth), date_create('now'))->y : null,
            'education' => $candidate->education ?? null,
            'other_education' => $candidate->other_education ?? null,
            'alternate_contact_no' => $candidate->alternate_contact_no ?? null,
            'whatapp_no' => $candidate->whatapp_no ?? null,
            'city' => $candidate->city ?? null,
            'religion' => $candidate->religion ?? null,
            'ecr_type' => $candidate->ecr_type ?? null,
            'english_speak' => $candidate->english_speak ?? null,
            'arabic_speak' => $candidate->arabic_speak ?? null,
            'gulf_return' => $candidate->return ?? null,
            'indian_experience' => $candidate->indian_exp ?? null,
            'gulf_experience' => $candidate->abroad_exp ?? null,
            'poition_applied_for' => $candidate->positionAppliedFor1->name ?? null,
            'position_applied_for_1' => $candidate->positionAppliedFor2->name ?? null,
            'position_applied_for_2' => $candidate->positionAppliedFor3->name ?? null,
            'poition_applied_for_id' => $candidate->position_applied_for_1 ?? null,
            'position_applied_for_1_id' => $candidate->position_applied_for_2 ?? null,
            'position_applied_for_2_id' => $candidate->position_applied_for_3 ?? null,
            'created_at' => $candidate->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
