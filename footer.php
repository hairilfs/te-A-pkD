<footer class="main-footer">
  <div class="pull-right hidden-xs">
    Template by <a href="http://almsaeedstudio.com">Almsaeed Studio</a></strong> <b>Version</b> 2.3.0
  </div>
  <strong>Copyright &copy; 2015 &bull; Optimasi Penjadwalan Petugas Keamanan Dalam (PKD) - Stasiun Sudimara
</footer>

<!-- Control Sidebar -->
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="plugins/chartjs/Chart.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
$("#loadspin").click(function(){
  $("#newjad").after("<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>");
});

$("#about").click(function(){
  swal({
    // title: "OpaL - PKD",
    width : 500,
    height : 500,
    html :
      "<img class='img-circle' src='dist/img/cop-512.png' width='100px'><br><br>"+
      "Optimasi Penjwadwalan Petugas Keamanan Dalam (PKD)<br>Stasiun Sudimara<br><br>"+
      "Copyright &copy; 2015 &bull; Hairil Fiqri Sulaiman<br><br>"+
      // "<i class='fa fa-facebook-official'></i> <a href='https://facebook.com/hairil.f.sulaiman' target='_blank'>Hairil Fiqri Sulaiman</a><br>"+
      "<i class='fa fa-envelope'></i> <a href='mailto:hairilfiqri@gmail.com' target='_blank'>hairilfiqri@gmail.com</a>",
    // imageUrl : "dist/img/cop-512.png",
    background : "url(dist/img/graywhite.gif)"
  });
});

$(function(){
  $('#table-data').DataTable();
});
</script>

<script>
$(function(){
  $('a[href=#tab_2-2]').on('shown.bs.tab', function(){

      var areaChartData = {
        <?php
        $js_arr = json_encode($y_axis);
        echo "labels: ".$js_arr.",\n";
        ?>
        // labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
          {
            label: "Nilai Fitness",
            fillColor: "rgba(60,141,188,0.9)",
            strokeColor: "rgba(60,141,188,0.8)",
            pointColor: "#3b8bba",
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            <?php
            $js_nfit = json_encode($fit_it);
            echo "data: ".$js_nfit."\n";
            ?>
            // data: [28, 48, 40, 19, 86, 27, 90]
          }
        ]
      };

      var lineChartOptions = {
        //Boolean - If we should show the scale at all
        showScale: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: true,
        //String - Colour of the grid lines
        scaleGridLineColor: "rgba(0,0,0,.05)",
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - Whether the line is curved between points
        bezierCurve: false,
        //Number - Tension of the bezier curve between points
        bezierCurveTension: 0.1,
        //Boolean - Whether to show a dot for each point
        pointDot: true,
        //Number - Radius of each point dot in pixels
        pointDotRadius: 2,
        //Number - Pixel width of point dot stroke
        pointDotStrokeWidth: 2,
        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius: 2, //20
        //Boolean - Whether to show a stroke for datasets
        datasetStroke: true,
        //Number - Pixel width of dataset stroke
        datasetStrokeWidth: 2,
        //Boolean - Whether to fill the dataset with a color
        datasetFill: false,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true
      };

      //-------------
      //- LINE CHART -
      //--------------
      var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
      var lineChart = new Chart(lineChartCanvas);
      lineChart.Line(areaChartData, lineChartOptions);
    })
});
</script>
</body>
</html>
