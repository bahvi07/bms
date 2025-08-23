@extends('layouts.app')
@section('content')
<div class="container mx-auto px-2 py-2">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold">Master</h1>
            <h5 class="text-xs text-gray-500">Manage the Relation between Garments and Measurment fields</h5>
        </div>

<div class="flex items-center gap-3">
 <button class="btn rounded-lg" id="createRelationBtn" onclick="relationModal.showModal()">
    <i class="ti ti-plus mr-2"></i>   Create Relation
</button>
</div>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6 p-2">
    {{-- Table --}}
   <table id="garment-measurement-table" class="table table-striped bg-white table-bordered w-full">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr class="text-center bg-gray-800 text-white">
            <th class="px-6 py-3">S.No.</th>
            <th class="px-6 py-3">Garment</th>
            <th class="px-6 py-3">Measurement Fields</th>
            <th class="px-6 py-3">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($garments as $garment)
        <tr id="row-{{ $garment->id }}" class="bg-white border-b text-center">
            <td class="px-6 py-4">{{ $loop->iteration }}</td>
            <td class="px-6 py-4">{{ $garment->name }}</td>
            <td class="px-6 py-4">
                @if($garment->measurements->count())
                    {{ $garment->measurements->pluck('label')->implode(', ') }}
                @else
                    <span class="text-gray-400 italic">No measurements assigned</span>
                @endif
            </td>
            <td class="px-6 py-4 text-center">
                <button onclick='openEditModal(@json($garment))'
                    class="text-white btn bg-green-500 hover:bg-green-600 rounded-lg px-5 border-none">
                    <i class="ti ti-edit"></i>
                </button>
                <button onclick="deleteGarment({{ $garment->id }})"
                    class="text-white btn bg-red-500 hover:bg-red-700 rounded-lg px-5 ml-2 border-none">
                    <i class="ti ti-trash"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


</div>
{{-- Garment ↔ Measurement Relation Modal --}}
<dialog id="relationModal" class="modal">
  <div class="modal-box bg-white text-gray-900 rounded-2xl shadow-xl w-full max-w-lg relative">

    <!-- Close button -->
    <button type="button" 
            onclick="document.getElementById('relationModal').close()" 
            class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>

    <!-- Title -->
    <h3 id="modal-title" class="text-xl font-semibold text-gray-800 mb-2">
      {{ isset($relation) ? 'Edit Relation' : 'Create Relation' }}
    </h3>
    <p id="modal-subtitle" class="text-sm text-gray-500 mb-6">
      Select a garment and choose its measurement fields.
    </p>

    <!-- Form -->
    <form id="relation-form" 
          action="" 
          method="POST" 
          class="space-y-5">

      @csrf
      @if(isset($relation))
          @method('PUT')
      @endif

      <!-- Garment Dropdown -->
      <div>
        <label for="garment_id" class="block text-sm font-medium mb-1">Garment</label>
        <select id="garment_id" name="garment_id" required
          class="select select-bordered w-full rounded-lg focus:ring-2 focus:ring-green-400">
          <option disabled {{ !isset($relation) ? 'selected' : '' }}>Select Garment</option>
          @foreach($garments as $garment)
            <option value="{{ $garment->id }}" 
              {{ isset($relation) && $relation->id == $garment->id ? 'selected' : '' }}>
              {{ $garment->name }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Measurement Checkboxes -->
      <div>
        <label class="block text-sm font-medium mb-2">Measurement Fields</label>
        <div class="grid grid-cols-2 gap-2 max-h-48 overflow-y-auto p-2 border rounded-lg">
          @foreach($measurements as $measurement) 
          <label class="flex items-center space-x-2">
            <input type="checkbox" name="measurement_fields[]" value="{{ $measurement->id }}" 
                   class="checkbox checkbox-sm checkbox-success"
                   @if(isset($relation) && $relation->measurements->contains($measurement->id)) checked @endif>
            <span class="text-sm">{{ $measurement->label }} ({{ $measurement->unit ?? '' }})</span>
          </label>
           @endforeach
        </div>
        <p class="text-xs text-gray-400 mt-1">Select one or more measurement fields.</p>
      </div>

      <!-- Action Buttons -->
      <div class="flex justify-end gap-3 pt-4 border-t">
        <button type="button" 
          onclick="document.getElementById('relationModal').close()" 
          class="btn bg-red-500 text-white hover:bg-red-600">Cancel</button>

        <button type="submit" id="saveBtn" 
          class="btn bg-indigo-600 text-white hover:bg-indigo-700">
          {{ isset($relation) ? 'Update Relation' : 'Create Relation' }}
        </button>
      </div>
    </form>
  </div>
</dialog>


</div>
@endsection