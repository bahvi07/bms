@extends('layouts.app')

@section('content')
<div class="container mx-auto px-2 py-2">
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
            <p class="text-3xl ">20</p>
            <p class="text-right text-xs text-green-400 font-bold">
            <i class="ti ti-trending-up text-lg"></i>
                20%
             </p>
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

    <div class="mt-8">
        <h2 class="text-xl font-medium mb-4">Recent Activity</h2>
        <!-- Recent activity content goes here -->
    </div>
@endsection
