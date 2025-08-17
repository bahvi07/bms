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
        return view('dashboard.orders.create');
    }
    public function store(Request $request){
        // Handle order creation logic here
        return redirect()->route('dashboard.orders.index')->with('success', 'Order created successfully.');     
    }
}
