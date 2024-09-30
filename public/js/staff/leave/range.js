import {Datepicker} from "flowbite-datepicker/DatePicker";


const datepickerEl = document.getElementById('datepicker');

// Initialize the datepicker
const datepicker = new Datepicker(datepickerEl, {
    format: 'yyyy-mm-dd', // Date format
    beforeShowDay: function (date) {
        // Disable weekends
        const day = date.getDay();
        // 0 is Sunday, 6 is Saturday
        return day !== 0 && day !== 6;
    }
});


document.addEventListener('DOMContentLoaded', function () {
    console.error('Error fetching department designations!');
    alert('Error fetching designations');
});
