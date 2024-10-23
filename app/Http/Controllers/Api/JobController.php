<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Transformers\JobTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

/**
 * @group Job
 */
class JobController extends Controller
{
    public $successStatus = 200;

    /**
     * List
     *
     * This endpoint will be used to list all the jobs.
     * @queryParam limit integer Limit of the jobs. Example: 10
     * @queryParam offset integer Offset of the jobs. Example: 0
     * @queryParam job_search string Search by job name. Example: Job Name
     * @queryParam location_search string Search by location. Example: Location
     *
     * @response {
     *  "message": "Jobs listed successfully."
     * }
     */

    public function list(Request $request)
    {
        try {
            $limit = $request->limit ?? 10;
            $offset = $request->offset ?? 0;

            $count = Job::where('status', 'Ongoing')->count();
            if ($count > 0) {
                $jobs = Job::query();

                // Job search filter
                if ($request->job_search) {
                    $jobs = $jobs->where('job_name', 'like', '%' . $request->job_search . '%');
                }

                // Location search filter
                if ($request->location_search) {
                    $jobs = $jobs->where('address', 'like', '%' . $request->location_search . '%');
                }
                $today = date('Y-m-d');
                // Fetch jobs with interviews starting or ending from today onwards
                $jobs = $jobs->with('presentInterview')->whereHas('interviews', function ($query)  use ($today){
                    $query->where(DB::raw('STR_TO_DATE(interview_end_date, "%d-%m-%Y")'), '>=', $today);
                })->where('status', 'Ongoing')->orderBy('id', 'desc')->offset($offset)->limit($limit)->get();

                $jobs = fractal($jobs, new JobTransformer())->toArray()['data'];
                return response()->json(['message' => 'Jobs listed successfully.', 'status' => true, 'data' => $jobs], 200);
            } else {
                return response()->json(['message' => 'No ongoing jobs found.', 'status' => false], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 500);
        }

    }
}
