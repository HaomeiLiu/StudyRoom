 // Start chart
var chartDay = document.getElementById('chart-day');
Chart.defaults.global.animation.duration = 1500; // Animation duration
Chart.defaults.global.title.display = false; // Remove title
Chart.defaults.global.title.text = "Daily Focus Time Distribution"; // Title
Chart.defaults.global.defaultFontColor = '#FAFAFF'; // Font color
Chart.defaults.global.defaultFontSize = 10; // Font size for every label

// Chart.defaults.global.tooltips.backgroundColor = '#FFF'; // Tooltips background color
Chart.defaults.global.tooltips.borderColor = 'white';
// Tooltips border color
Chart.defaults.global.legend.labels.padding = 0;
Chart.defaults.scale.ticks.beginAtZero = true;
Chart.defaults.scale.gridLines.zeroLineColor = 'rgba(255, 255, 255, 0.1)';
Chart.defaults.scale.gridLines.color = 'rgba(255, 255, 255, 0.02)';
Chart.defaults.global.legend.display = false;

var myChart = new Chart(chartDay, {
    type: 'bar',
    data: {
        labels: ["0-2", "2-4", "4-6", "6-8", "8-10", '10-12', '12-14', '14-16', '16-18', '18-20', '20-22', '22-24'],
        datasets: [{
            label: "Success",
            fill: false,
            lineTension: 0,
            data: [30, 0, 120, 0, 45, 0, 0, 0, 60, 0, 0, 0],
            pointBorderColor: "#177E89",
            borderColor: '#177E89',
            borderWidth: 2,
            showLine: true,
        }, {
            label: "Abort",
            fill: false,
            lineTension: 0,
            startAngle: 2,
            data: [30, 0, 0, 0, 0, 20, 0, 0, 0, 0, 0, 0],
            backgroundColor: "transparent",
            pointBorderColor: "#ff6384",
            borderColor: '#ff6384',
            borderWidth: 2,
            showLine: true,
        }]
    },
});

//  Chart ( 2 )
var chartWeek = document.getElementById('chart-week');
var myChart = new Chart(chartWeek, {
    type: 'bar',
    data: {
        labels: ["Mon", "Tue", "Wed", "Thu", 'Fri', 'Sat', 'Sun'],
        datasets: [{
            label: "Success",
            fill: false,
            lineTension: 0,
            data: [70, 120, 180, 0, 60, 80, 0],
            pointBorderColor: "#177E89",
            borderColor: '#177E89',
            borderWidth: 2,
            showLine: true,
        }, {
            label: "Abort",
            fill: false,
            lineTension: 0,
            startAngle: 2,
            data: [0, 0, 60, 0, 0, 90, 120],
            backgroundColor: "transparent",
            pointBorderColor: "#ff6384",
            borderColor: '#ff6384',
            borderWidth: 2,
            showLine: true,
        }]
    },
});
