@extends('layouts.app')
@section('content')
<div class="container mx-auto px-2 py-2">

<div class="flex items-center justify-between mb-6">
    {{-- Header Title --}}
    <div>
        <h1 class="text-2xl font-semibold">Add Staff Member</h1>
        <h5 class="text-xs text-gray-500">Manage Staff</h5>
    </div>

{{-- New Order Button --}}
<!-- Full button (only visible on sm and above) -->
<a href="{{ route('dashboard.staff') }}"
   class="bg-red-400 hidden sm:flex items-center hover:bg-red-600 text-white px-4 py-2 rounded-md">
    <i class="ti ti-x mr-2"></i>
    Clear
</a>

<!-- Icon-only button (only visible below sm) -->
<a href="{{ route('dashboard.staff') }}"
   class="bg-red-400 sm:hidden hover:bg-red-600 text-white px-3 py-2 rounded-md">
    <i class="ti ti-x"></i>
</a> 

       
</div>
</div>
@endsection