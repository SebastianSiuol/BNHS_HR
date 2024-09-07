const dateRegEx = RegExp('^(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])-(19|20)\\d\\d$')

/**
 * Validates the input fields base on the class given to them.
 */
function validatePersonalDetailsForm() {

    // pd = personal details,
    // txt = text
    const personalDetailsInputs = document.querySelectorAll('.validate-pd-txt-inputs input');
    const personalDetailsSelect = document.querySelectorAll('.validate-all select');
    const dateOfBirth = document.getElementById('date_of_birth');

    let allValid = true;

    for (let input of personalDetailsInputs) {
        if (input.value.trim() === '') {
            input.setCustomValidity('Please input the required field');
            input.reportValidity()
            allValid = false;
            break;
        }
    }

    if (!dateRegEx.test(dateOfBirth.value.trim())) {
        dateOfBirth.setCustomValidity('Please select a valid date format [mm-dd-yyyy]');
        dateOfBirth.reportValidity()
        allValid = false;
    }

    for (let select of personalDetailsSelect) {
        if (select.value === '0') {
            select.setCustomValidity('Please select the required field');
            select.reportValidity()
            allValid = false;
            break;
        }
    }

    if (allValid) {
        document.getElementById('personalDetails').style.display = 'none';
        document.getElementById('accountLogin').style.display = 'block';
    }
}


/**
 * Validates the input fields base on the class given to them.
 */
function validateAccountLoginForm() {

    // acc = account
    // txt = text
    const accountLoginInputs = document.querySelectorAll('.validate-acc-txt-inputs input');


    let allValid = true;

    for (let input of accountLoginInputs) {
        if (input.value.trim() === '') {
            input.setCustomValidity('Please input the required field');
            input.reportValidity()
            allValid = false;
            break;
        }
    }

    if (allValid){
        document.getElementById('accountLogin').style.display = 'none';
        document.getElementById('companyDetails').style.display = 'block';
    }
}

function validateCompanyLoginForm() {
    const companyLoginInputs = document.querySelectorAll('.validate-comp-txt-inputs input');
    const companyLoginSelects = document.querySelectorAll('.validate-comp-txt-inputs select');
    const companyLoginDateInputs = document.querySelectorAll('.validate-comp-txt-inputs .date-inputs');


    let allValid = true;

    for (let input of companyLoginInputs) {
        if (input.value.trim() === '') {
            input.setCustomValidity('Please input the required field');
            input.reportValidity()
            allValid = false;
            break;
        } else {
            for (let dateInputs of companyLoginDateInputs) {
                if (!dateRegEx.test(dateInputs.value.trim())) {
                    dateInputs.setCustomValidity('Please select a valid date format [mm-dd-yyyy]');
                    dateInputs.reportValidity()
                    allValid = false;
                }
            }
        }
    }

    for (let select of companyLoginSelects) {
        if (select.value === '0') {
            select.setCustomValidity('Please select the required field');
            select.reportValidity()
            allValid = false;
            break;
        }
    }


    if (allValid) {
        document.getElementById('companyDetails').style.display = 'none';
        document.getElementById('documentsForm').style.display = 'block';
    }

}









/**
 * NAVIGATE FORMS
 */
document.getElementById('nextToAccountLogin').addEventListener('click', validatePersonalDetailsForm);
document.getElementById('nextToCompanyDetails').addEventListener('click', validateAccountLoginForm);
document.getElementById('nextToDocuments').addEventListener('click', validateCompanyLoginForm);

function isDateOfBirthNotFilled(){
    const dateOfBirthInput = document.getElementById('date_of_birth');
    return (dateOfBirthInput.value === null || dateOfBirthInput.value === '');
}

function isSameAddressChecked(){
    return document.getElementById('both_address_same').checked;
}

document.getElementById('both_address_same').addEventListener('change', function(){
    if (this.checked){
        document.getElementById('permanent_address_form').style.display = 'none';
    } else {
        document.getElementById('permanent_address_form').style.display = 'block';
    }

})
