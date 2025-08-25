<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Garment;
use App\Imports\GarmentsImport;
use App\Models\Measurements;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;

class MasterController extends Controller
{
    /**
     * Display all garments
     */
    public function index()
    {
        $garments = Garment::all();
        return view('dashboard.masters.index', compact('garments'));
    }

    /**
     * Show create garment form (not used with modal AJAX but kept for REST consistency)
     */
    public function create()
    {
        return view('dashboard.masters.create');
    }

    /**
     * Store a newly created garment (AJAX)
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            $garment = Garment::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Garment created successfully!',
                'garment' => $garment
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors'  => $e->errors(),
            ], 422);
        }
    }

    /**
     * Update an existing garment (AJAX)
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            $garment = Garment::findOrFail($id);
            $garment->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Garment updated successfully!',
                'garment' => $garment
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors'  => $e->errors(),
            ], 422);
        }
    }

    /**
     * Delete a garment
     */
    public function destroy($id)
    {
        $garment = Garment::findOrFail($id);
        $garment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Garment deleted successfully!'
        ], 200);
    }

    /**
     * Import garments from Excel file
     */
    public function importGarments(Request $request){
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv,xls',
        ]);
$file=$request->file('file');
     $rows= Excel::toArray([],$file)[0]; // Get first sheet data
    foreach($rows as $index=>$row){
        if($index === 0) continue; // Skip header row
          Garment::firstOrCreate(
            ['name' => $row[0]], // assuming first column = name
            ['description' => $row[1] ?? null] // second column = description
        );
    }

    return response()->json(['success' => count($rows)-1]); // minus header row

    }
    /**
     * Display measurements
     */

   public function measurements()
{
    $measurements = Measurements::all();
    return view('dashboard.masters.measurements', compact('measurements'));
}


    public function importMeasurements(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv,xls',
        ]);
        $file= $request->file('file');
        $rows=Excel::toArray([], $file)[0]; // Get first sheet data
        foreach($rows as $index => $row) {
            if($index === 0) continue; // Skip header row
            if(empty($row[0]) || empty($row[1]) || empty($row[2])) continue; // Skip rows with empty label, description or unit

            Measurements::firstOrCreate(
                ['label' => $row[0]], // assuming first column = label
                [
                    'description' => $row[1] ?? null, // second column = description
                    'unit' => $row[2] ?? null // third column = unit
                ]
            );
        }
        return response()->json(['success' => count($rows) - 1]); // minus header row
    }

       public function destroyMeasurements($id)
{
    $measurement = Measurements::findOrFail($id);
    $measurement->delete();

    return response()->json([
        'success' => true,
        'message' => 'Measurement deleted successfully!'
    ], 200);
}

public function createMeasurements(Request $request)
{
    try {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit' => 'required|string|max:50',
        ]);

        $measurement = Measurements::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Measurement filed created successfully!',
            'measurement' => $measurement
        ], 201);

    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'errors'  => $e->errors(),
        ], 422);
    }
}
public function updateMeasurements(Request $request, $id)
{
    try {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit' => 'required|string|max:50',
        ]);

        $measurement = Measurements::findOrFail($id);
        $measurement->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Measurement field updated successfully!',
            'measurement' => $measurement
        ], 200);

    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'errors'  => $e->errors(),
        ], 422);
    }
}

}