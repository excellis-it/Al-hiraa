<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferCms;

class ReferCmsController extends Controller
{
    //

    public function referCmsView()
    {
        $referCms = ReferCms::first();
        return view('settings.refer-cms.edit', compact('referCms'));
    }
}
