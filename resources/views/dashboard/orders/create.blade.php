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
{{-- Cusomter-info --}}
    <div class="lg:col-span-8 rounded-lg ">
  <form action="" method="POST" class="lg:col-span-8 bg-white p-6 rounded-lg shadow mb-4" id="customer-info">
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

{{-- Order-form --}}
     <div class="lg:col-span-8 bg-white mt-3 rounded-lg shadow mb-6 mt-6">
       <form action="" method="post" class="lg:col-span-8 p-6 rounded-lg" id="order-form" enctype="multipart/form-data">
@csrf
{{-- Card Header --}}
      <div class="flex items-center justify-between mb-2">
    <h2 class="text-lg font-semibold flex items-center">
        <i class="ti ti-scissors mr-2 text-gray-600"></i>
        Order Items
    </h2>
   <button 
    type="button"
    id="add-item-btn"
    class="bg-indigo-600 text-white px-4 py-1 rounded-md shadow hover:bg-indigo-700 transition">
    Add <i class="ti ti-plus mr-2"></i>
</button>

</div>

    <div id="items-container">
{{-- Item Template (hidden) --}}
<div class="order-item border border-gray-200 p-4 rounded-lg mb-4 hidden" id="order-item-template">
    <h4 class="text-sm font-semibold mb-2">Item <span class="item-number">1</span></h4>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Garment Type*</label>
            <select name="garments[]" class="garment-type w-full border-gray-300 rounded-md p-2" id="garment-type">
                <option disabled selected>Select...</option>
                @foreach ($garments as $garment)
                    <option value="{{ $garment->id }}">{{ $garment->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Fabric*</label>
            <select name="fabrics[]" class="fabric-type w-full border-gray-300 rounded-md p-2">
                <option disabled selected>Select...</option>
                @foreach ($fabrics as $fabric)
                    <option value="{{ $fabric->id }}">{{ $fabric->fabric }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Color</label>
            <input type="text" name="colors[]" placeholder="Enter color" class="w-full border-gray-300 rounded-md p-2" id="color">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <label class="block text-sm font-medium text-gray-700">Quantity*</label>
            <input type="text" name="qty[]" class="w-full border-gray-300 rounded-md p-2 qty" placeholder="1" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Unit Price*</label>
            <input type="text" name="unit_price[]" class="w-full border-gray-300 rounded-md p-2 un" placeholder="1.00" required>
        </div>
    </div>
 <h2 class="text-lg font-semibold mb-2 flex items-center">
        <i class="ti ti-ruler-measure mr-2 text-gray-600"></i>
    Measurements (inches)
    </h2>
    {{-- DYNAMIC MEASURMENT FILEDS --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 measurement-fields">
        
    </div>
    <div class="mt-2">
        <label class="block text-sm font-medium text-gray-700">Special Instruction*</label>
        <textarea name="instruction[]" class="w-full border-gray-300 rounded-md p-2" id="instruction"></textarea>
    </div>

   <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 mt-4 media-fields">
    <!-- Upload Files (Photo / Documents) -->
  <div class="extraOutline p-4 bg-white rounded-lg shadow text-center">
    <label class="form-label required-field block mb-3 text-gray-700 font-medium">Upload Photo</label>
    
    <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-indigo-400 transition cursor-pointer">
        <input type="file" 
               class="absolute inset-0 opacity-0 cursor-pointer file-upload-input" 
               accept="image/*" 
               required 
               name="photo">

        <div class="flex flex-col items-center justify-center pointer-events-none">
            <i class="fas fa-camera text-indigo-500 text-3xl mb-2"></i>
            <p class="text-gray-600 text-sm mb-1">Click or drag to upload photo</p>
            <small class="text-gray-400">(Max 2MB, JPG/PNG)</small>
        </div>
    </div>

    <!-- File Name Preview -->
    <span class="file-name text-indigo-600 mt-3 block text-sm font-medium hidden"></span>
</div>


<!-- Audio Recording Component -->
<div x-data="audioRecorder()" class="bg-white p-4 rounded-lg shadow">
    <div class="flex items-center space-x-4">
        <!-- Record Button -->
        <button 
            @click="toggleRecording()"
            :class="isRecording ? 'bg-red-500 hover:bg-red-600' : 'bg-blue-500 hover:bg-blue-600'"
            class="px-4 py-2 text-white rounded-lg transition-colors"
        >
            <span x-show="!isRecording">🎤 Start Recording</span>
            <span x-show="isRecording">⏹️ Stop Recording</span>
        </button>

        <!-- Recording Status -->
        <div x-show="isRecording" class="flex items-center text-red-500">
            <div class="animate-pulse w-3 h-3 bg-red-500 rounded-full mr-2"></div>
            <span x-text="formatTime(recordingTime)"></span>
        </div>
    </div>

    <!-- Audio Preview -->
    <div x-show="audioBlob" class="mt-4">
        <audio :src="audioUrl" controls class="w-full"></audio>
        <div class="flex space-x-2 mt-2">
            <button @click="playAudio()" class="px-3 py-1 bg-green-500 text-white rounded">
                Play
            </button>
            <button @click="deleteRecording()" class="px-3 py-1 bg-red-500 text-white rounded">
                Delete
            </button>
        </div>
    </div>
</div>

</div>
</div>

</div>

     </form>
    </div>
    
    {{-- Order Details --}}
    <div class="lg:col-span-4 bg-white p-6 rounded-lg shadow">
       <form action="" method="POST" class="lg:col-span-8 bg-white rounded-lg mb-4" id="order-details">
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
  <!-- Title -->
  <h2 class="text-lg font-semibold mb-4 flex items-center">
    <i class="ti ti-clipboard-list mr-2"></i>
    Order Summary
  </h2>

  <!-- Summary content -->
  <div class="space-y-2 text-sm">
    <div class="flex justify-between">
      <span class="text-gray-600">Items:</span>
      <span class="font-medium item-num">2</span>
    </div>

    <div class="flex justify-between">
      <span class="text-gray-600">Subtotal:</span>
      <span class="font-medium">₹0.00</span>
    </div>

    <hr class="my-2">

    <div class="flex justify-between text-base font-semibold">
      <span>Total Amount:</span>
      <span>₹0.00</span>
    </div>
   <hr class="my-2">
    <!-- Advance amount input -->
    <div class="mt-3">
      <label class="block text-gray-700 text-sm mb-1">Advance Amount (₹)</label>
      <input type="text" 
             value="0"
             class="w-full border rounded-md p-2 text-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500">
    </div>

    <div class="flex justify-between mt-2">
      <span class="text-gray-600">Advance Paid:</span>
      <span class="font-medium">₹0.00</span>
    </div>

    <div class="flex justify-between mt-2">
      <span class="text-green-600">Remaining:</span>
      <span class="text-green-600 font-medium">₹0.00</span>
    </div>
  </div>
   <hr class="my-2">
  <!-- Buttons -->
  <div class="grid grid-cols-1 gap-3 mt-6">
    <button 
      class="bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg flex justify-center items-center gap-2 font-medium transition"
      type="button">
      <i class="ti ti-list"></i>
      Create order
    </button>

    <button 
      class="bg-gray-100 hover:bg-gray-200 py-2 rounded-lg font-medium transition"
      type="button">
      Cancel
    </button>
  </div>
</div>


</div>
</div>
@endsection
