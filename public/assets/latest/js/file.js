


const approved = window.dashboardDataTimeSheet?.approved ?? 0;
const submitted = window.dashboardDataTimeSheet?.submitted ?? 0;
const rejected = window.dashboardDataTimeSheet?.rejected ?? 0;

const isEmpty = (approved + submitted + rejected === 0);
const ctx = document.getElementById('timesheetChart').getContext('2d');

if (isEmpty) {
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['No data available'],
      datasets: [{
        data: [1],
        backgroundColor: ['#e5e7eb'],
        borderWidth: 2,
        borderColor: '#fff'
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          enabled: false
        }
      }
    }
  });
} else {
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Approved', 'Submitted (Unapproved)', 'Rejected'],
      datasets: [{
        data: [approved, submitted, rejected],
        backgroundColor: ['#2563eb', '#16a34a', '#ef4444'],
        borderWidth: 2,
        borderColor: '#fff'
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });
}



const logged = window.dashboardData?.totalLogged ?? 0;
const forecasted = window.dashboardData?.totalForecasted ?? 0;

const isWorkingChartEmpty = (logged + forecasted === 0);
const ctxx = document.getElementById('workingChart').getContext('2d');

if (isWorkingChartEmpty) {
  new Chart(ctxx, {
    type: 'pie',
    data: {
      labels: ['No data available'],
      datasets: [{
        data: [1],
        backgroundColor: ['#e5e7eb'], // grey fallback
        borderColor: '#fff',
        borderWidth: 2
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          enabled: false
        }
      }
    }
  });
} else {
  new Chart(ctxx, {
    type: 'pie',
    data: {
      labels: ['Hours Logged', 'Remaining Hours'],
      datasets: [{
        data: [logged, forecasted],
        backgroundColor: ['#22c55e', '#f97316'], // Green, Orange
        borderColor: '#fff',
        borderWidth: 2
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });
}




const ctxxx = document.getElementById('consultancyChart').getContext('2d');
const consultancyChart = new Chart(ctxxx, {
  type: 'pie',
  data: {
    labels: ['Active', 'Disabled', 'Blocked', 'Offboarded'],
    datasets: [{
      data: [100, 5, 10, 6],
      backgroundColor: ['green', 'orange', 'red', '#007bff'],
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        display: false
      }
    }
  }
});

const cttx = document.getElementById('mixedChart').getContext('2d');

const mixedChart = new Chart(cttx, {
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        type: 'bar',
        label: 'Green Bars',
        data: [-400, -300, -900, -600, -700, -500, 800],
        backgroundColor: 'rgba(144, 238, 144, 0.6)',
        borderRadius: 4
      },
      {
        type: 'bar',
        label: 'Blue Bars',
        data: [-600, 600, 900, 800, -300, -400, 700],
        backgroundColor: 'rgba(100, 149, 237, 0.6)',
        borderRadius: 4
      },
      {
        type: 'line',
        label: 'Line Dataset',
        data: [-600, 350, 500, 150, 400, 300, -700],
        borderColor: 'rgba(255, 99, 132, 0.6)',
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderWidth: 3,
        fill: false,
        tension: 0.4,
        pointBackgroundColor: 'rgba(255, 99, 132, 0.8)',
        pointBorderColor: '#fff',
        pointBorderWidth: 2,
        pointRadius: 6
      }
    ]
  },
  options: {
    responsive: true,
    plugins: {
      tooltip: {
        mode: 'index',
        intersect: false
      },
      legend: {
        position: 'top'
      }
    },
    scales: {
      y: {
        beginAtZero: false
      },
      x: {
        ticks: {
          callback: function (value) {
            return this.getLabelForValue(value);
          },
          maxRotation: 45,
          minRotation: 45
        }
      }
    }
  }
});



try {
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
} catch (error) {
  console.error("Tooltip initialization failed:", error);
}

const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
const dropdownItems = [
  { label: "PH", icon: "fa-umbrella-beach" },
  { label: "AL", icon: "fa-calendar-xmark" },
  { label: "ML", icon: "fa-briefcase-medical" },
  { label: "PDO", icon: "fa-person-walking" },
  { label: "Custom", icon: "fa-pen" }
];

function initCalendar({ calendarId, monthSelectId, yearSelectId }) {
  const calendar = document.getElementById(calendarId);
  const monthSelect = document.getElementById(monthSelectId);
  const yearSelect = document.getElementById(yearSelectId);

  const currentDate = new Date();
  let currentMonth = currentDate.getMonth();
  let currentYear = currentDate.getFullYear();

  function populateDropdowns() {
    const months = [
      "January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"
    ];

    months.forEach((month, i) => {
      const option = document.createElement('option');
      option.value = i;
      option.textContent = month;
      if (i === currentMonth) option.selected = true;
      monthSelect.appendChild(option);
    });

    for (let y = currentYear - 5; y <= currentYear + 5; y++) {
      const option = document.createElement('option');
      option.value = y;
      option.textContent = y;
      if (y === currentYear) option.selected = true;
      yearSelect.appendChild(option);
    }
  }

  function render(month, year) {
    calendar.innerHTML = '';

    const firstDay = new Date(year, month, 1);
    const lastDate = new Date(year, month + 1, 0).getDate();
    const startDay = firstDay.getDay();

    // Weekday headers
    daysOfWeek.forEach(day => {
      const dayDiv = document.createElement('div');
      dayDiv.className = 'day';
      dayDiv.textContent = day;
      calendar.appendChild(dayDiv);
    });

    // Blank spaces
    for (let i = 0; i < startDay; i++) {
      const blank = document.createElement('div');
      blank.className = 'date';
      calendar.appendChild(blank);
    }

    // Dates with dropdowns
    for (let date = 1; date <= lastDate; date++) {
      const dateDiv = document.createElement('div');
      dateDiv.className = 'date';

      const number = document.createElement('div');
      number.className = 'number';
      number.textContent = date;

      const dropdown = document.createElement('div');
      dropdown.className = 'dropdown';

      const menu = document.createElement('div');
      menu.className = 'dropdown-menu';

      dropdownItems.forEach(item => {
        const option = document.createElement('div');
        option.className = 'item';
        option.innerHTML = `<i class="fa ${item.icon}"></i> ${item.label}`;
        option.addEventListener('click', () => {
          const existingLabel = dateDiv.querySelector('.date-label');
          if (existingLabel) existingLabel.remove();

          const labelDiv = document.createElement('div');
          labelDiv.className = 'date-label';
          labelDiv.innerHTML = `<i class="fa ${item.icon}"></i> ${item.label}`;
          dateDiv.appendChild(labelDiv);

          dropdown.classList.remove('active');
        });
        menu.appendChild(option);
      });

      dropdown.appendChild(menu);
      dateDiv.appendChild(number);
      dateDiv.appendChild(dropdown);
      calendar.appendChild(dateDiv);

      dateDiv.addEventListener('click', (e) => {
        e.stopPropagation();
        closeAllDropdowns();
        dropdown.classList.toggle('active');
      });
    }
  }

  function closeAllDropdowns() {
    document.querySelectorAll('.dropdown').forEach(drop => drop.classList.remove('active'));
  }

  document.addEventListener('click', closeAllDropdowns);

  monthSelect.addEventListener('change', () => {
    currentMonth = parseInt(monthSelect.value);
    render(currentMonth, currentYear);
  });

  yearSelect.addEventListener('change', () => {
    currentYear = parseInt(yearSelect.value);
    render(currentMonth, currentYear);
  });

  populateDropdowns();
  render(currentMonth, currentYear);
}

// Initialize both calendars
initCalendar({
  calendarId: 'calendar',
  monthSelectId: 'monthSelect',
  yearSelectId: 'yearSelect'
});

initCalendar({
  calendarId: 'calendar2',
  monthSelectId: 'monthSelect2',
  yearSelectId: 'yearSelect2'
});


let rangeMin = 1; // 1 step = 30 minutes

document.querySelectorAll(".range_selector").forEach((wrapper) => {
  const range = wrapper.querySelector(".range-selected");
  const rangeInput = wrapper.querySelectorAll(".range-input input");
  const minTooltip = wrapper.querySelector(".min-tooltip");
  const maxTooltip = wrapper.querySelector(".max-tooltip");
  const rangeScale = wrapper.querySelector(".range-scale");

  function formatTime(value) {
    const totalMinutes = value * 30;
    const hours = Math.floor(totalMinutes / 60);
    const minutes = totalMinutes % 60;
    const ampm = hours >= 12 ? "PM" : "AM";
    const displayHours = hours % 12 === 0 ? 12 : hours % 12;
    const displayMinutes = minutes === 0 ? "00" : minutes;
    return `${displayHours}:${displayMinutes} ${ampm}`;
  }

  function formatTickLabel(stepIndex) {
    const totalMinutes = stepIndex * 30;
    let hours24 = Math.floor(totalMinutes / 60);
    if (hours24 === 24) hours24 = 0;

    const hours12 = hours24 % 12 === 0 ? 12 : hours24 % 12;
    const ampm = hours24 < 12 ? "AM" : "PM";
    return `${hours12}</br>${ampm}`;
  }

  rangeInput.forEach((input) => {
    input.addEventListener("input", (e) => {
      let minVal = parseInt(rangeInput[0].value);
      let maxVal = parseInt(rangeInput[1].value);

      if (maxVal - minVal < rangeMin) {
        if (e.target.className === "min") {
          rangeInput[0].value = maxVal - rangeMin;
        } else {
          rangeInput[1].value = minVal + rangeMin;
        }
      } else {
        range.style.left = (minVal / 47) * 100 + "%";
        range.style.right = 100 - (maxVal / 47) * 100 + "%";

        const minPercent = (minVal / 47) * 100;
        const maxPercent = (maxVal / 47) * 100;

        minTooltip.style.left = `calc(${minPercent}% - 10px)`;
        maxTooltip.style.left = `calc(${maxPercent}% - 10px)`;

        minTooltip.textContent = formatTime(minVal);
        maxTooltip.textContent = formatTime(maxVal);
      }
    });
  });

  // range scale
  for (let i = 0; i <= 48; i++) {
    const tick = document.createElement("div");

    // Assign classes based on type
    if (i % 8 === 0) {
      tick.classList.add("tick", "tick-large");
    } else if (i % 2 === 0) {
      tick.classList.add("tick", "tick-medium");
    } else {
      tick.classList.add("tick", "tick-small");
    }

    // Add label only on largest ticks (every 4 hours)
    if (i % 8 === 0) {
      const label = document.createElement("span");
      label.classList.add("tick-label");
      label.innerHTML = formatTickLabel(i);
      tick.appendChild(label);
    }

    rangeScale.appendChild(tick);
  }
});


// Initialize international telephone input
$("#mobile_code").intlTelInput({
  initialCountry: "sg",
  separateDialCode: true,
});

// Toggle password visibility function (for both password toggles)
$(".toggle-password, .toggle-passwordd").click(function () {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") === "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

$(function () {
  $('#date').datepicker({
    dateFormat: 'dd-M-yy',
    minDate: 1
  });

  $('.date-icon').on('click', function () {
    $('#date').focus();
  })
});

var $j = jQuery.noConflict();
$j(document).ready(function () {
  $j("#datepicker").datepicker();
});

console.log('demmm');

// Toggle switch for active/inactive text
const toggle = document.querySelector('.toggle input');
if (toggle) {
  toggle.addEventListener('click', () => {
    const onOff = toggle.parentNode.querySelector('.onoff');
    onOff.textContent = toggle.checked ? 'Active' : 'Inactive';
  });
}

// Color picker logic
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




