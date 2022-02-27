function chartBar (colors) {

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
});
}