// const calendar = document.getElementById('calendar');
// const monthSelect = document.getElementById('monthSelect');
// const yearSelect = document.getElementById('yearSelect');

// const currentDate = new Date();
// let currentMonth = currentDate.getMonth();
// let currentYear = currentDate.getFullYear();

// const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
// const dropdownItems = [
//   { label: "PH", icon: "fa-umbrella-beach" },
//   { label: "AL", icon: "fa-calendar-xmark" },
//   { label: "ML", icon: "fa-briefcase-medical" },
//   { label: "PDO", icon: "fa-person-walking" },
//   { label: "Custom", icon: "fa-pen" }
// ];

// function populateMonthYearDropdowns() {
//   const months = [
//     "January", "February", "March", "April", "May", "June",
//     "July", "August", "September", "October", "November", "December"
//   ];

//   months.forEach((month, i) => {
//     const option = document.createElement('option');
//     option.value = i;
//     option.textContent = month;
//     if (i === currentMonth) option.selected = true;
//     monthSelect.appendChild(option);
//   });

//   for (let y = currentYear - 5; y <= currentYear + 5; y++) {
//     const option = document.createElement('option');
//     option.value = y;
//     option.textContent = y;
//     if (y === currentYear) option.selected = true;
//     yearSelect.appendChild(option);
//   }
// }

// function renderCalendar(month, year) {
//   calendar.innerHTML = '';
//   const firstDay = new Date(year, month, 1);
//   const lastDate = new Date(year, month + 1, 0).getDate();
//   const startDay = firstDay.getDay();

//   // Days of week
//   daysOfWeek.forEach(day => {
//     const dayDiv = document.createElement('div');
//     dayDiv.className = 'day';
//     dayDiv.textContent = day;
//     calendar.appendChild(dayDiv);
//   });

//   // Blank cells before month starts
//   for (let i = 0; i < startDay; i++) {
//     const blank = document.createElement('div');
//     blank.className = 'date';
//     calendar.appendChild(blank);
//   }

//   // Dates with dropdowns
//   for (let date = 1; date <= lastDate; date++) {
//     const dateDiv = document.createElement('div');
//     dateDiv.className = 'date';

//     const number = document.createElement('div');
//     number.className = 'number';
//     number.textContent = date;

//     const dropdown = document.createElement('div');
//     dropdown.className = 'dropdown';

//     const menu = document.createElement('div');
//     menu.className = 'dropdown-menu';

//     dropdownItems.forEach(item => {
//       const option = document.createElement('div');
//       option.className = 'item';
//       option.innerHTML = `<i class="fa ${item.icon}"></i> ${item.label}`;
//       option.addEventListener('click', () => {
//         // Find the date div's label and remove it (if any)
//         // console.log(dateDiv);
//         dropdown.classList.remove('active');
        
//         const existingLabel = dateDiv.querySelector('.date-label');
//         if (existingLabel) {
//           existingLabel.remove(); // Remove the previous label
//         }

//         // Add the new label next to the date number
//         const labelDiv = document.createElement('div');
//         labelDiv.className = 'date-label';
//         labelDiv.innerHTML = `<i class="fa ${item.icon}"></i> ${item.label}`;
//         dateDiv.appendChild(labelDiv);

//         // Close the dropdown after selecting an item
//         dropdown.classList.remove('active');
//       });
//       menu.appendChild(option);
//     });

//     dropdown.appendChild(menu);
//     dateDiv.appendChild(number);
//     dateDiv.appendChild(dropdown);
//     calendar.appendChild(dateDiv);

//     // Clicking on date should open the dropdown
//     dateDiv.addEventListener('click', (e) => {
//       e.stopPropagation();
//       closeAllDropdowns();
//       dropdown.classList.toggle('active');
//     });
//   }
// }

// function closeAllDropdowns() {
//   document.querySelectorAll('.dropdown').forEach(drop => drop.classList.remove('active'));
// }

// // Close dropdown when clicking outside
// document.addEventListener('click', closeAllDropdowns);

// // Update calendar on dropdown change
// monthSelect.addEventListener('change', () => {
//   currentMonth = parseInt(monthSelect.value);
//   renderCalendar(currentMonth, currentYear);
// });

// yearSelect.addEventListener('change', () => {
//   currentYear = parseInt(yearSelect.value);
//   renderCalendar(currentMonth, currentYear);
// });

// populateMonthYearDropdowns();
// renderCalendar(currentMonth, currentYear);

// // Toggle password visibility function (for both password toggles)
// $(".toggle-password, .toggle-passwordd").click(function() {
//   $(this).toggleClass("fa-eye fa-eye-slash");
//   var input = $($(this).attr("toggle"));
//   if (input.attr("type") === "password") {
//       input.attr("type", "text");
//   } else {
//       input.attr("type", "password");
//   }
// });

// $(function() {
//   $('#date').datepicker({
//     dateFormat: 'dd-M-yy',
//     minDate: 1
//   });
  
//   $('.date-icon').on('click', function() {
//     $('#date').focus();
//   })
// });

// var $j = jQuery.noConflict();
// $j(document).ready(function() {
//     $j("#datepicker").datepicker();
// });


// // Toggle switch for active/inactive text
// const toggle = document.querySelector('.toggle input');
// if (toggle) {
//   toggle.addEventListener('click', () => {
//       const onOff = toggle.parentNode.querySelector('.onoff');
//       onOff.textContent = toggle.checked ? 'Active' : 'Inactive';
//   });
// }

// // Color picker logic
const colorCode = document.getElementById('colorCode');
const colorPicker = document.getElementById('colorPicker');

function updateColor() {
  const color = colorPicker.value; // Get the selected color
  colorCode.textContent = color;  // Update the displayed color code
}

// Event listener for color picker change
if (colorPicker) {
  colorPicker.addEventListener('input', updateColor);
}

// Optionally, set the initial color on page load
if (colorPicker) {
  updateColor();
}







