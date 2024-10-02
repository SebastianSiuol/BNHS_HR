const typeOfLeave = document.getElementById('leave_type')

typeOfLeave.addEventListener('change', getLeaveType)


function getLeaveType (){
    const leaveTypeID = typeOfLeave.value

    if (leaveTypeID) {
        fetch(`/get-leave-type?id=${leaveTypeID}`, {
            method: 'GET',
        })
            .then(response => response.json())
            .then(responseData => {

                console.log(responseData['days'])

            })
            .catch(e => {
                console.error('Error fetching the types of leaves! Please check your internet Connection');
                alert('Error fetching leave types! Please check your internet Connection');
            });
    }

}
