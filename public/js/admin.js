// ADD EMPLOYEE FORM NAVIGATION
document.getElementById('prevToPersonalDetails').addEventListener('click', function() {
    document.getElementById('accountLogin').style.display = 'none';
    document.getElementById('personalDetails').style.display = 'block';
});

document.getElementById('prevToAccountLogin').addEventListener('click', function() {
    document.getElementById('companyDetails').style.display = 'none';
    document.getElementById('accountLogin').style.display = 'block';
});

document.getElementById('prevToCompanyDetails').addEventListener('click', function() {
    document.getElementById('documentsForm').style.display = 'none';
    document.getElementById('companyDetails').style.display = 'block';
});




