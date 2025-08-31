@extends('layouts.app')
@section('title', 'Sallery Management')
@section('content')
<div class="container mx-auto py-2 px-2">
    <div class="flex items-center justify-between mb-6">
        {{-- Header Title --}}
        <div>
            <h1 class="text-2xl font-semibold">Staff Salary Management</h1>
            <h5 class="text-xs text-gray-500">Overview of all staff salaries and payment status</h5>
        </div>
        <div class="flex space-x-2">
            {{-- New Order Button --}}
            <a href="#"
   class="text-red-400  border-1 border-solid outline-red-400 hidden sm:flex items-center  px-4 py-2 rounded-lg">
    <i class="ti ti-file-type-pdf mr-2"></i>
    Export PDF
</a>

<!-- Icon-only button (only visible below sm) -->
<a href="#"
   class="sm:hidden text-red-400  border-1 border-solid outline-red-400 px-3 py-2 rounded-lg">
    <i class="ti ti-file-type-pdf"></i>
</a>
<a href="#"
   class="text-green-400  border-1 border-solid outline-green-400 hidden sm:flex items-center  px-4 py-2 rounded-lg">
    <i class="ti ti-upload mr-2"></i>
    Export Excel
</a>

<!-- Icon-only button (only visible below sm) -->
<a href="#"
   class="text-green-400  border-1 border-solid outline-green-400 sm:hidden  px-3 py-2 rounded-lg">
    <i class="ti ti-upload"></i>
</a>
        </div>
    </div>
</div>
@endsection