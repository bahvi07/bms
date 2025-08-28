<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff_Roles;
use Maatwebsite\Excel\Facades\Excel;

class RoleController extends Controller
{
    //

    public function index()
    {
        // Fetch all roles (you can implement pagination if needed)
       
        $roles = Staff_Roles::all();
        return view('dashboard.roles.index',compact('roles'));
    }
    public function import(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $file = $request->file('file');
        $rows=Excel::toArray([], $file)[0];// Get the first sheet data

    }
}
