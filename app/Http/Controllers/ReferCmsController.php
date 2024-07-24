<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferCms;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Storage;

class ReferCmsController extends Controller
{
    //
    use ImageTrait;


    public function referCmsView()
    {
        $referCms = ReferCms::first();
        return view('settings.refer-cms.edit', compact('referCms'));
    }

    public function referCmsUpdate(Request $request)
    {
        //validation
        $request->validate([
            'main_title' => 'required',
            'small_description' => 'required',
            'small_description2' => 'required',
            'content1_title' => 'required',
            'content1_description' => 'required',
            'content2_title' => 'required',
            'content2_description' => 'required',
            'content3_title' => 'required',
            'content3_description' => 'required',
        ]);

        $referCmsUpdate = ReferCms::where('id', $request->id)->first();
        $referCmsUpdate->main_title = $request->main_title;
        $referCmsUpdate->small_description = $request->small_description;
        $referCmsUpdate->small_description2 = $request->small_description2;
        $referCmsUpdate->content1_title = $request->content1_title;
        $referCmsUpdate->content1_description = $request->content1_description;
        $referCmsUpdate->content2_title = $request->content2_title;
        $referCmsUpdate->content2_description = $request->content2_description;
        $referCmsUpdate->content3_title = $request->content3_title;
        $referCmsUpdate->content3_description = $request->content3_description;

        //image upload

        if ($request->hasFile('image')) {
            if ($referCmsUpdate->image) {
                $currentImageFilename = $referCmsUpdate->image; // get current image name
                Storage::delete('app/'.$currentImageFilename);
            }
            $referCmsUpdate->image = $this->imageUpload($request->file('image'), 'refers');
        }

        if ($request->hasFile('content1_image')) {
            if ($referCmsUpdate->content1_image) {
                $currentImageFilename1 = $referCmsUpdate->content1_image; // get current image name
                Storage::delete('app/'.$currentImageFilename1);
            }
            $referCmsUpdate->content1_image = $this->imageUpload($request->file('content1_image'), 'refers');   
        }

        if ($request->hasFile('content2_image')) {
            if ($referCmsUpdate->content2_image) {
                $currentImageFilename2 = $referCmsUpdate->content2_image; // get current image name
                Storage::delete('app/'.$currentImageFilename2);
            }
            $referCmsUpdate->content2_image = $this->imageUpload($request->file('content2_image'), 'refers');   
        }

        if ($request->hasFile('content3_image')) {
           
            $referCmsUpdate->content3_image = $this->imageUpload($request->file('content3_image'), 'refers');   
        }
        $referCmsUpdate->update();
        
        return redirect()->back()->with('success', 'Refer CMS updated successfully');
    }
}
