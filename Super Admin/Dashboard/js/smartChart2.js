async function fetchData(endpoint) {
    try {
      const response = await fetch(endpoint);
      if (!response.ok) throw new Error('Failed to fetch data');
      return await response.json();
    } catch (error) {
      console.error('Error fetching data:', error);
      return null;
    }
  }
  
  async function renderCharts() {
    // Peak Days Chart
    const peakDaysData = await fetchData('report_data/peak_days.php');
    if (peakDaysData) {
      const peakDaysOptions = {
        chart: { type: 'bar', height: '200px', toolbar: { show: false } },
        series: [{ data: peakDaysData.series }],
        xaxis: {
          categories: peakDaysData.categories,
          labels: { style: { fontSize: '12px' } }
        },
        dataLabels: { enabled: false },
        fill: { colors: ['#314CFF'] },
        plotOptions: { bar: { borderRadius: 5, distributed: true } }
      };
      const peakDaysChart = new ApexCharts(document.querySelector("#peakDaysChart"), peakDaysOptions);
      peakDaysChart.render();
    }
  
    // Peak Hours Chart
    const peakHoursData = await fetchData('report_data/peak_hours.php');
    if (peakHoursData) {
      const peakHoursOptions = {
        chart: { type: 'line', height: '200px', toolbar: { show: false } },
        series: [{ data: peakHoursData.series }],
        stroke: { curve: 'smooth', width: 2 },
        markers: { size: 4, colors: ['#314CFF'], strokeColors: '#fff', strokeWidth: 2 },
        xaxis: {
          categories: peakHoursData.categories,
          labels: { style: { fontSize: '12px' } }
        },
        dataLabels: { enabled: false },
        fill: { colors: ['#314CFF'] },
        tooltip: { x: { format: 'HH:mm' } }
      };
      const peakHoursChart = new ApexCharts(document.querySelector("#peakHoursChart"), peakHoursOptions);
      peakHoursChart.render();
    }
  
    // Patient Volume Chart
    const patientVolumeData = await fetchData('report_data/patient_volume.php');
    if (patientVolumeData) {
      const patientVolumeOptions = {
        chart: { type: 'line', height: 300, toolbar: { show: false } },
        series: [{ name: 'Patient Volume', data: patientVolumeData.series }],
        xaxis: {
          categories: patientVolumeData.categories,
          labels: { show: false }
        },
        stroke: { curve: 'smooth', width: 2, colors: ['#314CFF'] },
        grid: { show: true },
        tooltip: { enabled: true },
        yaxis: {
          labels: { style: { colors: '#314CFF', fontSize: '12px' } }
        }
      };
      const patientVolumeChart = new ApexCharts(document.querySelector("#patientVolumeChart"), patientVolumeOptions);
      patientVolumeChart.render();
    }
  }
  
  // Render all charts
  renderCharts();
  