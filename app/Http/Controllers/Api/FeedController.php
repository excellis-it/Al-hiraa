<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feed;
use App\Models\FeedFile;
use Illuminate\Support\Facades\Auth;

/**
 * @group Feed
 */

class FeedController extends Controller
{

    protected $successStatus = 200;

    /**
     * Feed List
     * 
     * This endpoint will be used to list all the feeds.
     * @response {
     * "message": "Feed listed successfully."
     * }
     * 
     */

    public function feedList(Request $request)
    {
        try{

            $feeds = Feed::orderBy('id','desc')->with('feedFiles')->get();
            return response()->json(['message' => 'Feed listed successfully.','status' => true, 'data' => $feeds], 200);

        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
        
    }
}
