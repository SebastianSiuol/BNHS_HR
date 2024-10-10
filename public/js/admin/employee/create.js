const sameAddrButton = document.getElementById('same_address_button');

sameAddrButton.addEventListener('click', transferInputs)

function transferInputs () {

    const resHouseNum = document.getElementById('residential_house_num');
    const resStreet = document.getElementById('residential_street');
    const resSubd = document.getElementById('residential_subdivision');
    const resBrgy = document.getElementById('residential_barangay');
    const resCity = document.getElementById('residential_city');
    const resProv = document.getElementById('residential_province');
    const resZipCode = document.getElementById('residential_zip_code');

    const permHouseNum = document.getElementById('permanent_house_num');
    const permStreet = document.getElementById('permanent_street');
    const permSubd = document.getElementById('permanent_subdivision');
    const permBrgy = document.getElementById('permanent_barangay');
    const permCity = document.getElementById('permanent_city');
    const permProv = document.getElementById('permanent_province');
    const permZipCode = document.getElementById('permanent_zip_code');

    permHouseNum.value = resHouseNum.value;
    permStreet.value = resStreet.value;
    permSubd.value = resSubd.value;
    permBrgy.value = resBrgy.value;
    permCity.value = resCity.value;
    permProv.value = resProv.value;
    permZipCode.value = resZipCode.value;
}
