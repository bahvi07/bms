<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaffRole;
use App\Models\Staff;
class StaffController extends Controller
{
    //
    public function index()
    {
       
        return view('dashboard.staff.index');
    }
    public function create()
    {
          $roles = StaffRole::all();
        return view('dashboard.staff.create',compact('roles'));
    }
public function store(Request $request)
{
    $request->validate([
        'full_name' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'email' => 'nullable|email',
        'role_id' => 'required|exists:staff_roles,id',
        'joining_date' => 'required|date',
        'address' => 'nullable|string',
        'salary' => 'nullable|numeric',
        'profile_picture' => 'nullable|image|max:2048',
        'id_proof' => 'nullable|image|max:2048',
    ]);

    // Handle file uploads
    if ($request->hasFile('profile_picture')) {
        $profile_picture = $request->file('profile_picture')->store('profiles', 'public');
    }

    if ($request->hasFile('id_proof')) {
        $id_proof = $request->file('id_proof')->store('id_proofs', 'public');
    }

    // Create the staff member
    $staff = Staff::create([
        'full_name' => $request->full_name,
        'phone' => $request->phone,
        'email' => $request->email,
        'role_id' => $request->role_id,
        'joining_date' => $request->joining_date,
        'address' => $request->address,
        'salary' => $request->salary,
        'profile_picture' => $profile_picture ?? null,
        'id_proof' => $id_proof ?? null,
        'status' => $request->status,
    ]);

    // Update the assigned count for the role
    $staffRole = StaffRole::find($request->role_id);
    if ($staffRole) {
        $staffRole->increment('assigned');
    }

    return response()->json(['success' => true, 'staff' => $staff]);
}

}
