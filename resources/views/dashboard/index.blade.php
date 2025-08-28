@extends('layouts.app')

@section('content')
<div class="container mx-auto px-2 py-2">
    @if (session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif
    
    <h1 class="text-2xl font-semibold">Dashboard</h1>
    <h5 class="text-xs mb-6 text-gray-500 ">Welcome to Your Tailoring Command Center</h5>

   <div 
    x-data="{
        alerts: [
            { text: 'Welcome back, Admin!', color: 'bg-green-500' },
            { text: 'Low stock alert: 5 items left', color: 'bg-red-500' },
            { text: 'Deadlines today: 5 orders', color: 'bg-yellow-500' }
        ],
        currentIndex: 0,
        init() {
            setInterval(() => {
                this.currentIndex = (this.currentIndex + 1) % this.alerts.length;
            }, 5000);
        }
    }"
    class="w-full text-white rounded-lg p-4 text-center mb-6"
    :class="alerts[currentIndex].color"
>
    <span x-text="alerts[currentIndex].text"></span>
</div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 text-center">
        <div class="bg-white p-6 rounded-lg shadow">
              <i class="ti ti-package mr-2 text-6xl text-green-400 "></i>
            <h2 class="text-xl font-medium mb-1">Active Orders</h2>
            <p class="text-3xl font-bold">20</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
               <i class="ti ti-clock-x mr-2 text-6xl text-yellow-400 "></i>
            <h2 class="text-xl font-medium mb-1">Deadlines today</h2>
            <p class="text-3xl font-bold">5</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
                <i class="ti ti-clipboard-data mr-2 text-6xl text-blue-500 "></i>
            <h2 class="text-xl font-medium mb-4">Pending tasks</h2>
            <p class="text-3xl font-bold">15</p>
        </div>
             <div class="bg-white p-6 rounded-lg shadow">
                  <i class="ti ti-alert-hexagon mr-2 text-6xl text-red-500 "></i>
            <h2 class="text-xl font-medium mb-4">Low stock alerts</h2>
            <p class="text-3xl font-bold">5</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-6 text-center">
    
    <!-- Left Section (8/12) -->
    <div class="lg:col-span-8 bg-white p-6 rounded-lg shadow">
        <i class="ti ti-alert-hexagon mr-2 text-6xl text-red-500"></i>
        <h2 class="text-xl font-medium mb-4">Todays Task overview</h2>
        <p class="text-3xl font-bold">Bar chart</p>
    </div>

    <!-- Right Section (4/12) -->
    <div class="lg:col-span-4 bg-white p-6 rounded-lg shadow">
        <i class="ti ti-alert-hexagon mr-2 text-6xl text-red-500"></i>
        <h2 class="text-xl font-medium mb-4">Staff Performance</h2>
        <p class="text-3xl font-bold">pie chart</p>
    </div>

</div>

   <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-6 text-center">
    
    <!-- Left Section (8/12) -->
    <div class="lg:col-span-8 rounded-lg shadow">
       <div class="lg:col-span-8 bg-red-200 p-6  rounded-lg shadow">
       <i class="ti ti-alert-hexagon mr-2 text-6xl text-red-500"></i>
        <h2 class="text-xl font-medium mb-4">Order status distribtuion</h2>
        <p class="text-3xl font-bold">pie chart</p>
    </div>
     <div class="lg:col-span-8 bg-green-200 mt-3 p-6 rounded-lg shadow">
       <i class="ti ti-alert-hexagon mr-2 text-6xl text-red-500"></i>
        <h2 class="text-xl font-medium mb-4">Order status distribtuion</h2>
        <p class="text-3xl font-bold">pie chart</p>
    </div>
    </div>
    <!-- Right Section (4/12) -->
    <div class="lg:col-span-4 bg-white p-6 rounded-lg shadow">
        <i class="ti ti-alert-hexagon mr-2 text-6xl text-red-500"></i>
        <h2 class="text-xl font-medium mb-4">Order status distribtuion</h2>
        <p class="text-3xl font-bold">pie chart</p>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-6 text-center">
    
    <!-- Left Section (8/12) -->
    <div class="lg:col-span-8 bg-white p-6 rounded-lg shadow">
        <i class="ti ti-alert-hexagon mr-2 text-6xl text-red-500"></i>
        <h2 class="text-xl font-medium mb-4">Quick Actions</h2>
        <p class="text-3xl font-bold">Add new order, add inventory, mark attendence, view report</p>
    </div>

    <!-- Right Section (4/12) -->
    <div class="lg:col-span-4 bg-white p-6 rounded-lg shadow">
        <i class="ti ti-alert-hexagon mr-2 text-6xl text-red-500"></i>
        <h2 class="text-xl font-medium mb-4">Notifications</h2>
        <p class="text-3xl font-bold">pie chart</p>
    </div>

</div>
@endsection
