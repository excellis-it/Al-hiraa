<?php

namespace App\Console\Commands;

use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CloseExpiredJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * php artisan jobs:close-expired
     */
    protected $signature = 'jobs:close-expired';

    /**
     * The console command description.
     */
    protected $description = 'Close ongoing jobs if their interview dates are expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = \Carbon\Carbon::today();

        $jobs = Job::where('status', 'Ongoing')
            ->whereHas('last_interview', function ($query) use ($today) {
                $query->where(function ($q) use ($today) {
                    // Case 1: Both start & end date → check end date
                    $q->whereNotNull('interview_start_date')
                        ->whereNotNull('interview_end_date')
                        ->whereDate('interview_end_date', '<', $today);

                    // Case 2: Only start date exists → check start date
                    $q->orWhere(function ($q2) use ($today) {
                        $q2->whereNotNull('interview_start_date')
                            ->whereNull('interview_end_date')
                            ->whereDate('interview_start_date', '<', $today);
                    });
                });
            })
            ->with('last_interview') // eager load to avoid extra queries
            ->get();

        foreach ($jobs as $job) {
            $expiredDate = $job->last_interview->interview_end_date ?? $job->last_interview->interview_start_date;

            $job->update(['status' => 'Closed']);

            $message = "Job ID {$job->job_id} ({$job->job_name}) expired on {$expiredDate} → status changed to Close at " . now();

            // Show in console
            $this->info($message);

            // Save to Laravel log
            \Log::info($message);
        }

        return 0;
    }
}
