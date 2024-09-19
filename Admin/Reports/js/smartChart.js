// Peak Days Chart
var peakDaysOptions = {
  chart: {
    type: 'bar',
    height: '200px',
    toolbar: { show: false }
  },
  series: [{
    data: [24, 18, 40, 36, 25, 28]
  }],
  xaxis: {
    categories: ['M', 'T', 'W', 'T', 'F', 'S'],
    labels: {
      style: {
        fontSize: '12px'
      }
    }
  },
  dataLabels: { enabled: false },
  fill: {
    colors: ['#314CFF']
  },
  plotOptions: {
    bar: {
      borderRadius: 5,
      distributed: true
    }
  }
};
var peakDaysChart = new ApexCharts(document.querySelector("#peakDaysChart"), peakDaysOptions);
peakDaysChart.render();

// Peak Hours Chart
var peakHoursOptions = {
  chart: {
    type: 'line',
    height: '200px',
    toolbar: { show: false }
  },
  series: [{
    data: [10, 15, 12, 18, 22, 25, 20]
  }],
  stroke: {
    curve: 'smooth',
    width: 2
  },
  markers: {
    size: 4,
    colors: ['#314CFF'],
    strokeColors: '#fff',
    strokeWidth: 2
  },
  xaxis: {
    categories: ['10 AM', '11 AM', '12 PM', '1 PM', '2 PM', '3 PM', '4 PM'],
    labels: {
      style: {
        fontSize: '12px'
      }
    }
  },
  dataLabels: { enabled: false },
  fill: {
    colors: ['#314CFF']
  },
  tooltip: {
    x: { format: 'HH:mm' }
  }
};
var peakHoursChart = new ApexCharts(document.querySelector("#peakHoursChart"), peakHoursOptions);
peakHoursChart.render();



// Patient Volume Per Day Chart
// Patient Volume Chart (Line Chart)
var patientVolumeOptions = {
  chart: {
    type: 'line',
    height: 300,
    toolbar: { show: false }
  },
  series: [{
    name: 'Patient Volume',
    data: [50, 45, 55, 60, 50, 48] // Example data for patient volume
  }],
  xaxis: {
    categories: ['10', '11', '12', '13', '14', '15'],
    labels: {
      show: false // We hide the X-axis labels as we have date-labels above the chart
    }
  },
  stroke: {
    curve: 'smooth',
    width: 2,
    colors: ['#314CFF']
  },
  grid: {
    show: true
  },
  tooltip: {
    enabled: true
  },
  yaxis: {
    labels: {
      style: {
        colors: '#314CFF',
        fontSize: '12px'
      }
    }
  }
};

var patientVolumeChart = new ApexCharts(document.querySelector("#patientVolumeChart"), patientVolumeOptions);
patientVolumeChart.render();
