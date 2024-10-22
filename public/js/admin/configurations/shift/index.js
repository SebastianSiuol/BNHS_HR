const editButtons = document.querySelectorAll('button[data-modal-target="edit-shift-modal"]');
const editModal = document.getElementById('edit-shift-modal');


editButtons.forEach(button => {
    button.addEventListener('click', function () {

        // Get data from button attributes
        const shiftId = this.getAttribute('data-shift-id');
        const shiftName = this.getAttribute('data-shift-name');
        const fromTime = this.getAttribute('data-from-time');
        const toTime = this.getAttribute('data-to-time');

        const upperShiftName = shiftName[0].toUpperCase() + shiftName.slice(1);

        // Inject data into modal inputs
        editModal.querySelector('#shift_id').value = shiftId;
        editModal.querySelector('input[name="name"]').value = upperShiftName;
        editModal.querySelector('input[name="start_time"]').value = fromTime;
        editModal.querySelector('input[name="end_time"]').value = toTime;
        editModal.querySelector('form').setAttribute('action', '/admin/config/shift/' + shiftId);
    });

});
