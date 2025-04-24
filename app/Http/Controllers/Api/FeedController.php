<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feed;
use App\Models\FeedFile;
use App\Models\FeedLike;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

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
        try {
            $feeds = Feed::orderBy('id', 'desc')
                ->with([
                    'feedFiles:id,feed_id,file_name',
                    'author:id,first_name,last_name,profile_picture'
                ])
                ->withCount('feedLikes')
                ->get();

            if (auth()->check()) {
                $feeds->each(function ($feed) {
                    $feed->is_liked = $feed->feedLikeCheck()->where('is_like', true)->where('member_id', Auth::id())->exists();

                    // Add encrypted deep link to each feed
                    $encryptedId = Crypt::encryptString($feed->id);
                    $feed->deep_link = url('/feeds/' . $encryptedId);
                });
            } else {
                $feeds->each(function ($feed) {
                    $feed->is_liked = false;

                    // Add encrypted deep link to each feed
                    $encryptedId = Crypt::encryptString($feed->id);
                    $feed->deep_link = url('/feeds/' . $encryptedId);
                });
            }



            return response()->json([
                'message' => 'Feed listed successfully.',
                'status' => true,
                'data' => $feeds
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     *  Single feed list
     */


    public function singleFeed($encryptedId)
    {
        try {
            // Decrypt the encrypted feed ID
            $feedId = Crypt::decryptString($encryptedId);

            // Fetch the feed
            $feed = Feed::with([
                'feedFiles:id,feed_id,file_name',
                'author:id,first_name,last_name,profile_picture'
            ])
                ->withCount('feedLikes')
                ->findOrFail($feedId);

            // Check if the feed is liked
            $feed->is_liked = $feed->feedLikeCheck()->where('is_like', true)->where('member_id', Auth::id())->exists();

            return response()->json([
                'message' => 'Feed retrieved successfully.',
                'status' => true,
                'data' => $feed
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
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

        try {
            $feedId = $request->feed_id;
            $isLike = $request->is_like;

            $feedLike = FeedLike::where('feed_id', $feedId)->where('member_id', Auth::user()->id)->first();

            if ($feedLike) {
                $feedLike->is_like = $isLike;
                $feedLike->save();
            } else {
                $feedLike = new FeedLike();
                $feedLike->feed_id = $feedId;
                $feedLike->member_id = Auth::user()->id;
                $feedLike->is_like = $isLike;
                $feedLike->save();
            }

            return response()->json(['message' => 'Feed changed successfully.', 'status' => true, 'is_liked' => $feedLike->is_like], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Feed Detail
     *
     * This endpoint will be used to get the feed detail.
     * @bodyParam feed_id string required Feed id of the user. Example: 100
     * @response {
     * "message": "Feed detail fetched successfully."
     * 'status': true
     * }
     *
     */


    public function feedDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'feed_id' => 'required|exists:feeds,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 201);
        }

        try {
            $feed = Feed::where('id', $request->feed_id)
                ->with([
                    'feedFiles:id,feed_id,file_name',
                    'author:id,first_name,last_name,profile_picture'
                ])

                ->withCount('feedLikes')
                ->first();

            $feed->is_liked = $feed->feedLikes()->where('is_like', true)->exists();

            return response()->json(['message' => 'Feed detail fetched successfully.', 'status' => true, 'data' => $feed], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
