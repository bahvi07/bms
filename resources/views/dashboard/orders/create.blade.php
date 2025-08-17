@extends('layouts.app')

@section('content')
<div class="container mx-auto px-2 py-2">

<div class="flex items-center justify-between mb-6">
    {{-- Header Title --}}
    <div>
        <h1 class="text-2xl font-semibold">New Order</h1>
        <h5 class="text-xs text-gray-500">Create a new Customer Order with measurements</h5>
    </div>
{{-- New Order Button --}}
<!-- Full button (only visible on sm and above) -->
<a href="{{ route('dashboard.orders') }}"
   class="bg-green-400 hidden sm:flex items-center hover:bg-green-600 text-white px-4 py-2 rounded-md">
    <i class="ti ti-x mr-2"></i>
    Clear
</a>

<!-- Icon-only button (only visible below sm) -->
<a href="{{ route('dashboard.orders') }}"
   class="bg-green-400 sm:hidden hover:bg-green-600 text-white px-3 py-2 rounded-md">
    <i class="ti ti-x"></i>
</a>

       
</div>
   <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-6 ">
    
    <!-- Left Section (8/12)  -->
    {{-- {{ route('orders.store') }} --}}
    <div class="lg:col-span-8 rounded-lg ">
  <form action="" method="POST" class="lg:col-span-8 bg-white p-6 rounded-lg shadow" id="order-form">
    @csrf

    <!-- Card Header -->
    <h2 class="text-lg font-semibold mb-4 flex items-center">
        <i class="ti ti-user mr-2 text-gray-600"></i>
        Customer Information
    </h2>

    <!-- Grid for form fields -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Customer Name -->
        <div>
            <label for="customer_name" class="block text-sm font-medium text-gray-700">Customer Name*</label>
            <input type="text" id="customer_name" name="customer_name"
                   placeholder="Enter customer name"
                   required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2">
        </div>

        <!-- Phone Number -->
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number*</label>
            <input type="text" id="phone" name="phone"
                   placeholder="+91 55555-012325"
                   required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2">
        </div>

        <!-- Address (full width) -->
        <div class="md:col-span-2">
            <label for="address" class="block text-sm font-medium text-gray-700">Address*</label>
            <input type="text" id="address" name="address"
                   placeholder="Enter customer address"
                   required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2">
        </div>
    </div>
</form>


     <div class="lg:col-span-8 bg-white mt-3 rounded-lg shadow">
       <form action="" method="post" class="lg:col-span-8 p-6 rounded-lg" id="measurement-form">
@csrf
{{-- Card Header --}}
        <h2 class="text-lg font-semibold mb-2 flex items-center">
        <i class="ti ti-scissors mr-2 text-gray-600"></i>
    Order Items
    </h2>
     <h4 class="text-sm font-semibold mb-2">Item 1</h4>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
       
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Garment Types*</label>
            <input type="text" id="phone" name="phone"
                   placeholder="+91 55555-012325"
                   required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2">
        </div>
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Fabric*</label>
            <input type="text" id="phone" name="phone"
                   placeholder="+91 55555-012325"
                   required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2">
        </div>
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Color*</label>
            <input type="text" id="phone" name="phone"
                   placeholder="+91 55555-012325"
                   required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2">
        </div>
    </div>
    
       </form>
    </div>
    </div>
    <!-- Right Section (4/12) -->
    <div class="lg:col-span-4 bg-white p-6 rounded-lg shadow">
        <i class="ti ti-alert-hexagon mr-2 text-6xl text-red-500"></i>
        <h2 class="text-xl font-medium mb-4">Order status distribtuion</h2>
        <p class="text-3xl font-bold">pie chart</p>
        <p class="text-right text-xs text-red-400 font-bold">
            {{-- <i class="ti ti-trending-down text-lg"></i> 40% --}}
        </p>
    </div>

</div>

</div>
@endsection
