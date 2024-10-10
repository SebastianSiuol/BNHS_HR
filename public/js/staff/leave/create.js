const typeOfLeave = document.getElementById('leave_type')
typeOfLeave.addEventListener('change', getLeaveType)

const numberOfLeaveInput = document.getElementById('no_of_leave_days_div')

function getLeaveType (){
    const leaveTypeID = typeOfLeave.value

    if (leaveTypeID) {
        fetch(`/get-leave-type?id=${leaveTypeID}`, {
            method: 'GET',
        })
            .then(response => response.json())
            .then(responseData => {

                if(!responseData['days']){
                    /* Shows Input when Service Credit is chosen. */
                    numberOfLeaveInput.style.display = 'grid'
                } else {
                    numberOfLeaveInput.style.display = 'none'
                }

            })
            .catch(e => {
                console.error('Error fetching the types of leaves! Please check your internet Connection');
                alert('Error fetching leave types! Please check your internet Connection');
            });
    }

}
