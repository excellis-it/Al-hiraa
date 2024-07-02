<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\FeedFile;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class FeedController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('ADMIN')) {
            $feeds = Feed::orderBy('id', 'desc')->paginate(10);
            return view('settings.feeds.list', compact('feeds'));
        } else {
           return redirect()->back()->with('message', 'Permission denied.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.feeds.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);

        $feed = new Feed();
        $feed->title = $request->title;
        $feed->content = $request->description;
        $feed->author_id = auth()->user()->id;
        $feed->save();

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imagePath = $this->imageUpload($image, 'feeds');
                $feedFile = new FeedFile();
                $feedFile->feed_id = $feed->id;
                $feedFile->file_name = $imagePath;
                $feedFile->save();
            }
        }

        return redirect()->route('feeds.index')->with('message', 'Feed created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $id = Crypt::decrypt($id);
        $feed = Feed::find($id);
        $edit = true;
        return response()->json(['view' => view('settings.feeds.edit', compact('feed','edit'))->render()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $id = Crypt::decrypt($id);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $feed = Feed::find($id);
        $feed->title = $request->title;
        $feed->content = $request->description;

        if($request->hasFile('image')){
            foreach ($request->file('image') as $image) {
                $imagePath = $this->imageUpload($image, 'feeds');
                $feedFile = new FeedFile();
                $feedFile->feed_id = $feed->id;
                $feedFile->file_name = $imagePath;
                $feedFile->save();
            }
        }
        $feed->save();

        session()->flash('message', 'Feeds updated successfully');
        return response()->json(['message' => 'Feeds updated successfully']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function feedDelete(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $feed = Feed::find($id);
        $feed->delete();
        return redirect()->route('feeds.index')->with('message', 'Feed deleted successfully');
    }

    public function feedFilter(Request $request)
    {
        $feeds = Feed::query();

        if ($request->search) {
            $feeds->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%');
        }
        if (!Auth::user()->hasRole('ADMIN')) {
            $feeds->where('author_id', Auth::user()->id);
        }
        $feeds = $feeds->orderBy('id', 'desc')->paginate(10);
        return response()->json(['view' => view('settings.feeds.filter', compact('feeds'))->render()]);
    }

    public function deleteImage(Request $request)
    {
        $feedFile = FeedFile::find($request->id);
        $feedFile->delete();
        return response()->json(['message' => 'Image deleted successfully']);
    }
}
