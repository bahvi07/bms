@extends('layouts.app')

@section('content')
<div class="container mx-auto px-2 py-2">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold">Master</h1>
            <h5 class="text-xs text-gray-500">Manage garment types easily</h5>
        </div>

<div class="flex items-center gap-3">
        <button type="submit" id="importBtn" class="btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md flex items-center border-none hidden sm:flex">
            <i class="ti ti-download mr-2 "></i> Import Excel
        </button>
 <button type="submit" id="importBtn" class="btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md flex items-center border-none  sm:hidden">
            <i class="ti ti-download mr-2 "></i> 
        </button>
        <button onclick="openCreateModal()"
            class="btn bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md hidden sm:flex  border-none items-center">
            <i class="ti ti-plus mr-2"></i> Add new Garment
        </button>
        <button onclick="openCreateModal()" 
            class="btn bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-md sm:hidden border-none">
            <i class="ti ti-plus"></i>
        </button>
    </div>   
    </div>

    
    {{-- Table --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6 p-2">
    {{-- Table --}}
    <table id="garments-table" class="table table-striped bg-white  table-bordered w-full">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50" >
            <tr class="text-center bg-gray-800 text-white">
                <th class="px-6 py-3">S.No.</th>
                <th class="px-6 py-3">Garment</th>
                <th class="px-6 py-3">Description</th>
                <th class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($garments as $garment)
            <tr id="row-{{ $garment->id }}" class="bg-white border-b text-center">
                <td class="px-6 py-4 col-iteration">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 col-name">{{ $garment->name }}</td>
                <td class="px-6 py-4 col-description">{{ $garment->description }}</td>
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

{{-- Add & Edit Modal --}}
    <dialog id="my_modal_1" class="modal">
        <div class="modal-box bg-white text-gray-900 rounded-2xl shadow-xl w-full max-w-lg">
            <h3 id="modal-title" class="text-xl font-semibold text-gray-800 mb-4">Add New Garment</h3>
            <p id="modal-subtitle" class="text-sm text-gray-500 mb-6">Fill in the details below.</p>

            <form id="garmentForm" class="space-y-5">
                @csrf
                <input type="hidden" id="garment-id" name="id">
                <button type="button" 
                        onclick="document.getElementById('my_modal_1').close()" 
                        class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>

                <div>
                    <label for="garment-name" class="block text-sm font-medium">Garment Name</label>
                    <input id="garment-name" name="name" type="text" placeholder="e.g., Formal Shirt"
                        class="input input-bordered w-full rounded-xl bg-white focus:ring-2 focus:ring-green-400">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="textarea textarea-bordered w-full rounded-xl bg-white focus:ring-2 focus:ring-green-400"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t">
                    <button type="button" onclick="document.getElementById('my_modal_1').close()" 
                        class="btn bg-red-500 text-white hover:bg-red-600 rounded-lg px-3 py-1 border-none">Cancel</button>
                    <button type="submit" class="btn bg-green-400 text-white rounded-lg hover:bg-green-600 px-3 py-1 border-none">Save</button>
                </div>
            </form>
        </div>
    </dialog>

    {{-- Import Excel Modal --}}
    <dialog id="importModal" class="modal">
        <div class="modal-box bg-white text-gray-900 rounded-2xl text-center shadow-xl w-full max-w-lg">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">📥 Import Garments from Excel</h3>
            <p class="text-sm text-gray-500 mb-6">Upload your Excel file to import garment data.</p>

            {{-- action="{{ route('dashboard.masters.importGarments') }}" method="POST" --}}
          <form id="importForm" enctype="multipart/form-data"   >
                @csrf
                <input type="file" name="file" accept=".xlsx, .xls, .csv" required
                    class="file-input file-input-bordered w-full max-w-xs mb-4 bg-white shadow">

                <div class="flex justify-end gap-3 pt-4 border-t">
                    <button type="button" onclick="document.getElementById('importModal').close()" 
                        class="btn bg-red-500 text-white hover:bg-red-600 rounded-lg px-3 py-1 border-none">Cancel</button>
                    <button type="submit" class="btn bg-green-400 text-white rounded-lg hover:bg-green-600 px-3 py-1 border-none" id="importSubmitBtn">Import</button>
                </div>
            </form>
        </div>

    </dialog>
@endsection
