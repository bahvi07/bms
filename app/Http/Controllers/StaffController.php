<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaffRole;
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
}
