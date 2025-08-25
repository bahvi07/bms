<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
     public function index(){
        return view('dashboard.orders.index');
    }
    public function create(){
        $garments = \App\Models\Garment::all();
        $fabrics = \App\Models\Fabric::all();
        return view('dashboard.orders.create',compact('garments','fabrics'));
    }
    public function store(Request $request){
        // Handle order creation logic here
        return redirect()->route('dashboard.orders.index')->with('success', 'Order created successfully.');     
    }
}
