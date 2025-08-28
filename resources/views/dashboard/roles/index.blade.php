@extends('layouts.app')
@section('title', 'Roles Dashboard')
@section('content')

<div class="container mx-auto px-2 py-2">
<div class="flex items-center justify-between mb-6">
    {{-- Header Title --}}
    <div>
        <h1 class="text-2xl font-semibold">Manage Staff Roles</h1>
        <h5 class="text-xs text-gray-500">Define and manage staff roles and responsibilites</h5>
    </div>

<div class="flex items-center gap-3">
        <button type="submit" id="importRoleBtn" class="btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md flex items-center border-none">
            <i class="ti ti-download mr-2"></i> Import Excel
        </button>

        <button  onclick="openRoleModal()"
            class="btn bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md hidden sm:flex items-center border-none">
            <i class="ti ti-plus mr-2"></i> Add new Role
        </button>
        <button onclick="openRoleModal()" 
            class="btn bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-md sm:hidden border-none">
            <i class="ti ti-plus"></i>
        </button>
    </div>      
</div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 pt-3 rounded-lg shadow">
            <h2 class="text-xl font-medium mb-1">Total Roles</h2>
            <div class="flex items-center justify-between mt-4">
                <p class="text-2xl font-medium text-gray-600">{{$total}}</p>
                <i class="ti ti-receipt text-3xl text-gray-600 px-4 py-2 bg-gray-50 rounded-lg"></i>
            </div>
        </div>
        
        <div class="bg-white p-6 pt-3 rounded-lg shadow">
            <h2 class="text-xl font-medium mb-1">Active Roles</h2>
            <div class="flex items-center justify-between mt-4">
                <p class="text-3xl font-medium text-green-400">{{$active}}</p>
                <i class="ti ti-activity text-3xl text-green-400 px-4 py-2 bg-green-50 rounded-lg"></i>
            </div>
        </div>
        
        
        <div class="bg-white p-6 pt-3 rounded-lg shadow">
            <h2 class="text-xl font-medium mb-1">Assign Staff</h2>
            <div class="flex items-center justify-between mt-4">
                <p class="text-3xl font-medium text-indigo-400">20</p>
                <i class="ti ti-users text-3xl text-indigo-400 px-4 py-2 bg-indigo-50 rounded-lg"></i>
            </div>
        </div>
        
         <div class="bg-white p-6 pt-3 rounded-lg shadow">
            <h2 class="text-xl font-medium mb-1">Empty Roles</h2>
            <div class="flex items-center justify-between mt-4 ">
                <p class="text-3xl font-medium text-red-500">20</p>
                <i class="ti ti-alert-triangle text-3xl text-red-500 px-4 py-2 bg-red-50 rounded-lg"></i>
            </div>
        </div>
        
    </div>

{{-- Table --}}
    <div class="relative overflow-x-auto bg-white shadow-md sm:rounded-lg mt-6 p-2">
    {{-- Table --}}
    <table id="roles-table" class="table  bg-white table-bordered w-full">
        <thead class="text-sm text-gray-900 ">
            <tr class="text-center bg-gray-800 text-white">
                <th class="px-6 py-3">Role Title</th>
                <th class="px-6 py-3">Description</th>
                <th class="px-6 py-3">Assigned Staff</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
           @foreach($roles as $role)
<tr id="row-{{ $role->id }}" class="bg-white border-b text-center">
    <td class="px-6 py-4 col-role">{{ $role->role }}</td>
    <td class="px-6 py-4 col-description">{{ $role->description }}</td>
     {{-- <td class="px-6 py-4 col-assigned">{{ $role->assigned }}</td> --}}
     <td class="px-6 py-4 col-assigned"><i class="ti ti-users">-</i></td>
   <td class="px-6 py-4 col-status user-select-none">
    @if($role->status == 1)
        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-600">Active</span>
    @else
        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-600">Inactive</span>
    @endif
</td>

    <td class="px-6 py-4 text-center">
    <div class="flex items-center justify-center gap-2">
        <button onclick='roleEditModal(@json($role))'
            class="text-white btn bg-green-500 hover:bg-green-600 rounded-lg px-5 border-none">
            <i class="ti ti-edit"></i>
        </button>
        <button onclick="deleteRole({{ $role->id }})"
            class="text-white btn bg-red-500 hover:bg-red-700 rounded-lg px-5 border-none">
            <i class="ti ti-trash"></i>
        </button>
    </div>
    </td>
</tr>
@endforeach

        </tbody>
    </table>

</div>
</div>


{{-- Add & Edit Modal --}}
    <dialog id="my_modal_1" class="modal">
        <div class="modal-box bg-white text-gray-900 rounded-2xl shadow-xl w-full max-w-lg">
            <h3 id="modal-title" class="text-xl font-semibold text-gray-800 mb-1">Add New Role</h3>
            <span id="modal-subtitle" class="text-sm text-gray-500 mb-4 block">Fill in the details below.</span>
            <form id="roleForm" class="space-y-5">
                @csrf
                <input type="hidden" id="role-id" name="id">
                <button type="button" 
                        onclick="document.getElementById('my_modal_1').close()" 
                        class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>

                <div>
                    <label for="role-title" class="block text-sm font-medium">Role Title</label>
                    <input id="role-title" name="role" type="text" placeholder="e.g., Stitcher"
                        class="input input-bordered w-full bg-white rounded-xl focus:ring-2 focus:ring-green-400">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium">Description (Optional)</label>
                    <textarea id="description" name="description" rows="4"
                        class="textarea textarea-bordered w-full bg-white rounded-xl focus:ring-2 focus:ring-green-400"></textarea>
                </div>
<div>
    <label for="status" class="block text-sm font-medium">Status</label>
    <select id="status" name="status"
        class="input input-bordered w-full bg-white rounded-xl focus:ring-2 focus:ring-green-400">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>
</div>
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <button type="button" onclick="document.getElementById('my_modal_1').close()" 
                        class="btn bg-red-500 text-white hover:bg-red-600 border-none">Cancel</button>
                    <button type="submit" class="btn bg-green-400 text-white hover:bg-green-600 border-none">Save</button>
                </div>
            </form>
        </div>
    </dialog>

    {{-- Import Excel Modal --}}
    <dialog id="importRoleModal" class="modal">
        <div class="modal-box bg-white text-gray-900 rounded-2xl text-center shadow-xl w-full max-w-lg">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">📥 Import Garments from Excel</h3>
            <p class="text-sm text-gray-500 mb-6">Upload your Excel file to import garment data.</p>

            {{-- action="{{ route('dashboard.masters.importGarments') }}" method="POST" --}}
          <form id="importRoleForm" enctype="multipart/form-data"   >
                @csrf
                <input type="file" name="file" accept=".xlsx, .xls, .csv" required
                    class="file-input file-input-bordered w-full max-w-xs mb-4 bg-gray-100 bg-white shadow">

                <div class="flex justify-end gap-3 pt-4 border-t">
                    <button type="button" onclick="document.getElementById('importRoleModal').close()" 
                        class="btn bg-red-500 text-white hover:bg-red-600 border-none">Cancel</button>
                    <button type="submit" class="btn bg-green-400 text-white hover:bg-green-600 border-none" id="importRoleSubmitBtn">Import</button>
                </div>
            </form>
        </div>

    </dialog>
@endsection