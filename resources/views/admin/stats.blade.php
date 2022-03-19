@extends('layouts.admin_layout')

@section('content')
<!-- big container (this is for the content) -->
<div class="col-9 big_con">
    <div class="big_main_con">
        
        <!-- topbar here -->
        <div class="row top_search_area" >
            <div class="col-7" style="margin:auto !important; ">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" style="display: none;" placeholder="Search" aria-label="" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" style="display: none;" type="button">Search</button>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <img src="/storage/profile_images/{{Auth::user()->profileImage}}" alt="" class="profile_img_top">
            </div>
        </div>
        <!-- /topbar here -->

        <!-- body here -->
        <div class="row">
          <div class="message_con">
            <div class="row msg_row">
              <div class="col-8 con-stats">
                
              <div class="container_stats">
              
                <div class="con-stats2" style="">

                  <div class="row stats-title">
                    <div class="col" style="margin: 10px 0 0 20px;font-weight:bold;">
                      Donation Monitoring Based on Number of Posts
                    </div>
                  </div>

                  <div class="panel-body">

                    <div class="grid-container">
                      <div class="grid-child purple" id="pie_chart1" style="width:500px; height:350px; position:relative;">

                      </div>

                      <div class="grid-child purple" id="pie_chart2" style="width:500px; height:350px; position:relative;">

                      </div>

                      <div class="grid-child purple" id="pie_chart3" style="width:500px; height:350px;position:relative;">

                      </div>

                      <div class="grid-child purple" id="pie_chart4" style="width:500px; height:350px;position:relative;">

                      </div>
                    </div>
                  </div>
                </div>
              </div>
                
              </div>
            </div>
          </div>
        </div>
        <!-- /body here -->
    </div>
</div>
<!-- /big container (this is for the content) -->

<script type="text/javascript">
    var analytics1 = <?php echo $category; ?>

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
    {
        var data = google.visualization.arrayToDataTable(analytics1);
        var options = {
            title : 'Percentage of Post Categories'
        };
        var chart1 = new google.visualization.PieChart(document.getElementById('pie_chart1'));
        chart1.draw(data, options);
    }
</script>
<script type="text/javascript">
    var analytics2 = <?php echo $city; ?>

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
    {
        var data = google.visualization.arrayToDataTable(analytics2);
        var options = {
            title : 'Percentage of Cities'
        };
        var chart1 = new google.visualization.PieChart(document.getElementById('pie_chart2'));
        chart1.draw(data, options);
    }
</script>
<script type="text/javascript">
    var analytics3 = <?php echo $barangay1; ?>

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
    {
        var data = google.visualization.arrayToDataTable(analytics3);
        var options = {
            title : 'Percentage of Mandaue Barangays'
        };
        var chart1 = new google.visualization.PieChart(document.getElementById('pie_chart3'));
        chart1.draw(data, options);
    }
</script>
<script type="text/javascript">
    var analytics4 = <?php echo $barangay2; ?>

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
    {
        var data = google.visualization.arrayToDataTable(analytics4);
        var options = {
            title : 'Percentage of Lapu-Lapu Barangays'
        };
        var chart1 = new google.visualization.PieChart(document.getElementById('pie_chart4'));
        chart1.draw(data, options);
    }
</script>
@endsection