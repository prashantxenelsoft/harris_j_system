// const ctx = document.getElementById('residenceChart').getContext('2d');
// const data = {
//   labels: ['Nationality', 'Permanent Resident', 'Employment Pass holders'],
//   datasets: [{
//     data: [200, 20, 50], // Adjust values if needed
//     backgroundColor: ['#2ecc71', '#f39c12', '#e74c3c'],
//     borderWidth: 1
//   }]
// };

// new Chart(ctx, {
//   type: 'pie',
//   data: data,
//   options: {
//     responsive: false,
//     plugins: {
//       legend: {
//         display: false
//       }
//     }
//   }
// });

// const consultancyChart = document.getElementById('consultancyChart').getContext('2d');
// const dataconsultancyChart = {
//   labels: ['Nationality', 'Permanent Resident', 'Employment Pass holders'],
//   datasets: [{
//     data: [200, 20, 50], // Adjust values if needed
//     backgroundColor: ['#2ecc71', '#f39c12', '#e74c3c'],
//     borderWidth: 1
//   }]
// };

// new Chart(consultancyChart, {
//   type: 'pie',
//   data: dataconsultancyChart, // Use the correct variable here
//   options: {
//     responsive: false,
//     plugins: {
//       legend: {
//         display: false
//       }
//     }
//   }
// });


const createPieChart = (ctx, labels, data, backgroundColors) => {
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          data: data,
          backgroundColor: backgroundColors,
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
  };
  
  // Usage with null checks
  
  const timesheetEl = document.getElementById('timesheetChart');
  if (timesheetEl) {
    const timesheet = timesheetEl.getContext('2d');
    createPieChart(timesheet, ['Approved', 'Submitted (Unapproved)', 'Rejected'], [240, 50, 0], ['#2563eb', '#16a34a', '#ef4444']);
  }
  
  const workingEl = document.getElementById('workingChart');
  if (workingEl) {
    const ctxx = workingEl.getContext('2d');
    createPieChart(ctxx, ['Hours Logged', 'Remaining Hours'], [42, 126], ['#22c55e', '#f97316']);
  }
  
  const residenceEl = document.getElementById('residenceChart');
  if (residenceEl) {
    const hrchart = residenceEl.getContext('2d');
    createPieChart(hrchart, ['Nationality', 'Permanent Resident', 'Employment Pass holders'], [200, 20, 80], ['#28a745', '#fd7e14', '#dc3545']);
  }
  
  const consultancyEl = document.getElementById('consultancyChart');
  if (consultancyEl) {
    const ctxxx = consultancyEl.getContext('2d');
    createPieChart(ctxxx, ['Active', 'Disabled', 'Blocked', 'Offboarded'], [100, 5, 10, 6], ['green', 'orange', 'red', '#007bff']);
  }

  
  const ctx = document.getElementById('mixedChart').getContext('2d');

    const data = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          type: 'bar',
          label: 'Dataset Green',
          data: [-400, 100, -700, -500, -600, -300, 600],
          backgroundColor: '#A9F4D0B2'
          
        },
        {
          type: 'bar',
          label: 'Dataset Blue',
          data: [-600, 400, 800, 700, -200, 500, 300],
          backgroundColor: '#AEC9FEB2',
          order: 1 // bar behind
        },
        {
          type: 'line',
          label: 'Line Dataset',
          data: [-500, 400, 500, 200, 400, 300, -600],
          borderColor: '#FEAEAEB2',
          backgroundColor: '#FEAEAEB2',
          borderWidth: 2,
          fill: false,
          tension: 0.3,
          pointBackgroundColor: '#FEAEAEB2',
          pointBorderColor: '#fff',
          pointRadius: 6,
          pointHoverRadius: 8
        }
      ]
    };

    const options = {
        responsive: false,
        plugins: {
          legend: {
            display: false // 👈 disables the legend
          }
        },
        scales: {
          y: {
            min: -1000,
            max: 1000,
            ticks: {
              stepSize: 500
            }
          }
        }
      };

    new Chart(ctx, {
      data: data,
      options: options
    });