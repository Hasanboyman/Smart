<?php

namespace App\Http\Controllers;

use App\Models\reports as Report;
use Illuminate\Http\Request;

class Reports extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::all();
        return view('reports', compact('reports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Reports $reports)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $report = Report::findOrFail($id);

        $validatedData = $request->validate([
            'status' => 'required|in:solved,pending',
            'feedback' => 'nullable|string|max:1000',
        ]);

        if ($validatedData) {
            $report->update($validatedData);

            return response()->json([
                'message' => 'Report updated successfully.',
                'status' => $report->status,
                'feedback' => $report->feedback,
            ]);
        }
        return response()->json([
            'message' => 'Invalid data.',
            'status' => $report->status,
            'feedback' => $report->feedback,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reports $reports)
    {
        //
    }
}
