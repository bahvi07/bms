<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaffRole;
use App\Models\Staff;
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
            // Log the incoming request data
            Log::info('Staff creation request data:', $request->all());
            
            $validated = $request->validate([
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'nullable|email|max:255',
                'role_id' => 'required|exists:staff_roles,id',
                'joining_date' => 'required|date',
                'address' => 'required|string|max:500',
                'shift_start_time' => 'required|string',
                'shift_end_time' => 'required|string',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'id_proof' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            Log::info('Validation passed, processing file uploads...');

            // Handle file uploads
            if ($request->file('profile_picture')) {
                $validated['profile_picture'] = $request->file('profile_picture')->store('profiles', 'public');
                Log::info('Profile picture uploaded:', ['path' => $validated['profile_picture']]);
            }

            if ($request->file('id_proof')) {
                $validated['id_proof'] = $request->file('id_proof')->store('id_proofs', 'public');
                Log::info('ID proof uploaded:', ['path' => $validated['id_proof']]);
            }

            Log::info('Attempting to create staff with data:', $validated);

            // Create the staff member
            $staff = Staff::create($validated);

            Log::info('Staff created successfully:', ['staff_id' => $staff->id]);

            return response()->json([
                'success' => true, 
                'message' => 'Staff member created successfully!',
                'staff' => $staff
            ], 201);

        } catch (ValidationException $e) {
            Log::error('Validation failed:', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Log the actual error for debugging
            Log::error('Staff creation error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            Log::error('Request data: ' . json_encode($request->all()));
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the staff member: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        return response()->json(['success' => true, 'message' => 'Staff member deleted successfully.']);
    }
}
