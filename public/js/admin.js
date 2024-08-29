// ADD EMPLOYEE FORM NAVIGATION
document.getElementById('nextToAccountLogin').addEventListener('click', function() {
    document.getElementById('personalDetails').style.display = 'none';
    document.getElementById('accountLogin').style.display = 'block';
});

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

document.getElementById('both_address_same').addEventListener('change', function(){
    if(this.checked){
        document.getElementById('permanent_address_form').style.display = 'none';
    } else {
        document.getElementById('permanent_address_form').style.display = 'block';
    }
    // document.getElementById('permanent_house_num').disabled = this.checked;
    // document.getElementById('permanent_street').disabled = this.checked;
    // document.getElementById('permanent_subdivision').disabled = this.checked;
    // document.getElementById('permanent_barangay').disabled = this.checked;
    // document.getElementById('permanent_city').disabled = this.checked;
    // document.getElementById('permanent_province').disabled = this.checked;
    // document.getElementById('permanent_zip_code').disabled = this.checked;
});
