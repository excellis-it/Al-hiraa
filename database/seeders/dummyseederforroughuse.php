<?php

namespace Database\Seeders;

use App\Models\CandidateJob;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class dummyseederforroughuse extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = CandidateJob::get();
        foreach ($jobs as $key => $job) {
            // dd($job->jobTitle);
            if (isset($job->jobTitle->vendor_id)) {
                if ($job->jobTitle->vendor_id) {
                    $vendor = User::where('id', $job->jobTitle->vendor_id)->first();
                } else {
                    $vendor = null;
                }
                $job->vendor_id = $job->jobTitle->vendor_id ?? null;
                $job->vendor_service_charge = $vendor->vendor_service_charge ?? null;
                $job->save();
            }
        }
    }
}
