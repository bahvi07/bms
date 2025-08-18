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
   class="bg-red-400 hidden sm:flex items-center hover:bg-red-600 text-white px-4 py-2 rounded-md">
    <i class="ti ti-x mr-2"></i>
    Clear
</a>

<!-- Icon-only button (only visible below sm) -->
<a href="{{ route('dashboard.orders') }}"
   class="bg-red-400 sm:hidden hover:bg-red-600 text-white px-3 py-2 rounded-md">
    <i class="ti ti-x"></i>
</a>    
</div>


   <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-6 ">  
    <!-- Left Section (8/12)  -->
    {{-- {{ route('orders.store') }} --}}
    <div class="lg:col-span-8 rounded-lg ">
  <form action="" method="POST" class="lg:col-span-8 bg-white p-6 rounded-lg shadow mb-4" id="order-form">
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


     <div class="lg:col-span-8 bg-white mt-3 rounded-lg shadow mb-6 mt-6">
       <form action="" method="post" class="lg:col-span-8 p-6 rounded-lg" id="measurement-form">
@csrf
{{-- Card Header --}}
      <div class="flex items-center justify-between mb-2">
    <h2 class="text-lg font-semibold flex items-center">
        <i class="ti ti-scissors mr-2 text-gray-600"></i>
        Order Items
    </h2>
    <button 
        class="bg-indigo-600 text-white px-4 py-1 rounded-md shadow hover:bg-indigo-700 transition"
        type="button">
        Add  <i class="ti ti-plus mr-2"></i>
    </button>
</div>

     <h4 class="text-sm font-semibold mb-2">Item 1</h4>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
    <div>
        <label for="garment" class="block text-sm font-medium text-gray-700 mb-2">
            Garment Type*
        </label>
        <select 
            id="garment-type"
            class="w-full border-none py-1 px-3 rounded-md pr-8 bg-white 
                   focus:outline-none focus:ring focus:border-blue-400"
        >
            <option value="All" disabled selected>Select....</option>
            <option value="Urgent">Lehnga</option>
            <option value="Medium">Kurta</option>
            <option value="Low">Jacket</option>
        </select>
    </div>

    <div>
        <label for="fabric" class="block text-sm font-medium text-gray-700 mb-2">
            Fabric*
        </label>
        <select 
            id="fabric-type"
            class="w-full border-none py-1 px-3 rounded-md pr-8 bg-white 
                   focus:outline-none focus:ring focus:border-blue-400"
        >
            <option value="All" disabled selected>Select....</option>
            <option value="Urgent">XXXXX</option>
            <option value="Medium">YYYYY</option>
            <option value="Low">ZZZZZ</option>
        </select>
    </div>

    <div>
        <label for="color" class="block text-sm font-medium text-gray-700 mb-2">
            Color*
        </label>
        <select 
            id="color-type"
            class="w-full border-none py-1 px-3 rounded-md pr-8 bg-white 
                   focus:outline-none focus:ring focus:border-blue-400"
        >
            <option value="All" disabled selected>e.g. Navy Blue</option>
            <option value="Urgent">Red</option>
            <option value="Medium">Green</option>
            <option value="Low">Blue</option>
        </select>
    </div>
</div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
          <div>
             <label for="qty" class="block text-sm font-medium text-gray-700">Quantity*</label>
            <input type="text" id="item-qty" name="itm_qty"
                   placeholder="1"
                   required
                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2">
        </div>
            <div>
             <label for="price" class="block text-sm font-medium text-gray-700">Unit Price*</label>
            <input type="text" id="unit-price" name="unit_price"
                   placeholder="1"
                   required
                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2">
        </div>
    </div>
     <h2 class="text-lg font-semibold mb-2 flex items-center">
        <i class="ti ti-ruler-measure mr-2 text-gray-600"></i>
    Measurements (inches)
    </h2>
    {{-- DYNAMIC MEASURMENT FILEDS --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        
        {{-- Fields goes here --}}
         <div>
             <label for="chest" class="block text-sm font-medium text-gray-700">Chest*</label>
            <input type="text" id="chest" name="chest"
                   placeholder="1"
                   required
                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2">
        </div>
         <div>
             <label for="waist" class="block text-sm font-medium text-gray-700">Waist*</label>
            <input type="text" id="waist" name="waist"
                   placeholder="1"
                   required
                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2">
        </div>
         <div>
             <label for="hips" class="block text-sm font-medium text-gray-700">Hips*</label>
            <input type="text" id="hips" name="hips"
                   placeholder="1"
                   required
                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2">
        </div>
         <div>
             <label for="shoulder" class="block text-sm font-medium text-gray-700">Shoulder Width*</label>
            <input type="text" id="shoulder-width" name="shoulder_width"
                   placeholder="1"
                   required
                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2">
        </div>
        <div>
             <label for="arm" class="block text-sm font-medium text-gray-700">Arm Length*</label>
            <input type="text" id="arm-length" name="arm-length"
                   placeholder="1"
                   required
                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2">
        </div>
        <div>
             <label for="neck" class="block text-sm font-medium text-gray-700">Neck Size*</label>
            <input type="text" id="neck_size" name="neck_size"
                   placeholder="1"
                   required
                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2">
        </div>
        <div>
             <label for="length" class="block text-sm font-medium text-gray-700">Length*</label>
            <input type="text" id="length" name="length"
                   placeholder="1"
                   required
                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2">
        </div>
    </div>
    <div class="mt-4">
        <p  class=""> Special Instruction*</p>
        <textarea id="instruction" name="instruction"
                  placeholder="Any additional notes or instructions"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2"></textarea>
      
    </div>
     </form>
    </div>
    
    <div class="lg:col-span-4 bg-white p-6 rounded-lg shadow">
       <form action="" method="POST" class="lg:col-span-8 bg-white rounded-lg mb-4" id="order-form">
    @csrf

    <!-- Card Header -->
    <h2 class="text-lg font-semibold mb-4 flex items-center">
        <i class="ti ti-calendar-event mr-2 text-gray-600"></i>
        Order Details
    </h2>

    <!-- Grid for form fields -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Customer Name -->
        <div>
            <label for="delivery-date" class="block text-sm font-medium text-gray-700">Delivery Date*</label>
            <input type="date" id="devliery-date" name="devliery_date"
                   placeholder=""
                   required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2">
        </div>

        <!-- set Priority -->
        <div>
            <label for="set-priority" class="block text-sm font-medium text-gray-700">Priority*</label>
            <select id="set-priority" name="set-priority"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2">
                <option value="medium"  selected>Medium</option>
                <option value="high">High</option>
                <option value="low">Low</option>
            </select>   
        </div>

        <!-- Address (full width) -->
          <div class="md:col-span-2">
        <p  class=""> Order Notes*</p>
        <textarea id="instruction" name="instruction"
                  placeholder="Any additional notes or instructions"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 sm:text-sm p-2"></textarea>
      
    </div>
    </div>
</form>
          
    </div> 
</div>
<!-- Right Section (4/12) -->
<div class="lg:col-span-4 bg-white p-6 rounded-lg shadow h-fit">
    <h2 class="text-xl font-medium mb-4">
        <i class="ti ti-clipboard-list"></i>
        Order Summary</h2>
    <div class="h-80"> 
<button class="bg-green-400 hover:bg-green-600 p-2 rounded-lg text-white" type="button">
<i class="ti ti-list"></i>
    Create Order
</button>
<button class="bg-gray-100 p-2 rounded-lg font-medium" type="button">Cancel </button>
    </div>
</div>

</div>
</div>
@endsection
