const editButtons = document.querySelectorAll('button[data-modal-target="edit-position-modal"]');
const editModal = document.getElementById("edit-position-modal");


editButtons.forEach(button => {
    button.addEventListener('click', function () {

        // Get data from button attributes
        const positionId = this.getAttribute('data-position-id');
        const positionTitle = this.getAttribute('data-position-title');
        const positionLevel = this.getAttribute('data-position-level');

        // Inject data into modal inputs
        editModal.querySelector('input[name="position_title"]').value = positionTitle;
        editModal.querySelector('select[name="position_level"]').value = positionLevel;
        editModal.querySelector('#update_position').setAttribute('action', '/admin/config/position/' + positionId);
    });

});
