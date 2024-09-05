/**
 * Validates the input fields base on the class given to them.
 * Counts the number of input fields using the class name='input-validation'
 * If the validation matches the number of input fields, continue
 */
function validatePersonalDetailsForm() {

    // pd = personal details,
    // txt = text
    const personalDetailsInputs = document.querySelectorAll('.validate-pd-txt-inputs input');
    const birthDateInput = document.getElementById('date_of_birth');

    let allValid = true;

    for (let input of personalDetailsInputs) {
        if (input.value.trim() === '') {
            input.setCustomValidity('Please input the required field');
            input.reportValidity()
            allValid = false;
            break;
        }
    }

    if (allValid){
        document.getElementById('personalDetails').style.display = 'none';
        document.getElementById('accountLogin').style.display = 'block';
    }
}

function isDateOfBirthNotFilled(){
    const dateOfBirthInput = document.getElementById('date_of_birth');
    return (dateOfBirthInput.value === null || dateOfBirthInput.value === '');
}


/**
 * NAVIGATE FORMS
 */

document.getElementById('nextToAccountLogin').addEventListener('click', validatePersonalDetailsForm);
