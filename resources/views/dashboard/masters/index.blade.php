@extends('layouts.app')

@section('content')
<div class="container mx-auto px-2 py-2">

<div class="flex items-center justify-between mb-6">
    {{-- Header Title --}}
    <div>
        <h1 class="text-2xl font-semibold">Master</h1>
        <h5 class="text-xs text-gray-500">Create a new Customer Order with measurements and tasks</h5>
    </div>

{{-- New Order Button --}}
<!-- Full button (only visible on sm and above) -->
<button 
    onclick="my_modal_1.showModal()"
   class="btn bg-green-400 hidden sm:flex items-center hover:bg-green-600 text-white px-4 py-2 rounded-md">
    <i class="ti ti-plus mr-2"></i>
    Add new Garment
</button>

<!-- Icon-only button (only visible below sm) -->
<button class="btn  bg-green-400 sm:hidden hover:bg-green-600 text-white px-3 py-2 rounded-md" onclick="my_modal_1.showModal()">
    <i class="ti ti-plus"></i>
</button>

       
</div>
<dialog id="my_modal_1" class="modal">
  <div class="modal-box bg-white text-gray-900 rounded-2xl shadow-xl w-full max-w-lg">
    <!-- Header -->
    <h3 class="text-xl font-semibold text-gray-800 mb-4">➕ Add New Garment</h3>
    <p class="text-sm text-gray-500 mb-6">
      Fill in the details below to create a new garment type.
    </p>

    <!-- Form -->
<form id="garmentForm" 
      action="{{ route('dashboard.masters.store') }}" 
      class="space-y-5">
    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" type="button" onclick="document.getElementById('my_modal_1').close()">✕</button>

    <!-- Name -->
    <div>
        <label for="garment-name" class="block text-sm font-medium text-gray-700 mb-1">Garment Name</label>
        <input type="text" id="garment-name" name="name"
            class="input input-bordered w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
            placeholder="e.g., Formal Shirt">
    </div>

    <!-- Description -->
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea id="description" name="description" rows="4"
            class="textarea textarea-bordered w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
            placeholder="Enter details about this garment type..."></textarea>
    </div>

    <!-- Actions -->
    <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
        <button type="button" 
                onclick="document.getElementById('my_modal_1').close()" 
                class="btn bg-red-500 text-white hover:bg-red-600 rounded-lg px-6">
            Cancel
        </button>
        <button type="submit" 
                class="btn bg-indigo-600 text-white hover:bg-indigo-700 rounded-lg px-6">
            Save Garment
        </button>
    </div>
</form>

  </div>
</dialog>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                Garment
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($garments as $garment)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                 {{  $garment->name}}
                </th>
                <td class="px-6 py-4">
                  {{  $garment->description}}
                </td>
                <td class="px-6 py-4 flex items-center gap-2 ">
                    <button class="btn font-medium  bg-green-600 rounded-lg ">Edit</button>
                    <form action="" method="post">
                        @csrf
                        @method('DELETE')
                       <button  class="btn font-medium  bg-red-600 rounded-lg">Delete</button>
                    </form>
                </td>
            </tr>
          @endforeach
        </tbody>
    </table>
</div>

</div>
@endsection
