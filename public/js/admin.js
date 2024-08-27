// // FOR SHOWING ANOTHER FILE INPUT IN CREATING ANNOUNCEMENT
// document.addEventListener('DOMContentLoaded', function() {
//     const fileInputs = [
//         document.getElementById('file_1'),
//         document.getElementById('file_2'),
//         document.getElementById('file_3'),
//         document.getElementById('file_4'),
//         document.getElementById('file_5')
//     ];

//     const addFileButton = document.getElementById('add-file');
//     let currentIndex = 1;

//     document.getElementById('add-file').addEventListener('click', function() {
//         if (currentIndex < fileInputs.length) {
//             // show another file input
//             if (currentIndex > 0) {
//                 fileInputs[currentIndex - 1].classList.add('block');
//             }
            
//             fileInputs[currentIndex].classList.remove('hidden');
//             currentIndex++;
//         }

//         // Hide the button if all inputs are visible
//         if (currentIndex >= fileInputs.length) {
//             addFileButton.classList.add('hidden');
//         }
//     });
// });

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
