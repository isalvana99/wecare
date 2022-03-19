@extends('layouts.admin_layout')

@section('content')
<!-- big container (this is for the content) -->
<div class="col-9 big_con">
    <div class="big_main_con" >
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

        <div class="container innner_dash_con">
            <div class="row dash_header">
                Dashboard
            </div>
            <div class="row">
                <div class="container dash_square_con">
                    <div class="row">
                        <div class="col-4 ">
                            <div class="container dash_user_box">

                                <div class="row">
                                    <div class="col-8 box_title_col">
                                        PEOPLE
                                    </div>
                                    <div class="col-4 box_icon_col">
                                        <i class="fal fa-user"></i>
                                    </div>
                                </div>

                                <div class="row">
                                    @if(count($people) > 0)
                                    @foreach($people as $count=>$var)
                                    @endforeach
                                    <div class="col-12 box_total_num">
                                        {{number_format($count+=1)}}
                                    </div>
                                    @else
                                    <div class="col-12 box_total_num">
                                        0
                                    </div>
                                    @endif
                                </div>

                                <div class="row">
                                    @php $cnt = 0; date_default_timezone_set("Asia/Manila"); $today = date("Y-m-d"); @endphp
                                    @if(count($people) > 0)
                                    @foreach($people as $var)
                                    @if(date("Y-m-d", strtotime($var->accountCreatedAt)) == $today)
                                    @php $cnt += 1; @endphp
                                    @endif
                                    @endforeach
                                    <div class="col-12 box_today_num">
                                        Today: {{number_format($cnt)}}
                                    </div>
                                    @else
                                    <div class="col-12 box_today_num">
                                        Today: 0
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-4 ">
                            <div class="container dash_org_box">
                                <div class="row">
                                    <div class="col-8 box_title_col" >
                                        ORGANIZATION
                                    </div>
                                    <div class="col-4 box_icon_col">
                                        <i class="fal fa-users"></i>
                                    </div>
                                </div>
                                <div class="row">
                                    @if(count($org) > 0)
                                    @foreach($org as $count=>$var)
                                    @endforeach
                                    <div class="col-12 box_total_num">
                                        {{number_format($count+=1)}}
                                    </div>
                                    @else
                                    <div class="col-12 box_total_num">
                                        0
                                    </div>
                                    @endif
                                </div>

                                <div class="row">
                                    @php $cnt2 = 0; @endphp
                                    @if(count($org) > 0)
                                    @foreach($org as $var)
                                    @if(date("Y-m-d", strtotime($var->accountCreatedAt)) == $today)
                                    @php $cnt2 += 1; @endphp
                                    @endif
                                    @endforeach
                                    <div class="col-12 box_today_num">
                                        Today: {{number_format($cnt2)}}
                                    </div>
                                    @else
                                    <div class="col-12 box_today_num">
                                        Today: 0
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="container dash_post_box">
                                <div class="row">
                                    <div class="col-8 box_title_col">
                                        POST
                                    </div>
                                    <div class="col-4 box_icon_col">
                                        <i class="fal fa-clone"></i>
                                    </div>
                                </div>

                                <div class="row">
                                    @if(count($post) > 0)
                                        @foreach($post as $count=>$var)
                                        @endforeach
                                        <div class="col-12 box_total_num">
                                            {{number_format($count+=1)}}
                                        </div>
                                    @else
                                        <div class="col-12 box_total_num">
                                            0
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    @php $cnt3 = 0; @endphp
                                    @if(count($post) > 0)
                                    @foreach($post as $var)
                                    @if(date("Y-m-d", strtotime($var->postCreatedAt)) == $today)
                                    @php $cnt3 += 1; @endphp
                                    @endif
                                    @endforeach
                                    <div class="col-12 box_today_num">
                                        Today: {{number_format($cnt3)}}
                                    </div>
                                    @else
                                    <div class="col-12 box_today_num">
                                        Today: 0
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="container second_area_con">
                    <div class="row">
                        <div class="col-8  dash_line_con">
                            <div class="container my-4">
                                <div>
                                    <canvas id="lineChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 dash_recent_activity" >
                            <div class="container dash_recent_con">
                                <div class="row dash_recent_header">
                                    Recent Activity
                                </div>
                                @if(count($transactions) > 0)
                                @foreach($transactions as $var)
                                <div class="row dash_recent_content">
                                    <div class="col-3">
                                        <img src="/storage/profile_images/{{$var->profileImage}}" alt="" class="dash_recent_pic">
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <label for=""><span class="dash_recent_name">{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}} </span> | <span class="dash_recent_money">Donated</span> <span class="dash_recent_amount">PHP {{number_format($var->transactionAmount, 2)}}</span></label>
                                        </div>
                                        <div class="row">
                                            <span class="dash_recent_time">
                                            @php
                                            // $today = date("Y-m-d h:i:s");
                                            // $start_date = new DateTime($today);
                                            // $since_start = $start_date->diff(new DateTime($var->transactionCreatedAt));
                                            // Declare and define two dates
                                            date_default_timezone_set("Asia/Manila");
                                            $today = date("Y-m-d H:i:s");
                                            $date1 = strtotime(date("Y-m-d H:i:s"));
                                            $date2 = strtotime($var->transactionCreatedAt);
                                            
                                            // Formulate the Difference between two dates
                                            $diff = abs($date2 - $date1);
                                            
                                            // To get the year divide the resultant date into
                                            // total seconds in a year (365*60*60*24)
                                            $years = floor($diff / (365*60*60*24));
                                            
                                            // To get the month, subtract it with years and
                                            // divide the resultant date into
                                            // total seconds in a month (30*60*60*24)
                                            $months = floor(($diff - $years * 365*60*60*24)
                                                                            / (30*60*60*24));
                                            
                                            // To get the day, subtract it with years and
                                            // months and divide the resultant date into
                                            // total seconds in a days (60*60*24)
                                            $days = floor(($diff - $years * 365*60*60*24 -
                                                        $months*30*60*60*24)/ (60*60*24));
                                            
                                            // To get the hour, subtract it with years,
                                            // months & seconds and divide the resultant
                                            // date into total seconds in a hours (60*60)
                                            $hours = floor(($diff - $years * 365*60*60*24
                                                    - $months*30*60*60*24 - $days*60*60*24)
                                                                                / (60*60));
                                            
                                            // To get the minutes, subtract it with years,
                                            // months, seconds and hours and divide the
                                            // resultant date into total seconds i.e. 60
                                            $minutes = floor(($diff - $years * 365*60*60*24
                                                    - $months*30*60*60*24 - $days*60*60*24
                                                                        - $hours*60*60)/ 60);
                                            
                                            // To get the minutes, subtract it with years,
                                            // months, seconds, hours and minutes
                                            $seconds = floor(($diff - $years * 365*60*60*24
                                                    - $months*30*60*60*24 - $days*60*60*24
                                                            - $hours*60*60 - $minutes*60));
                                            
                                                            // Print the result
                                            if($days == 0 && $months == 0 && $years == 0){
                                                if($hours == 0){
                                                    if($minutes == 0){
                                                        if($seconds == 1){
                                                            echo $seconds." second ago";
                                                        }else{
                                                            echo $seconds." seconds ago";
                                                        }
                                                    }else if($minutes == 1){
                                                        echo $minutes." minute ago";
                                                    }else{
                                                        echo $minutes." minutes ago";
                                                    }
                                                }else if($hours == 1){
                                                    echo $hours." hour ago";
                                                }else{
                                                    echo $hours." hours ago";
                                                }
                                            }else if($days == 1 && $months == 0 && $years == 0){
                                                echo $days." day ago";
                                            }else if($days < 7 && $days > 0 && $months == 0 && $years == 0){
                                                echo $days." days ago";
                                            }else{
                                                echo date('F j, Y', strtotime($var->transactionCreatedAt));
                                            }

                                            @endphp
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

<script>
    var donlength = @json($data_donated);
    var reclength = @json($data_received);
    var don = @json($total_donated);
    var rec = @json($total_received);
    var amount1=parseFloat(don).toFixed(2);
    var don2= amount1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    var amount2=parseFloat(rec).toFixed(2);
    var rec2= amount2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    var ctxL = document.getElementById("lineChart").getContext('2d');
    var myLineChart = new Chart(ctxL, {
    type: 'line',
    data: {
      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],
      datasets: [{
          label: "Donated: PHP " + don2,
          data: donlength,
          backgroundColor: [
            '#6df0d13f',
          ],
          borderColor: [
            '#1de4bd',
          ],
          color: [
              'rgb(255, 255, 255)'
          ],
          
          borderWidth: 2
        },
        {
          label: "Received: PHP " + rec2,
          data: reclength,
          backgroundColor: [
            '#e7e24e3f',
          ],
          borderColor: [
            '#eabd3b',
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
                },
            }],
        },
    }
  });
</script>
@endsection