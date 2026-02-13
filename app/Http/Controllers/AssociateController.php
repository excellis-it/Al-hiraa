<?php

namespace App\Http\Controllers;

use App\Models\Associate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class AssociateController extends Controller
{
    /**
     * Display a listing of the associates.
     */
    public function index()
    {
        $associates = Associate::latest()->paginate(10);
        return view('settings.associates.index', compact('associates'));
    }

    /**
     * Show the form for creating a new associate.
     */
    public function create()
    {
        return view('settings.associates.create');
    }

    /**
     * Store a newly created associate in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|digits:10|unique:associates,phone_number',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->only(['name', 'phone_number']);
            $data['associate_id'] = Associate::generateAssociateId();

            Associate::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Associate created successfully.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create associate: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified associate.
     */
    public function show(Associate $associate)
    {
        return view('settings.associates.show', compact('associate'));
    }

    /**
     * Show the form for editing the specified associate.
     */
    public function edit($id)
    {
        $associate = Associate::findOrFail($id);
        $edit = true;
        $view = view('settings.associates.edit', compact('associate', 'edit'))->render();
        return response()->json(['status' => true, 'view' => $view]);
    }

    /**
     * Update the specified associate in storage.
     */
    public function update(Request $request, $id)
    {
        $associate = Associate::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|digits:10|unique:associates,phone_number,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $associate->update($request->only(['name', 'phone_number']));

            return response()->json([
                'status' => true,
                'message' => 'Associate updated successfully.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update associate: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified associate from storage.
     */
    public function delete($id)
    {
        try {
            $associate = Associate::findOrFail($id);
            $associate->delete();

            return response()->json([
                'status' => true,
                'message' => 'Associate deleted successfully.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete associate: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Filter associates for search and pagination.
     */
    public function filter(Request $request)
    {
        $query = Associate::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('associate_id', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        $associates = $query->orderBy('created_at', 'desc')->paginate(10);

        $view = view('settings.associates.filter', compact('associates'))->render();
        return response()->json(['status' => true, 'view' => $view]);
    }
}
