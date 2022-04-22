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
              <div class="col-12 con-stats">
                
              <div class="container_stats">
              
                <div class="con-stats2" style="">


                    <!-- daily monitoring -->
                    <div class="row stats-title">
                        <div class="col" style="margin: 10px 0 0 20px;font-weight:bold;">
                        Donation Monitoring (Daily)
                        </div>
                    </div>

                    
                    <div class="panel-body" style="display:flex;">

                        <div class="grid-container" >
                            <div class="row" style="width:1000px;">
                                <div class="col-4">
                                    <div class="grid-child purple" id="pie_chart2" style="width:400px; height:250px;position:relative;margin-left:-30px;"></div>
                                </div>
                                <div class="col-4">
                                    <div class="grid-child purple" id="pie_chart3" style="width:400px; height:250px;position:relative;margin-left:-30px;"></div>
                                </div>
                                <div class="col-4">
                                    <div class="grid-child purple" id="pie_chart4" style="width:400px; height:250px;position:absolute;margin-left:-30px;float:right;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- daily monitoring end -->



                    <!-- weekly monitoring -->
                    <div class="row stats-title">
                        <div class="col" style="margin: 10px 0 0 20px;font-weight:bold;">
                        Donation Monitoring (Weekly)
                        </div>
                    </div>

                    
                    <div class="panel-body" style="display:flex;">

                        <div class="grid-container" >
                            <div class="row" style="width:1000px;">
                                <div class="col-4">
                                    <div class="grid-child purple" id="wpie_chart2" style="width:400px; height:250px;position:relative;margin-left:-30px;"></div>
                                </div>
                                <div class="col-4">
                                    <div class="grid-child purple" id="wpie_chart3" style="width:400px; height:250px;position:relative;margin-left:-30px;"></div>
                                </div>
                                <div class="col-4">
                                    <div class="grid-child purple" id="wpie_chart4" style="width:400px; height:250px;position:absolute;margin-left:-30px;float:right;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- weekly monitoring end -->



                    <!-- monthly monitoring -->
                    <div class="row stats-title">
                        <div class="col" style="margin: 10px 0 0 20px;font-weight:bold;">
                        Donation Monitoring (Monthly)
                        </div>
                    </div>

                    <div class="panel-body" style="display:flex;">

                        <div class="grid-container" >
                            <div class="row" style="width:1000px;">
                                <div class="col-4">
                                    <div class="grid-child purple" id="mpie_chart2" style="width:400px; height:250px;position:relative;margin-left:-30px;"></div>
                                </div>
                                <div class="col-4">
                                    <div class="grid-child purple" id="mpie_chart3" style="width:400px; height:250px;position:relative;margin-left:-30px;"></div>
                                </div>
                                <div class="col-4">
                                    <div class="grid-child purple" id="mpie_chart4" style="width:400px; height:250px;position:absolute;margin-left:-30px;float:right;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- monthly monitoring end -->

                    

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
    var analytics2 = <?php echo $city; ?>

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
    {
        var data = google.visualization.arrayToDataTable(analytics2);
        var options = {
            title : 'Donations per Cities',
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
            title : 'Donations in Mandaue'
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
            title : 'Donations in Lapu-Lapu'
        };
        var chart1 = new google.visualization.PieChart(document.getElementById('pie_chart4'));
        chart1.draw(data, options);
    }
</script>





<!-- WEEKLY CHART -->
<script type="text/javascript">
    var wanalytics2 = <?php echo $wcity; ?>

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
    {
        var data = google.visualization.arrayToDataTable(wanalytics2);
        var options = {
            title : 'Donations per Cities',
        };
        var chart1 = new google.visualization.PieChart(document.getElementById('wpie_chart2'));
        chart1.draw(data, options);
    }
</script>
<script type="text/javascript">
    var wanalytics3 = <?php echo $wbarangay1; ?>

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
    {
        var data = google.visualization.arrayToDataTable(wanalytics3);
        var options = {
            title : 'Donations in Mandaue'
        };
        var chart1 = new google.visualization.PieChart(document.getElementById('wpie_chart3'));
        chart1.draw(data, options);
    }
</script>
<script type="text/javascript">
    var wanalytics4 = <?php echo $wbarangay2; ?>

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
    {
        var data = google.visualization.arrayToDataTable(wanalytics4);
        var options = {
            title : 'Donations in Lapu-Lapu'
        };
        var chart1 = new google.visualization.PieChart(document.getElementById('wpie_chart4'));
        chart1.draw(data, options);
    }
</script>






<!-- MONTHLY CHART -->
<script type="text/javascript">
    var manalytics2 = <?php echo $mcity; ?>

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
    {
        var data = google.visualization.arrayToDataTable(manalytics2);
        var options = {
            title : 'Donations per Cities',
        };
        var chart1 = new google.visualization.PieChart(document.getElementById('mpie_chart2'));
        chart1.draw(data, options);
    }
</script>
<script type="text/javascript">
    var manalytics3 = <?php echo $mbarangay1; ?>

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
    {
        var data = google.visualization.arrayToDataTable(manalytics3);
        var options = {
            title : 'Donations in Mandaue'
        };
        var chart1 = new google.visualization.PieChart(document.getElementById('mpie_chart3'));
        chart1.draw(data, options);
    }
</script>
<script type="text/javascript">
    var manalytics4 = <?php echo $mbarangay2; ?>

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart()
    {
        var data = google.visualization.arrayToDataTable(manalytics4);
        var options = {
            title : 'Donations in Lapu-Lapu'
        };
        var chart1 = new google.visualization.PieChart(document.getElementById('mpie_chart4'));
        chart1.draw(data, options);
    }
</script>
@endsection