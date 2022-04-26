<html>
  <body>
    @php

    $week = date('W', strtotime('2022-04-17'));
    $weekchoice = date('Y').'-W'.$week;
    
    if(date('l', strtotime('2022-04-16')) == "Sunday"){

      $week = (int)date('W') + 1;
      $weekchoice = date('Y').'-W'.$week;
      $firstday2 = date('d', strtotime($weekchoice)) - 1;
      $startdate2 = date('Y-m-', strtotime($weekchoice)).$firstday2;
      $lastday2 = date('d', strtotime($weekchoice)) + 5;
      $enddate2 = date('Y-m-', strtotime($weekchoice)).$lastday2;

    }else{

      $firstday = date('d', strtotime($weekchoice)) - 1;
      $startdate = date('Y-m-', strtotime($weekchoice)).$firstday;
      $lastday = date('d', strtotime($weekchoice)) + 5;
      $enddate = date('Y-m-', strtotime($weekchoice)).$lastday;

    }

      

      

    @endphp

  <p>This is for Monday to Sat</p>
  <p>weekchoice = {{$weekchoice}}</p>
  <p>firstday = {{$firstday}}</p>
  <p>startdate = {{$startdate}}</p>
  <p>lastday = {{$lastday}}</p>
  <p>enddate = {{$enddate}}</p>
  <br>
  <p>This is for Sunday</p>
  <p>weekchoice = {{$weekchoice}}</p>
  
  <br>
  </body>
</html>