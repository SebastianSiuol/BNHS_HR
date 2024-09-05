/**
 * Validates the input fields base on the class given to them.
 * Counts the number of input fields using the class name='input-validation'
 * If the validation matches the number of input fields, continue
 */
function validatePersonalDetailsForm() {

    // pd = personal details,
    // txt = text
    const personalDetailsInputs = document.querySelectorAll('.validate-pd-txt-inputs');
    const birthDateInput = document.getElementById('date_of_birth');

    var numberOfInputs = personalDetailsInputs.length;

    var numberOfValidatedInputs = 0;

    personalDetailsInputs.forEach((e) => {
        const input = e.querySelector('input');

        if (input.value.trim() === '') {
            input.setCustomValidity('Please input the required field');
            input.reportValidity()
        } else {
            numberOfValidatedInputs++;

            if (numberOfValidatedInputs === numberOfInputs) {

                if (isDateOfBirthNotFilled()) {

                    console.log(isDateOfBirthNotFilled());

                    birthDateInput.setCustomValidity('Please select a date');
                    birthDateInput.reportValidity();

                } else {

                    document.getElementById('personalDetails').style.display = 'none';
                    document.getElementById('accountLogin').style.display = 'block';
                }
            }
        }
    })

    console.log(numberOfInputs);
}

function isDateOfBirthNotFilled(){
    const dateOfBirthInput = document.getElementById('date_of_birth');
    return (dateOfBirthInput.value === null || dateOfBirthInput.value === '');
}


/**
 * NAVIGATE FORMS
 */

document.getElementById('nextToAccountLogin').addEventListener('click', validatePersonalDetailsForm);
