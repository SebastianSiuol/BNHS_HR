// Get references to the dropdown elements
const departmentSelect = document.getElementById('department');
const designationSelect = document.getElementById('designation');

// Listen for changes in the department dropdown
departmentSelect.addEventListener('change', function () {
    const department = departmentSelect.value;

    // Clear the designation dropdown
    designationSelect.innerHTML = '<option value="0">Select Designation</option>';

    // If a department is selected, make an AJAX request using Fetch API
    if (department) {
        fetch(`/get-designations?category=${department}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(responseData => {

                responseData.forEach(data => {
                    const option = document.createElement('option');
                    option.value = data.id;
                    option.textContent = data.name;
                    designationSelect.appendChild(option);
                })

            })
            .catch(e => {
                console.error('Error fetching department designations!');
                alert('Error fetching designations');
            });
    }
});
