<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CandidateStatus;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;


class CandidateStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = CandidateStatus::orderBy('id','desc')->paginate(10);
        return view('settings.candidate-status.list',compact('statuses'));
    }

    public function statusFilter(Request $request)
    {
        $statuses = CandidateStatus::query();
        if ($request->search) {
            $statuses = $statuses->where('name', 'like', '%' . $request->search . '%');

        }
        $statuses = $statuses->orderBy('id','desc')->paginate(10);
        return response()->json(['view' => view('settings.candidate-status.filter', compact('statuses'))->render()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function statusEdit(string $id)
    {
        $status = CandidateStatus::find($id);
        $edit = true;
        return response()->json(['view' => view('settings.candidate-status.edit', compact('status', 'edit'))->render(), 'status' => 'success']);
    }

    public function statusUpdate(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'color' => 'required',
            'background' => 'required',
        ]);

        $status = CandidateStatus::find($request->id);
        $status->name = $request->name;
        $status->color = $request->color;
        $status->background = $request->background;
        $status->update();

        session()->flash('message', 'Members updated successfully');
        return response()->json(['message' => 'Members updated successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function statusDelete($id)
    {
        $id = Crypt::decrypt($id);
        $status = CandidateStatus::find($id);
        $status->delete();

        return redirect()->back()->with('message', 'Status deleted successfully');
    }
    
}
