function PerCountry() {

  google.charts.load('current', {
    'packages':['geochart'],
  });
  google.charts.setOnLoadCallback(drawRegionsMap);

  function drawRegionsMap() {
    var data = google.visualization.arrayToDataTable(
        // <?php  print_r(json_encode($chartMapData)); ?>
    );

    var options = {
        colorAxis: {
            colors: ["green", "red"]
        },
        legend: 'none',
        
    };

    var chart = new google.visualization.GeoChart(document.getElementById('chart-per-country'));

    chart.draw(data, options);
  }

}

function PerDevice() {

  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable(
      // <?php  print_r(json_encode($chartDeviceData)); ?>
    );
        
    var options = { 
      pieHole: 0.6,
      width: '100%',
      height: '100%',
      colors: [mainColor, secondColor, thirdColor],
      pieSliceText: "none",
      legend: {
        position : 'bottom',
        alignment: 'center',
      }  
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('chart-per-device'));

    chart.draw(data, options);
  }

  function PerWeek() {
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawStuff);

    function drawStuff() {
      var data = new google.visualization.arrayToDataTable(
        // <?php  print_r(json_encode($chartWeekData)); ?>
      );

      var options = {
        legend: { position: 'none' },
        colors: [mainColor],
        hAxis: {textStyle: {
          color: 'black', 
          fontSize: 16,
          fontWidth: 'bold'
        }},
        vAxis: {
          textPosition: 'none',
        },
        axes: {
          x: {
            0: { side: 'bottom', label: ''} // Top x-axis.
          },
        },
        bar: { groupWidth: "80%" },
        backgroundColor: '#E4E4E4'
      };

      var chart = new google.charts.Bar(document.getElementById('chart-per-week'));
      chart.draw(data, google.charts.Bar.convertOptions(options));
    };
  }

}