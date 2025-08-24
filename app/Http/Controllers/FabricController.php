<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fabric;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
class FabricController extends Controller
{
    public function index()
    {
        $fabrics = Fabric::all();
        return view('dashboard.masters.fabrics', compact('fabrics'));
    }

    public function createFabric(Request $request)
    {
        // Validate and create a new fabric entry
        $request->validate([
            'fabric' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Fabric::create([
            'fabric' => $request->fabric,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard.masters.fabrics')
                         ->with('success', 'Fabric created successfully.');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'fabric' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            $fabric = Fabric::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Fabric created successfully!',
                'fabric'  => $fabric,
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors'  => $e->errors(),
            ], 422);
        }
    }

    public function updateFabric(Request $request, $id)
    {
        $request->validate([
            'fabric' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $fabric = Fabric::findOrFail($id);
        $fabric->update([
            'fabric' => $request->fabric,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard.masters.fabrics')
                         ->with('success', 'Fabric updated successfully.');
    }

   public function destroyFabric($id)
{
    $fabric = Fabric::findOrFail($id);
    $fabric->delete();

    return response()->json([
        'success' => true,
        'message' => 'Fabric deleted successfully.'
    ]);
}


    public function importFabrics(Request $request)
    {
                $request->validate([
            'file' => 'required|file|mimes:xlsx,csv,xls',
        ]);
$file=$request->file('file');
     $rows= Excel::toArray([],$file)[0]; // Get first sheet data
    foreach($rows as $index=>$row){
        if($index === 0) continue; // Skip header row
          Fabric::firstOrCreate(
            ['fabric' => $row[0]], // assuming first column = fabric
            ['description' => $row[1] ?? null] // second column = description
        );
    }

    return response()->json(['success' => count($rows)-1]); // minus header row

    }
}
