<?php

namespace App\Http\Controllers;

use App\Models\Measurements;
use Illuminate\Http\Request;
use App\Models\Garment;
use App\Models\Relation;

class RelationController extends Controller
{
    public function index()
    {
        $garments = Garment::with('measurements')->get();
        $measurements = Measurements::all();

        return view('dashboard.masters.relations', compact('garments', 'measurements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'garment_id' => 'required|exists:garments,id',
            'measurement_fields' => 'required|array',
        ]);

        $garment = Garment::findOrFail($request->garment_id);

        // This updates pivot table
        $garment->measurements()->sync($request->measurement_fields);

        return back()->with('success', 'Relation saved successfully!');
    }

    public function view(){
        $relations=Relation::all();
        return view('dashboard.masters.relations',compact('relations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'garment_id' => 'required|exists:garments,id',
            'measurement_fields' => 'required|array',
        ]);

        $garment = Garment::findOrFail($request->garment_id);

        // This updates pivot table
        $garment->measurements()->sync($request->measurement_fields);

        return back()->with('success', 'Relation updated successfully!');
    }

public function getMeasurements($id)
{
    $garment = Garment::with('measurements')->findOrFail($id);

    return response()->json($garment->measurements);
}

}
