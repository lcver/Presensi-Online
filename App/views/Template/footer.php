        </div><!-- /.pt-3 -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.4
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?=BASEPATH?>vendor/almasaeed2010/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=BASEPATH?>vendor/almasaeed2010/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- <script>
  $.widget.bridge('uibutton', $.ui.button)
</script> -->
<!-- jQuery -->
<script src="<?=BASEPATH?>vendor/almasaeed2010/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=BASEPATH?>vendor/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?=BASEPATH?>vendor/almasaeed2010/adminlte/plugins/chart.js/Chart.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=BASEPATH?>vendor/almasaeed2010/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=BASEPATH?>vendor/almasaeed2010/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=BASEPATH?>vendor/almasaeed2010/adminlte/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=BASEPATH?>vendor/almasaeed2010/adminlte/dist/js/demo.js"></script>
<!-- FLOT CHARTS -->
<script src="<?=BASEPATH?>vendor/almasaeed2010/adminlte/plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?=BASEPATH?>vendor/almasaeed2010/adminlte/plugins/flot-old/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?=BASEPATH?>vendor/almasaeed2010/adminlte/plugins/flot-old/jquery.flot.pie.min.js"></script>
<script>
  function pieChart()
  {
    $.get('http://localhost/project/Abdar/public/pengurus/jumlah', function(data) {  
        var requestData = $.parseJSON(data);
      /* ChartJS
      * -------
      * Here we will create a few charts using ChartJS
      */
      // Get context with jQuery - using jQuery's .get() method.
      var donutData        = {
        labels: [
            'TPQ AL-HAFIDHUN',
            'TPQ AL-MUHSININ',
            'TPQ AL-ICHSAN',
            'TPQ H. M. NURUDDIN',
            'TPQ AL-FIRDAUS',
            'TPQ ANNAFIU',
            'TPQ BAITUL ISTIQOMAH',
            'TPQ ASSYUHADA',
        ],
        datasets: [
          {
            // data: [1,0,2,0,1,0,0,3],
            data: requestData,
            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', 'green','blue'],
          }
        ]
      }
      //-------------
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      var pieData        = donutData;
      var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
      })
    });
  }
</script>
</body>
</html>