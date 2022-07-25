

{{-- @extends('adminlte') --}}
@push('graph-data-content')

   <!-- ChartJS -->
   <script src="{{asset("assets/plugins/chart.js/Chart.min.js")}}"></script>
<script>
$(function () {
    // {{-- // var cData = JSON.parse(`<?php echo $chart_data; ?>`);--}}
    /* ChartJS
     * ------- 
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------  [28, 48, 40, 19, 86, 27, 90] {{$sales_graph_data}}

    // Get context with jQuery - using jQuery's .get() method. ['July', 'August', 'September', 'October', 'Nomvember', 'December', 'January 2023'],
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['July', 'August', 'September', 'October', 'Nomvember', 'December', 'January 2023'],
      // cData.label,
      datasets: [
        {
          label               : 'Sales',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                :  [28, 48, 40, 19, 86, 27, 90]
          // cData.data,
        },
        {
          label               : 'Houses',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                :  [65, 59, 80, 81, 56, 55, 40]
          // cData.data, {{$sales_graph_data}}
          // [65, 59, 80, 81, 56, 55, 40]
          
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

     // This will get the first returned node in the jQuery collection.
     new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })
  })

  </script>
  @endpush