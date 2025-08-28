// resources/js/modals.js
export function openCreateModal() {
  const modal = document.getElementById('my_modal_1');
  if (!modal) return;

  document.getElementById('modal-title').innerText = 'Add New Garment';
  document.getElementById('modal-subtitle').innerText = 'Fill in the details below.';

  const form = document.getElementById('garmentForm');
  if (form) form.reset();

  document.getElementById('garment-id').value = '';
  modal.showModal?.();
}

export function openEditModal(garment) {
  const modal = document.getElementById('my_modal_1');
  if (!modal) return;

  document.getElementById('modal-title').innerText = 'Edit Garment';
  document.getElementById('modal-subtitle').innerText = 'Update the garment details below.';

  document.getElementById('garment-id').value = garment.id ?? '';
  document.getElementById('garment-name').value = garment.name ?? '';
  document.getElementById('description').value = garment.description ?? '';

  modal.showModal?.();
}

// make them available globally
window.openCreateModal = openCreateModal;
window.openEditModal = openEditModal;

// Measurements Modals
export function openMeasurementModal() {
  const modal = document.getElementById('my_modal_1');
  if (!modal) return;

  document.getElementById('modal-title').innerText = 'Add New Measurement field';
  document.getElementById('modal-subtitle').innerText = 'Fill in the details below.';

  const form = document.getElementById('measurementForm');
  if (form) form.reset();

  document.getElementById('measurement-id').value = '';
  modal.showModal?.();
}

export function measurementEditModal(measurement) {
  const modal = document.getElementById('my_modal_1');
  if (!modal) return;

  document.getElementById('modal-title').innerText = 'Edit Measurement';
  document.getElementById('modal-subtitle').innerText = 'Update the Measurement details below.';

  document.getElementById('measurement-id').value = measurement.id ?? '';
  document.getElementById('measurement-label').value = measurement.label ?? '';
  document.getElementById('description').value = measurement.description ?? '';
  document.getElementById('unit').value = measurement.unit ?? '';
  modal.showModal?.();
}

// make them available globally
window.openMeasurementModal = openMeasurementModal;
window.measurementEditModal= measurementEditModal;

// febric Modal
export function openFabricModal() {
  const modal = document.getElementById('my_modal_1');
  if (!modal) return;

  document.getElementById('modal-title').innerText = 'Add New Fabric';
  document.getElementById('modal-subtitle').innerText = 'Fill in the details below.';

  const form = document.getElementById('fabricForm');
  if (form) form.reset();

  document.getElementById('fabric-id').value = '';
  modal.showModal?.();
}
export function fabricEditModal(fabric) {
  const modal = document.getElementById('my_modal_1');
  if (!modal) return;

  document.getElementById('modal-title').innerText = 'Edit Fabric';
  document.getElementById('modal-subtitle').innerText = 'Update the Fabric details below.';

  document.getElementById('fabric-id').value = fabric.id ?? '';
  document.getElementById('fabric-name').value = fabric.fabric ?? '';
  document.getElementById('description').value = fabric.description ?? '';
  modal.showModal?.();
}
window.openFabricModal = openFabricModal;
window.fabricEditModal= fabricEditModal;

// Roles Modal
export function openRoleModal() {
const modal = document.getElementById('my_modal_1');
  if (!modal) return;

  document.getElementById('modal-title').innerText = 'Add New Role';
  document.getElementById('modal-subtitle').innerText = 'Fill in the details below.';

  const form = document.getElementById('roleForm');
  if (form) form.reset();

  document.getElementById('role-id').value = '';
  modal.showModal?.();
}
export function roleEditModal(role) {
    const modal = document.getElementById('my_modal_1');
    if (!modal) return;

    document.getElementById('modal-title').innerText = 'Edit Role';
    document.getElementById('modal-subtitle').innerText = 'Update the role details below.';

    document.getElementById('role-id').value = role.id ?? '';
    document.getElementById('role-title').value = role.role ?? '';
    document.getElementById('description').value = role.description ?? '';
    document.getElementById('status').value = role.status ?? '';
    modal.showModal?.();
}
window.openRoleModal = openRoleModal;
window.roleEditModal = roleEditModal;