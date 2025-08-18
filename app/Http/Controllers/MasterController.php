<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
{
    //
     public function index(){
        return view('dashboard.masters.index');
    }
    public function create(){
        return view('dashboard.masters.create');
    }
    public function store(Request $request){
        // Handle order creation logic here
        return redirect()->route('dashboard.masters.index')->with('success', 'Garment created successfully.');     
    }
}
