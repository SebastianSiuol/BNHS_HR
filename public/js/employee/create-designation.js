// Get references to the dropdown elements
const departmentSelect = document.getElementById('department');
const designationSelect = document.getElementById('designation');

// Listen for changes in the department dropdown
departmentSelect.addEventListener('change', function () {
    const department = departmentSelect.value;

    // Clear the designation dropdown
    designationSelect.innerHTML = '<option {{ empty(old(\'designation\'))  ? \'selected=selected\': \'\' }} disabled value="0">Select a Department First</option>';

    // If a department is selected, make an AJAX request using Fetch API
    if (department) {
        fetch(`/get-designations?department=${department}`, {
            method: 'GET',
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
