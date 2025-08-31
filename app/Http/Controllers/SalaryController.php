<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\StaffRole;
use Illuminate\Http\Request;    
class SalaryController extends Controller
{
    //
    public function index(){
        $roles=StaffRole::all();
        return view('dashboard.staff.salary.index',compact('roles'));
    }
}
