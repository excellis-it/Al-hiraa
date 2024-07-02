<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feed;
use App\Models\FeedFile;
use App\Models\FeedLike;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            $feeds = Feed::orderBy('id', 'desc')
                    ->with([
                        'feedFiles' => function ($query) {
                            $query->select('id', 'feed_id', 'file_name');
                        },
                        'author' => function ($query) {
                            $query->select('id', 'first_name', 'last_name', 'profile_picture'); 
                        }
                    ])
                    ->withCount('feedLikes') // This will add a `feed_likes_count` attribute to each Feed model instance
                    ->get();
            return response()->json(['message' => 'Feed listed successfully.','status' => true, 'data' => $feeds], 200);
        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Feed Like
     * 
     * This endpoint will be used to like or dislike the feed.
     * @bodyParam feed_id string required Feed id of the user. Example: 100
     * @bodyParam is_like boolean required Like or dislike the feed. Example: 1
     * @response {
     * "message": "Feed changed successfully."
     * 'status': true
     * }
     * 
     */

    public function feedLike(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'feed_id' => 'required|exists:feeds,id',
            'is_like' => 'required|boolean',
        ]);
        
        try{
            $feedId = $request->feed_id;
            $isLike = $request->is_like;

            $feedLike = FeedLike::where('feed_id', $feedId)->where('member_id', Auth::user()->id)->first();

            if($feedLike){
                $feedLike->is_like = $isLike;
                $feedLike->save();
            }else{
                $feedLike = new FeedLike();
                $feedLike->feed_id = $feedId;
                $feedLike->member_id = Auth::user()->id;
                $feedLike->is_like = $isLike;
                $feedLike->save();
            }

            return response()->json(['message' => 'Feed changed successfully.','status' => true, 'is_liked' => $feedLike->is_like ], 200);

        }catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
