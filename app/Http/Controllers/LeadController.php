<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the leads.
     */
    public function index()
    {
        try {
            // Attempt to fetch leads from the database
            $leads = Lead::all();
            return response()->json($leads, 200);
        } catch (\Exception $e) {
            // Log the error for debugging in Railway logs
            Log::error('Lead index error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            // Return a detailed error response
            return response()->json([
                'error' => 'Failed to fetch leads',
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    /**
     * Store a newly created lead in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
            'source' => 'required|string',
            'email' => 'nullable|email',
            'assigned_to' => 'nullable|integer|exists:users,id'
        ]);

        // Set default assigned_to if not provided
        $validated['assigned_to'] = $validated['assigned_to'] ?? 1;

        $lead = Lead::create($validated);

        return response()->json($lead, 201); // 201 Created
    }

    /**
     * Display the specified lead.
     */
    public function show($id)
    {
        $lead = Lead::findOrFail($id);

        return response()->json($lead);
    }

    /**
     * Update the specified lead in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
            'source' => 'required|string',
            'email' => 'nullable|email',
            'assigned_to' => 'nullable|integer|exists:users,id'
        ]);

        $lead = Lead::findOrFail($id);
        $lead->update($validated);

        return response()->json($lead); // 200 OK
    }

    /**
     * Remove the specified lead from storage.
     */
    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        return response()->json(['message' => 'Lead deleted']);
    }
}
