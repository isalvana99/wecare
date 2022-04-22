@extends('layouts.admin_layout')

@section('content')
<!-- big container (this is for the content) -->
<div class="col-9 big_con">
    <div class="big_main_con">
        
        <!-- topbar here -->
        <div class="row top_search_area2" >
            <div class="col-5 top_datetime2">
                <div class="row top_date_row2">
                    <script> document.write(new Date().toDateString()); </script>
                </div>
                <div class="row top_time_row2" id="datetime">
                </div>
            </div>
            <div class="col-6"  >
                <div class="row">
                    
                    <div class="col-9">
                    <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit" id="top_admin_logout2">Logout <i class="fal fa-sign-out"></i></button></form>
                    </div>
                    
                    <div class="col-3">
                        <img src="/storage/profile_images/{{Auth::user()->profileImage}}" alt="" class="profile_img_top2">
                    </div>
                </div> 
            </div>
        </div>
        <!-- /topbar here -->

        <!-- body here -->
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">
                            <h5>Donation Monitoring</h5>
                            <form action="{{route('Donation Monitoring')}}">
                            <label for="">You are viewing: </label>
                            <select name="viewmonitoring"  onchange="this.form.submit()">
                                <option value="{{$viewmonitoring == '' ? 'This Month' : $viewmonitoring}}" hidden selected>{{$viewmonitoring == "" ? 'Daily' : $viewmonitoring}}</option>
                                <option value="Daily">Daily</option>
                                <option value="Weekly">Weekly</option>
                                <option value="Monthly">Monthly</option>
                                <option value="Yearly">Yearly</option>
                            </select>
                            </form>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($viewmonitoring == "Daily" || $viewmonitoring == "")
                    <tr>
                        <td>
                            <label for="">Daily Monitoring</label>
                            <div style="float:right;display:flex;">
                                <form action="{{route('Donation Monitoring')}}" style="">
                                <input type="hidden" name="viewmonitoring" value="{{$viewmonitoring}}">
                                <label for="">You are viewing :</label>&nbsp;
                                <input type="date" value="{{$daychoice == '' ? date('Y-m-d') : $daychoice}}" name="daychoice">
                                <input type="submit" value="OK">
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- Monthly Cities -->
                            <div class="col-11 dash_line_con">
                                <div class="container my-4">
                                    <div>
                                        <canvas id="lineChartcity"></canvas>
                                    </div>
                                </div>
                            </div>

                            <!-- Monthly MC -->
                            <div class="col-11 dash_line_con">
                                <div class="container my-4">
                                    <div>
                                        <canvas id="lineChartb1"></canvas>
                                    </div>
                                </div>
                            </div>

                            <!-- Monthly LLC -->
                            <div class="col-11 dash_line_con">
                                <div class="container my-4">
                                    <div>
                                        <canvas id="lineChartb2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @elseif($viewmonitoring == "Weekly")
                    <tr>
                        <td>
                            <label for="">Weekly Monitoring</label>
                            <div style="float:right;">
                                <form action="{{route('Donation Monitoring')}}" style="">
                                <label for="">You are viewing : </label>&nbsp;
                                <input type="hidden" name="viewmonitoring" value="{{$viewmonitoring}}">
                                <input type="week" value="{{date('Y').'-W'.date('W')}}" name="weekchoice">
                                <input type="submit" value="OK">
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- Weekly Cities -->
                            <div class="col-11 dash_line_con">
                                <div class="container my-4">
                                    <div>
                                        <canvas id="lineChartwcity"></canvas>
                                    </div>
                                </div>
                            </div>

                            <!-- Weekly MC -->
                            <div class="col-11 dash_line_con">
                                <div class="container my-4">
                                    <div>
                                        <canvas id="lineChartwb1"></canvas>
                                    </div>
                                </div>
                            </div>

                            <!-- Weekly LLC -->
                            <div class="col-11 dash_line_con">
                                <div class="container my-4">
                                    <div>
                                        <canvas id="lineChartwb2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @elseif($viewmonitoring == "Monthly")
                    <tr>
                        <td>
                            <label for="">Monthly Monitoring</label>
                            <div style="float:right;">
                                <form action="{{route('Donation Monitoring')}}" style="">
                                <input type="hidden" name="viewmonitoring" value="{{$viewmonitoring}}">
                                <label for="">You are viewing : </label>
                                <input type="month" name="monthchoice" value="{{$monthchoice == ''? date('Y-m') : $monthchoice}}">
                                <input type="submit" value="OK">
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- Monthly Cities -->
                            <div class="col-11 dash_line_con">
                                <div class="container my-4">
                                    <div>
                                        <canvas id="lineChartmcity"></canvas>
                                    </div>
                                </div>
                            </div>

                            <!-- Monthly MC -->
                            <div class="col-11 dash_line_con">
                                <div class="container my-4">
                                    <div>
                                        <canvas id="lineChartmb1"></canvas>
                                    </div>
                                </div>
                            </div>

                            <!-- Monthly LLC -->
                            <div class="col-11 dash_line_con">
                                <div class="container my-4">
                                    <div>
                                        <canvas id="lineChartmb2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @elseif($viewmonitoring == "Yearly")
                    <tr>
                        <td>
                            <label for="">Yearly Monitoring</label>
                            <div style="float:right;">
                                <form action="{{route('Donation Monitoring')}}" style="">
                                <label for="">You are viewing : Year</label>&nbsp;
                                <input type="hidden" name="viewmonitoring" value="{{$viewmonitoring}}">
                                <input type="number" min="2020" max="2099" step="1" value="{{$yearchoice == ''? date('Y') : $yearchoice}}" name="yearchoice">
                                <input type="submit" value="OK">
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- Yearly Cities -->
                            <div class="col-11 dash_line_con">
                                <div class="container my-4">
                                    <div>
                                        <canvas id="lineChartycity"></canvas>
                                    </div>
                                </div>
                            </div>

                            <!-- Yearly MC -->
                            <div class="col-11 dash_line_con">
                                <div class="container my-4">
                                    <div>
                                        <canvas id="lineChartyb1"></canvas>
                                    </div>
                                </div>
                            </div>

                            <!-- Yearly LLC -->
                            <div class="col-11 dash_line_con">
                                <div class="container my-4">
                                    <div>
                                        <canvas id="lineChartyb2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /body here -->
    </div>
</div>
<!-- /big container (this is for the content) -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
<script>
function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}
document.getElementById("datetime").innerHTML =formatAMPM(new Date);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<!-- THIS MONTH -->
<script>
    var thismcity = <?php echo $city ?>;
    var b1 = @json($b1);
    var b2 = @json($b2);
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var d = new Date();
    var ctxL = document.getElementById("lineChartcity").getContext('2d');
    var myLineChart = new Chart(ctxL, {
    type: 'bar',
    data: {
      labels: ['Mandaue City', 'Lapu-Lapu City'],
      datasets: [{
          label: @json($date00),
          data: thismcity,
          backgroundColor: ['#6df0d13f','#6df0d13f'],
        hoverOffset: 6,
          borderColor: ['#1de4bd','#1de4bd'],
          color: [
              'rgb(255, 255, 255)'
          ],
          
          borderWidth: 2
        },
        // {
        //   label: "Month of "+ months[d.getMonth()-1],
        //   data: prevmcity,
        //   backgroundColor: ['#e7e24e3f','#e7e24e3f'],
        //   hoverOffset: 6,
        //   borderColor: ['#eabd3b','#eabd3b'],
        //   color: [
        //       'rgb(255, 255, 255)'
        //   ],
          
        //   borderWidth: 2
        // }
      ]
    },
    options: {
        legend: {
            labels: {
                fontColor: "white",
            }
        },
      scales: {
            xAxes: [{ 
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff", // this here
                },
            }],
            yAxes: [{
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff",
                  beginAtZero: true,
                },
            }],
        },
    }
  });
</script>
<script>
    var thismcity = <?php echo $barangay1 ?>;
    var b1 = @json($b1);
    var b2 = @json($b2);
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var d = new Date();
    var ctxL = document.getElementById("lineChartb1").getContext('2d');
    var myLineChart = new Chart(ctxL, {
    type: 'bar',
    data: {
      labels: b1,
      datasets: [{
          label: @json($date00),
          data: thismcity,
          backgroundColor: ['#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f'],
        hoverOffset: 6,
          borderColor: ['#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd'],
          color: [
              'rgb(255, 255, 255)'
          ],
          
          borderWidth: 2
        },
      ]
    },
    options: {
        legend: {
            labels: {
                fontColor: "white",
            }
        },
      scales: {
            xAxes: [{ 
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff", // this here
                },
            }],
            yAxes: [{
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff",
                  beginAtZero: true,
                },
            }],
        },
    }
  });
</script>
<script>
    var thismcity = <?php echo $barangay2 ?>;
    var b1 = @json($b1);
    var b2 = @json($b2);
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var d = new Date();
    var ctxL = document.getElementById("lineChartb2").getContext('2d');
    var myLineChart = new Chart(ctxL, {
    type: 'bar',
    data: {
      labels: b2,
      datasets: [{
          label: @json($date00),
          data: thismcity,
          backgroundColor: ['#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f'],
        hoverOffset: 6,
          borderColor: ['#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd'],
          color: [
              'rgb(255, 255, 255)'
          ],
          
          borderWidth: 2
        },
      ]
    },
    options: {
        legend: {
            labels: {
                fontColor: "white",
            }
        },
      scales: {
            xAxes: [{ 
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff", // this here
                },
            }],
            yAxes: [{
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff",
                  beginAtZero: true,
                },
            }],
        },
    }
  });
</script>

<!-- THIS WEEK -->
<script>
    var thismcity = <?php echo $wcity ?>;
    var b1 = @json($b1);
    var b2 = @json($b2);
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var d = new Date();
    var ctxL = document.getElementById("lineChartwcity").getContext('2d');
    var myLineChart = new Chart(ctxL, {
    type: 'bar',
    data: {
      labels: ['Mandaue City', 'Lapu-Lapu City'],
      datasets: [{
          label: "(Week) "+@json($sdate)+" - "+@json($edate),
          data: thismcity,
          backgroundColor: ['#6df0d13f','#6df0d13f'],
        hoverOffset: 6,
          borderColor: ['#1de4bd','#1de4bd'],
          color: [
              'rgb(255, 255, 255)'
          ],
          
          borderWidth: 2
        },
        // {
        //   label: "Month of "+ months[d.getMonth()-1],
        //   data: prevmcity,
        //   backgroundColor: ['#e7e24e3f','#e7e24e3f'],
        //   hoverOffset: 6,
        //   borderColor: ['#eabd3b','#eabd3b'],
        //   color: [
        //       'rgb(255, 255, 255)'
        //   ],
          
        //   borderWidth: 2
        // }
      ]
    },
    options: {
        legend: {
            labels: {
                fontColor: "white",
            }
        },
      scales: {
            xAxes: [{ 
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff", // this here
                },
            }],
            yAxes: [{
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff",
                  beginAtZero: true,
                },
            }],
        },
    }
  });
</script>
<script>
    var thismcity = <?php echo $wbarangay1 ?>;
    var b1 = @json($b1);
    var b2 = @json($b2);
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var d = new Date();
    var ctxL = document.getElementById("lineChartwb1").getContext('2d');
    var myLineChart = new Chart(ctxL, {
    type: 'bar',
    data: {
      labels: b1,
      datasets: [{
          label: "(Week) "+@json($sdate)+" - "+@json($edate),
          data: thismcity,
          backgroundColor: ['#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f'],
        hoverOffset: 6,
          borderColor: ['#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd'],
          color: [
              'rgb(255, 255, 255)'
          ],
          
          borderWidth: 2
        },
      ]
    },
    options: {
        legend: {
            labels: {
                fontColor: "white",
            }
        },
      scales: {
            xAxes: [{ 
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff", // this here
                },
            }],
            yAxes: [{
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff",
                  beginAtZero: true,
                },
            }],
        },
    }
  });
</script>
<script>
    var thismcity = <?php echo $wbarangay2 ?>;
    var b1 = @json($b1);
    var b2 = @json($b2);
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var d = new Date();
    var ctxL = document.getElementById("lineChartwb2").getContext('2d');
    var myLineChart = new Chart(ctxL, {
    type: 'bar',
    data: {
      labels: b2,
      datasets: [{
          label: "(Week) "+@json($sdate)+" - "+@json($edate),
          data: thismcity,
          backgroundColor: ['#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f'],
        hoverOffset: 6,
          borderColor: ['#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd'],
          color: [
              'rgb(255, 255, 255)'
          ],
          
          borderWidth: 2
        },
      ]
    },
    options: {
        legend: {
            labels: {
                fontColor: "white",
            }
        },
      scales: {
            xAxes: [{ 
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff", // this here
                },
            }],
            yAxes: [{
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff",
                  beginAtZero: true,
                },
            }],
        },
    }
  });
</script>

<!-- MONTHLY SECTION -->
<script>
    var thismcity = <?php echo $mcity ?>;
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var d = new Date();
    var ctxL = document.getElementById("lineChartmcity").getContext('2d');
    var myLineChart = new Chart(ctxL, {
    type: 'bar',
    data: {
      labels: ['Mandaue City', 'Lapu-Lapu City'],
      datasets: [{
          label: @json($date01),
          data: thismcity,
          backgroundColor: ['#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f'],
        hoverOffset: 6,
          borderColor: ['#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd'],
          color: [
              'rgb(255, 255, 255)'
          ],
          
          borderWidth: 2
        },
      ]
    },
    options: {
        legend: {
            labels: {
                fontColor: "white",
            }
        },
      scales: {
            xAxes: [{ 
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff", // this here
                },
            }],
            yAxes: [{
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff",
                  beginAtZero: true,
                },
            }],
        },
    }
  });
</script>
<script>
    var thismcity = <?php echo $mbarangay1 ?>;
    var b1 = @json($b1);
    var b2 = @json($b2);
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var d = new Date();
    var ctxL = document.getElementById("lineChartmb1").getContext('2d');
    var myLineChart = new Chart(ctxL, {
    type: 'bar',
    data: {
      labels: b1,
      datasets: [{
          label: @json($date01),
          data: thismcity,
          backgroundColor: ['#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f'],
        hoverOffset: 6,
          borderColor: ['#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd'],
          color: [
              'rgb(255, 255, 255)'
          ],
          
          borderWidth: 2
        },
        
      ]
    },
    options: {
        legend: {
            labels: {
                fontColor: "white",
            }
        },
      scales: {
            xAxes: [{ 
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff", // this here
                },
            }],
            yAxes: [{
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff",
                  beginAtZero: true,
                },
            }],
        },
    }
  });
</script>
<script>
    var thismcity = <?php echo $mbarangay2 ?>;
    var b1 = @json($b1);
    var b2 = @json($b2);
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var d = new Date();
    var ctxL = document.getElementById("lineChartmb2").getContext('2d');
    var myLineChart = new Chart(ctxL, {
    type: 'bar',
    data: {
      labels: b2,
      datasets: [{
          label: @json($date01),
          data: thismcity,
          backgroundColor: ['#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f'],
        hoverOffset: 6,
          borderColor: ['#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd'],
          color: [
              'rgb(255, 255, 255)'
          ],
          
          borderWidth: 2
        },
        
      ]
    },
    options: {
        legend: {
            labels: {
                fontColor: "white",
            }
        },
      scales: {
            xAxes: [{ 
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff", // this here
                },
            }],
            yAxes: [{
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff",
                  beginAtZero: true,
                },
            }],
        },
    }
  });
</script>

<!-- YEARLY SECTION -->
<script>
    var thismcity = <?php echo $ycity ?>;
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var d = new Date();
    var ctxL = document.getElementById("lineChartycity").getContext('2d');
    var myLineChart = new Chart(ctxL, {
    type: 'bar',
    data: {
      labels: ['Mandaue City', 'Lapu-Lapu City'],
      datasets: [{
          label: @json($date02),
          data: thismcity,
          backgroundColor: ['#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f'],
        hoverOffset: 6,
          borderColor: ['#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd'],
          color: [
              'rgb(255, 255, 255)'
          ],
          
          borderWidth: 2
        },
      ]
    },
    options: {
        legend: {
            labels: {
                fontColor: "white",
            }
        },
      scales: {
            xAxes: [{ 
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff", // this here
                },
            }],
            yAxes: [{
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff",
                  beginAtZero: true,
                },
            }],
        },
    }
  });
</script>
<script>
    var thismcity = <?php echo $ybarangay1 ?>;
    var b1 = @json($b1);
    var b2 = @json($b2);
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var d = new Date();
    var ctxL = document.getElementById("lineChartyb1").getContext('2d');
    var myLineChart = new Chart(ctxL, {
    type: 'bar',
    data: {
      labels: b1,
      datasets: [{
          label: @json($date02),
          data: thismcity,
          backgroundColor: ['#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f'],
        hoverOffset: 6,
          borderColor: ['#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd'],
          color: [
              'rgb(255, 255, 255)'
          ],
          
          borderWidth: 2
        },
        
      ]
    },
    options: {
        legend: {
            labels: {
                fontColor: "white",
            }
        },
      scales: {
            xAxes: [{ 
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff", // this here
                },
            }],
            yAxes: [{
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff",
                  beginAtZero: true,
                },
            }],
        },
    }
  });
</script>
<script>
    var thismcity = <?php echo $ybarangay2 ?>;
    var b1 = @json($b1);
    var b2 = @json($b2);
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var d = new Date();
    var ctxL = document.getElementById("lineChartyb2").getContext('2d');
    var myLineChart = new Chart(ctxL, {
    type: 'bar',
    data: {
      labels: b2,
      datasets: [{
          label: @json($date02),
          data: thismcity,
          backgroundColor: ['#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f','#6df0d13f'],
        hoverOffset: 6,
          borderColor: ['#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd','#1de4bd'],
          color: [
              'rgb(255, 255, 255)'
          ],
          
          borderWidth: 2
        },
        
      ]
    },
    options: {
        legend: {
            labels: {
                fontColor: "white",
            }
        },
      scales: {
            xAxes: [{ 
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff", // this here
                },
            }],
            yAxes: [{
                gridLines: {
                    display: true,
                    drawBorder: true,
                    color: "#ffffff2d",
                },
                drawBorder: true,
                ticks: {
                  fontColor: "#fff",
                  beginAtZero: true,
                },
            }],
        },
    }
  });
</script>
@endsection