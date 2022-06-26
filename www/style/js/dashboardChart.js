// ChartJS BAR
function chartBar1 () {

  const ctx = document.getElementById('chartBar');
  const chartBar = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Mon', 'Thu', 'Wen', 'Thi', 'Fri', 'Sat', 'Sun'],  
      datasets: [{
        borderRadius: 20,
        borderSkipped: false,
        label: '',
        data: [12, 19, 3, 5, 2, 3, 9],
        backgroundColor: [
          'rgb(57, 96, 117)',
          'rgb(57, 96, 117, 0.5)',
          'rgb(57, 96, 117, 0.2)'
        ],
      }]
    },
    options: {
      plugins: {
        legend: {
          display: false
        },
        datalabels: {
          display: true,
          anchor: 'end'
        },
      },
      scales: {
        x: {
          grid: {
            display: false
          }
        },
        y: {
          display: false,
          grid: {
            display: false
          }
        }
      }
    }
  })
}

// ChartJS DONUT
function chartDonut1(){
  const data = {
    labels: [
      'Mobile',
      'Desktop',
      'Other'
    ],
    datasets: [{
      label: 'My First Dataset',
      data: [300, 50, 100],
      backgroundColor: [
        'rgb(57, 96, 117)',
        'rgb(57, 96, 117, 0.5)',
        'rgb(57, 96, 117, 0.2)'
      ],
      hoverOffset: 4
    }]
  };
  // margin
  const legendMargin = {
    id: 'legendMargin',
    beforeInit(chart, legend, options) {
      const fitValue = chart.legend.fit;
  
      chart.legend.fit = function fit() {
        fitValue.bind(chart.legend)();
        return this.height += 80;
      }
    }
  }
  const config = {
    type: 'doughnut',
    data: data,
    options: {
      plugins: {
        legend: {
          position: 'top',
          labels: {
            align: 'center',
            boxHeight: 35,
            boxWidth: 90,
            padding: 5,
            borderRadius: 20,
            font: {
              size: 20,
              weight: 'bold',
            }
          },
        },
      }
    },
    plugins: [legendMargin]
  };
  const myChartDonut = new Chart(
    document.getElementById('chartDonut'),
    config
  );
}

// CHART MAP 
// google.charts.load('current', {'packages':['geochart']});
// google.charts.setOnLoadCallback(drawRegionsMap);

// google.charts.load('current', {
//   'packages':['geochart'],
// });
// google.charts.setOnLoadCallback(drawRegionsMap);

// function drawRegionsMap(country) {
//   var data = google.visualization.arrayToDataTable([
//   ['Country',{role: 'annotation'}],
//   country

//   ]);

//   var options = {
      
//   };

//   var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

//   chart.draw(data, options);
// }
