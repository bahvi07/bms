<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaffRole;
use App\Models\Staff;
use App\Models\Salary;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::with('role')->get();
        $stf=Staff::all();
        $total=$stf->count();
        $activeStaff=$stf->where('status',1)->count();
        $inactiveStaff=$stf->where('status',0)->count();
        return view('dashboard.staff.index', compact('staff','stf','total','activeStaff','inactiveStaff'));
    }
    
    public function create()
    {
        $roles = StaffRole::all();
        return view('dashboard.staff.create', compact('roles'));
    }
    
   public function store(Request $request)
{
    try {
        // ✅ Combine all validations into one
        $validated = $request->validate([
            'full_name'        => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'email'            => 'nullable|email|max:255|unique:staff,email',
            'role_id'          => 'required|exists:staff_roles,id',
            'joining_date'     => 'required|date',
            'address'          => 'required|string|max:500',
            'shift_start_time' => 'required|string',
            'shift_end_time'   => 'required|string',
            'profile_picture'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_proof'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'base_salary'      => 'required|numeric|min:0', // salary included here
        ]);

        // ✅ Handle file uploads
        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')
                                                   ->store('profiles', 'public');
        }

        if ($request->hasFile('id_proof')) {
            $validated['id_proof'] = $request->file('id_proof')
                                            ->store('id_proofs', 'public');
        }

        // ✅ Create staff
        $staff = Staff::create($validated);

        // ✅ Create salary linked to staff
        Salary::create([
            'staff_id'       => $staff->id,
            'base_salary'    => $validated['base_salary'],
            'amount_paid'    => 0,
            'pending_amount' => $validated['base_salary'],
        ]);

        // ✅ Redirect back with flash success (for Blade)
         return response()->json([
        'message' => 'Staff created successfully!',
        'staff' => $staff
    ], 201);
    } 
    catch (ValidationException $e) {
        return redirect()->back()
                         ->withErrors($e->errors())
                         ->withInput();
    } 
    catch (\Exception $e) {
        return redirect()->back()
                         ->with('error', 'An error occurred: '.$e->getMessage())
                         ->withInput();
    }
}


    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        return response()->json(['success' => true, 'message' => 'Staff member deleted successfully.']);
    }
}
