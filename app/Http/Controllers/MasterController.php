<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Garment;

class MasterController extends Controller
{
    public function index()
    {
            $garments = Garment::all();
        return view('dashboard.masters.index',compact('garments'));
    }

    public function create()
    {
        return view('dashboard.masters.create');
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $garments = Garment::create($validated);

    // 👇 return JSON instead of redirecting
    return response()->json([
        'success' => true,
        'message' => 'Garment created successfully!',
        'data' => $garments
    ]);
}

}
