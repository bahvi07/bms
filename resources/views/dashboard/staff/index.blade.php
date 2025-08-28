@extends('layouts.app')
@section('title', 'Staff Dashboard')
@section('content')

<div class="container mx-auto px-2 py-2">
<div class="flex items-center justify-between mb-6">
    {{-- Header Title --}}
    <div>
        <h1 class="text-2xl font-semibold">Staff Directory</h1>
        <h5 class="text-xs text-gray-500">Manage and View all Staff Member</h5>
    </div>

{{-- New Order Button --}}
<!-- Full button (only visible on sm and above) -->
<a href="{{ route('dashboard.staff.create') }}"
   class="bg-green-400 hidden sm:flex items-center hover:bg-green-600 text-white px-4 py-2 rounded-md">
    <i class="ti ti-plus mr-2"></i>
    Add New Staff
</a>

<!-- Icon-only button (only visible below sm) -->
<a href="{{ route('dashboard.staff.create') }}"
   class="bg-green-400 sm:hidden hover:bg-green-600 text-white px-3 py-2 rounded-md">
    <i class="ti ti-plus"></i>
</a>     
</div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 text-center">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-medium mb-1">Total Staff</h2>
            <p class="text-3xl font-bold">20</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-medium mb-1">Active Staff</h2>
            <p class="text-3xl font-bold text-green-400">5</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-medium mb-4">Inactive Staff</h2>
            <p class="text-3xl font-bold text-red-500">15</p>
        </div>
    </div>

    <!-- Fillters and export -->
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 bg-white mt-6 p-4 rounded-lg shadow">
    
    <!-- Search Bar -->
    <div class="lg:col-span-2">
        <input type="text" placeholder="Search staff..." 
               class="w-full border border-gray-300 rounded-2xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <!-- Role Dropdown -->
    <div>
        {{-- Add Dynamically role/crate Role --}}
        <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="" disabled>Roll Select</option>
            <option value="all">All Roles</option>
            <option value="master">Master</option>
            <option value="tailor">Tailor</option>
        </select>
    </div>

    <!-- Status Dropdown -->
    <div>
        <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">All Status</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>

    <!-- Excel Button -->
    <div>
        <button class="btn rounded-lg text-green-500 bg-white border border-green-500 px-2 py-2 hover:bg-green-100 min-w-max">
            <i class="ti ti-notes text-lg"></i>
            Excel
        </button>
         <button class="btn rounded-lg text-red-500 bg-white border border-red-500 px-2 py-2 hover:bg-red-100 min-w-max ml-2">
            <i class="ti ti-book text-lg"></i>
            PDF
        </button>
    </div>

   

</div>
{{-- Table --}}
    <div class="relative overflow-x-auto bg-white shadow-md sm:rounded-lg mt-6 p-2">
    {{-- Table --}}
    <table id="staff-table" class="table  bg-white table-bordered w-full">
        <thead class="text-xs text-gray-700 uppercase">
            <tr class="text-center  text-dark">
                <th class="px-6 py-3">Staff</th>
                <th class="px-6 py-3">Contact</th>
                <th class="px-6 py-3">Role</th>
                <th class="px-6 py-3">Shift</th>
                <th class="px-6 py-3">Salary</th>
                <th class="px-6 py-3">Status</th>
            </tr>
        </thead>
        <tbody>
           {{-- @foreach($measurements as $measurement)
<tr id="row-{{ $measurement->id }}" class="bg-white border-b text-center">
    <td class="px-6 py-4 col-iteration">{{ $loop->iteration }}</td>
    <td class="px-6 py-4 col-label">{{ $measurement->label }}</td>
    <td class="px-6 py-4 col-description">{{ $measurement->description }}</td>
    <td class="px-6 py-4 col-unit">{{ $measurement->unit }}</td>
    <td class="px-6 py-4 text-center">
        <button onclick='measurementEditModal(@json($measurement))'
            class="text-white btn bg-green-500 hover:bg-green-600 rounded-lg px-5 border-none">
            <i class="ti ti-edit"></i>
        </button>
        <button onclick="deleteMeasurement({{ $measurement->id }})"
            class="text-white btn bg-red-500 hover:bg-red-700 rounded-lg px-5 ml-2 border-none">
            <i class="ti ti-trash"></i>
        </button>
    </td>
</tr>
@endforeach --}}

        </tbody>
    </table>

</div>
</div>
@endsection