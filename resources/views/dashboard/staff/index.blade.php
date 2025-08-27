@extends('layouts.app')
@section('title', 'Staff Dashboard')
@section('content')
<div class="container mx-auto px-2 py-2">

<div class="flex items-center justify-between mb-6">
    {{-- Header Title --}}
    <div>
        <h1 class="text-2xl font-semibold">Staff List</h1>
        <h5 class="text-xs text-gray-500">Manage Your Staf</h5>
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
</div>
@endsection