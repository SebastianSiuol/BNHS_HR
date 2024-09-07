document.getElementById("approveLeave").addEventListener("click", function() {
    document.getElementById("approved").classList.remove("hidden");
    document.getElementById("approveLeave").style.display = "none";
    document.getElementById("rejectLeave").style.display = "none";
});

document.getElementById("rejectLeave").addEventListener("click", function() {
    document.getElementById("rejected").classList.remove("hidden");
    document.getElementById("approveLeave").style.display = "none";
    document.getElementById("rejectLeave").style.display = "none";
});
