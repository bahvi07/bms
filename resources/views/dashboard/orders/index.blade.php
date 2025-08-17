@extends('layouts.app')

@section('content')
<div class="container mx-auto px-2 py-2">

<div class="flex items-center justify-between mb-6">
    {{-- Header Title --}}
    <div>
        <h1 class="text-2xl font-semibold">Orders</h1>
        <h5 class="text-xs text-gray-500">Create a new Customer Order with measurements and tasks</h5>
    </div>

{{-- New Order Button --}}
<!-- Full button (only visible on sm and above) -->
<a href="{{ route('dashboard.orders.create') }}"
   class="bg-green-400 hidden sm:flex items-center hover:bg-green-600 text-white px-4 py-2 rounded-md">
    <i class="ti ti-plus mr-2"></i>
    New Order
</a>

<!-- Icon-only button (only visible below sm) -->
<a href="{{ route('dashboard.orders.create') }}"
   class="bg-green-400 sm:hidden hover:bg-green-600 text-white px-3 py-2 rounded-md">
    <i class="ti ti-plus"></i>
</a>

       
</div>
{{-- Search & Filter & Clear --}}
<div class="bg-white flex flex-wrap items-center gap-4 p-4 rounded-lg shadow">
    <!-- Search -->
    <div class=" flex-1 min-w-[100px]">
        <input 
            type="text" 
            placeholder="Search by order number or customer..." 
            class="w-full pl-10 pr-4 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-400"
            id="search-order"
        >
    </div>

    <!-- Filter -->
    <div class="">
        <select 
            id="priority-filter"
            class="border py-1 px-3 rounded-md pr-8 bg-white 
                   focus:outline-none focus:ring focus:border-blue-400"
        >
            <option value="All">All Priorities</option>
            <option value="Urgent">Urgent</option>
            <option value="Medium">Medium</option>
            <option value="Low">Low</option>
        </select>
    </div>

    <!-- Clear Button -->
    <button class="flex items-center gap-1 px-3 py-1 border rounded-md text-gray-600 hover:bg-gray-100" id="clear-filters">
        <i class="ti ti-filter-off"></i> 
        Clear   
    </button>
</div>
 <div class="lg:col-span-12 bg-white p-6 mt-6 rounded-lg shadow">
        <i class="ti ti-alert-hexagon mr-2 text-6xl text-red-500"></i>
        <h2 class="text-xl font-medium mb-4">Todays Task overview</h2>
        <p class="text-3xl font-bold">Order Table </p>
        <p class="text-right text-xs text-red-400 font-bold">
        </p>
    </div>
</div>
@endsection
