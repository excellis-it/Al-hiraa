<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Transformers\JobTransformer;
use Illuminate\Http\Request;
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
            $fractal = new Manager();
            $limit = $request->limit ?? 10;
            $offset = $request->offset ?? 0;

            $count = Job::where('status', 'Ongoing')->orderBy('id', 'desc')->count();
            if ($count > 0) {
                $jobs = Job::query();
                if ($request->job_search) {
                    $jobs = $jobs->where('job_name', 'like', '%' . $request->job_search . '%');
                }

                if ($request->location_search) {
                    $jobs = $jobs->whereHas('city', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->location_search . '%');
                    })->orWhereHas('state', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->location_search . '%');
                    });
                }
                $jobs = $jobs->where('status', 'Ongoing')->orderBy('id', 'desc')->offset($offset)->limit($limit)->get();
                $resource = new Collection($jobs, new JobTransformer());
                $transformedJobs = $fractal->createData($resource)->toArray()['data'];
                return response()->json(['message' => 'Jobs listed successfully.', 'status' => true, 'data' => $transformedJobs], 200);
            } else {
                return response()->json(['message' => 'Failed to list jobs.', 'status' => false], 201);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }
}
