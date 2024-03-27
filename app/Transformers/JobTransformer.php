<?php

namespace App\Transformers;

use App\Models\Job;
use League\Fractal\TransformerAbstract;

class JobTransformer extends TransformerAbstract
{

    public function transform(Job $job)
    {
        return [
            'id' => $job->id,
            'company_id' => $job->company_id ?? null,
            'company_name' => $job->company->company_name ?? null,
            'company_logo' => $job->company->company_logo ?? null,
            'position' => $job->candidatePosition->name ?? null,
            'state' => $job->state->name ?? null,
            'city' => $job->city->name ?? null,
            'job_name' => $job->job_name ?? null,
            'duty_hours' => $job->duty_hours ? $job->duty_hours . ' Hours' : null,
            'contract' => $job->contract ? $job->contract . ' Years' : null,
            'benefits' => $job->benefits ?? null,
            'address' => $job->address ?? null,
            'job_description' => $job->job_description ?? null,
            'status' => $job->status ?? null,
            'created_at' => $job->created_at->format('Y-m-d H:i:s'),
        ];
    }

}
