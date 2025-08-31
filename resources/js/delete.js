// resources/js/delete.js
import { getCsrfToken } from './main';

export async function deleteGarment(id) {
  const confirmResult = await Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#16a34a',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!',
  });

  if (!confirmResult.isConfirmed) return;

  try {
   const url = `/dashboard/masters/${id}`;

    const fd = new FormData();
    fd.append('_method', 'DELETE');

    const res = await fetch(url, {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': getCsrfToken(), 'Accept': 'application/json' },
      body: fd,
    });

    const data = await res.json().catch(() => ({}));
    if (!res.ok) throw new Error(data.message || 'Failed to delete garment.');

    document.getElementById(`row-${id}`)?.remove();
    Swal.fire('Deleted!', data.message || 'Garment deleted successfully.', 'success');
  } catch (err) {
    Swal.fire('Error!', err.message || 'Unexpected error during delete.', 'error');
  }
}

window.deleteGarment = deleteGarment;


//  Delete Measurement
export async function deleteMeasurement(id) {
  const confirmResult = await Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#16a34a',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!',
  });

  if (!confirmResult.isConfirmed) return;

  try {
    const url = `/dashboard/masters/measurement/${id}`; // ✅ correct URL
    const fd = new FormData();
    fd.append('_method', 'DELETE');

    const res = await fetch(url, {
      method: 'POST',
      headers: { 
        'X-CSRF-TOKEN': getCsrfToken(), 
        'Accept': 'application/json' 
      },
      body: fd,
    });

    const data = await res.json();
    if (!res.ok) throw new Error(data.message || 'Failed to delete measurement.');

    document.getElementById(`row-${id}`)?.remove();
    Swal.fire('Deleted!', data.message || 'Measurement deleted successfully.', 'success');
  } catch (err) {
    Swal.fire('Error!', err.message || 'Unexpected error during delete.', 'error');
  }
}

window.deleteMeasurement = deleteMeasurement;

// Delete Fabric

export async function deleteFabric(id) {
  const confirmResult = await Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#16a34a',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!',
  });

  if (!confirmResult.isConfirmed) return;

  try {
    const url = `/dashboard/masters/delete-fabric/${id}`; // ✅ correct URL
    const fd = new FormData();
    fd.append('_method', 'DELETE');

    const res = await fetch(url, {
      method: 'POST',
      headers: { 
        'X-CSRF-TOKEN': getCsrfToken(), 
        'Accept': 'application/json' 
      },
      body: fd,
    });

    const data = await res.json();
    if (!res.ok) throw new Error(data.message || 'Failed to delete measurement.');

    document.getElementById(`row-${id}`)?.remove();
    Swal.fire('Deleted!', data.message || 'Fabric deleted successfully.', 'success');
  } catch (err) {
    Swal.fire('Error!', err.message || 'Unexpected error during delete.', 'error');
  }
}

window.deleteFabric = deleteFabric;

export async function deleteRole(id) {
const confirmResult = await Swal.fire({
    title: 'Are you sure?',
    text: 'This action cannot be undone!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#16a34a',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!',
  });
  if (!confirmResult.isConfirmed) return;
  try {
    const url = `/dashboard/roles/${id}`;
    const fd = new FormData();
    fd.append('_method', 'DELETE');

    const res = await fetch(url, {
      method: 'POST',
      headers: { 
        'X-CSRF-TOKEN': getCsrfToken(), 
        'Accept': 'application/json' 
      },
      body: fd,
    });

    const data = await res.json();
    if (!res.ok) throw new Error(data.message || 'Failed to delete role.');

    document.getElementById(`row-${id}`)?.remove();
    Swal.fire('Deleted!', data.message || 'Role deleted successfully.', 'success');
  } catch (err) {
    Swal.fire('Error!', err.message || 'Unexpected error during delete.', 'error');
  }
}
window.deleteRole = deleteRole;

export async function deleteStaff(id) {
  const confirmResult = await Swal.fire({
      title: 'Are you sure?',
      text: 'This action cannot be undone!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#16a34a',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!',
    });
    if (!confirmResult.isConfirmed) return;
    try {
      const url = `/dashboard/staff/delete/${id}`;
      const fd = new FormData();
      fd.append('_method', 'DELETE');
      const res = await fetch(url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': getCsrfToken(),
          'Accept': 'application/json'
        },  
        body: fd,
      });

      const data = await res.json();
      if (!res.ok) throw new Error(data.message || 'Failed to delete staff.');
      document.getElementById(`row-${id}`)?.remove();
      Swal.fire('Deleted!', data.message || 'Staff deleted successfully.', 'success');
    } catch (err) {
      Swal.fire('Error!', err.message || 'Unexpected error during delete.', 'error');
    }
}
window.deleteStaff = deleteStaff;