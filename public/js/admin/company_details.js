
function changeInputFields() {

    let inputFields = document.querySelectorAll('.edit-company input[disabled]');
    let saveButton = document.getElementById("patch-company-details");

    // Loop through each input field and remove the 'readonly' attribute
    inputFields.forEach(function (input) {
        input.removeAttribute('disabled');

        input.classList.remove('border-gray-300');

        input.classList.add('border-blue-900');
    });

    saveButton.style.display = "block";
}



let editCompanyButton = document.getElementById("edit-company-details");
editCompanyButton.addEventListener("click", changeInputFields)
