const birthDateElement = document.getElementById('birthdate');




// document.getElementById('nextToAccountLogin').addEventListener('click', () => {
//
//     if (birthDateElement.value === '') {
//         birthDateElement.setCustomValidity("Please select a date");
//         birthDateElement.reportValidity();
//     }
// });




// ADD EMPLOYEE FORM NAVIGATION
// document.getElementById('nextToAccountLogin').addEventListener('click', function() {
//     document.getElementById('personalDetails').style.display = 'none';
//     document.getElementById('accountLogin').style.display = 'block';
// });

document.getElementById('prevToPersonalDetails').addEventListener('click', function() {
    document.getElementById('accountLogin').style.display = 'none';
    document.getElementById('personalDetails').style.display = 'block';
});

document.getElementById('nextToCompanyDetails').addEventListener('click', function() {
    document.getElementById('accountLogin').style.display = 'none';
    document.getElementById('companyDetails').style.display = 'block';
});

document.getElementById('prevToAccountLogin').addEventListener('click', function() {
    document.getElementById('companyDetails').style.display = 'none';
    document.getElementById('accountLogin').style.display = 'block';
});

document.getElementById('nextToDocuments').addEventListener('click', function() {
    document.getElementById('companyDetails').style.display = 'none';
    document.getElementById('Documents').style.display = 'block';
});

document.getElementById('prevToCompanyDetails').addEventListener('click', function() {
    document.getElementById('Documents').style.display = 'none';
    document.getElementById('companyDetails').style.display = 'block';
});




