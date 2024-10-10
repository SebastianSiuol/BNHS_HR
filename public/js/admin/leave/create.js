document.querySelectorAll('.approve_leave').forEach(button => {
    button.addEventListener('click', function() {
        // document.getElementById("approved").classList.remove("hidden");
        // removeButtons();
        const leaveId = this.getAttribute("data-userId");
        patchLeaveStatus(leaveId, 'approve');
    })
})

document.querySelectorAll('.reject_leave').forEach(button => {
    button.addEventListener('click', function() {
        // document.getElementById("rejected").classList.remove("hidden");
        // removeButtons();
        const leaveId = this.getAttribute("data-userId");
        patchLeaveStatus(leaveId, 'reject');
    })
})

function patchLeaveStatus(leaveId, action) {

    try {
        fetch('/admin/leave/status/action', {
                method: "PATCH",
                credentials: 'same-origin',
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    action: action,
                    leave_id: leaveId  // Send the leave ID dynamically
                })
            }
        ).then(response => response.json()
        ).then(responseData => {

            if(responseData.status === 200) {

                buttons = document.getElementById('buttons_'+leaveId)
                buttons.style.display = 'none'

                if(action === 'approve'){

                    document.getElementById('approved_'+leaveId).style.display = 'block';

                }else if (action === 'reject'){

                    document.getElementById('rejected_'+leaveId).style.display = 'block';

                }
            }

            window.location.href = responseData.redirect_url;

        }).catch(e => {
            console.error('Error!' + e);
            alert('Error sending action! Please check your internet Connection');
        });
    } catch (e) {
        alert('Error sending action!' + e);
    }
}
