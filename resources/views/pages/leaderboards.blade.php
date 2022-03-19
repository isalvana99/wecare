<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="../style/leaderboards.css" rel="stylesheet" type="text/css" >
    <link href="../../style/navstyle.css" rel="stylesheet" type="text/css" >
    <link rel="shortcut icon" href="{{ asset('images/wecarelogo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Leaderboards</title>
</head>
<body>

  <div class="sticky-top">
    @extends('layouts.topbar_users')
  </div>

  <div class="lead-con">
    <div class="row">

        <!-- header part -->
        <div class="col inside-con">
          <!-- drop down location -->
          <form action="/leaderboards">
          <div class="row select-con">
            <div class="col-4 select-col-con">
                <select class="form-select" aria-label="Default select example" style="padding-bottom:2%;" onchange="this.form.submit()" name="selectbarangay"> 
                    <option value="{{$selectbarangay == '' ? auth()->user()->barangay : $selectbarangay}}" selected hidden>{{$selectbarangay == '' ? auth()->user()->barangay : $selectbarangay}}</option>
                    <option value="All">--- Select All ---</option>
                    @if($selectcity == "Mandaue")
                      @foreach($b1 as $b)
                      <option value="{{$b}}">{{$b}}</option>
                      @endforeach
                    @elseif($selectcity == "Lapu-lapu")
                      @foreach($b2 as $b)
                      <option value="{{$b}}">{{$b}}</option>
                      @endforeach
                    @else
                    @endif
                </select>
            </div>
            <div class="col-4 select-col-con">
                <select class="form-select" aria-label="Default select example" style="padding-bottom:2%;" onchange="this.form.submit()" name="selectcity"> 
                    <option value="{{$selectcity == '' ? auth()->user()->city : $selectcity}}" selected hidden>{{$selectcity == '' ? auth()->user()->city : $selectcity}}</option>
                    <option value="All">--- Select All ---</option>
                    <option value="Mandaue">Mandaue</option>
                    <option value="Lapu-lapu">Lapu-lapu</option>
                </select>
            </div>
            <div class="col-4 select-col-con">
                <select class="form-select" aria-label="Default select example" style="padding-bottom:2%;" onchange="this.form.submit()" name="selectprovince"> 
                    <option value="{{$selectprovince == '' ? auth()->user()->province : $selectprovince}}" selected hidden>{{$selectprovince == '' ? auth()->user()->province : $selectprovince}}</option>
                    <option value="Cebu">Cebu</option>
                </select>
            </div>
          </div>
          </form>
          <!-- /drop down location -->

          <!-- user info -->
          <div class="row">
            <div class="col-3 user-place-con">
                <div class="row">
                    <div class="col naming-con" style="">
                        Position
                    </div>
                </div>

                @php
                  $position = 1;
                  $active = 0;
                @endphp
                @if(count($vars) > 0)
                  @foreach($vars as $var)
                    @if($var->id == Auth::user()->id)
                      @php $active = 1; @endphp
                    @break
                    @endif
                    @php $position++; @endphp
                  @endforeach
                @endif

                @if($active == 1)
                    @if($position == 1)
                      <label for="" class="user-place" style="position: absolute;top: 45%;left: 50%;transform: translate(-50%, -50%);">{{$position}}st</label>
                      <img src="../images/caregold.png" style="width:55%;height:55%;" alt=""><br>
                      <form action="{{ route('badge_save') }}" method="GET">
                        <input type="hidden" name="filterbarangay" value="{{$selectbarangay}}">
                        <input type="hidden" name="filtercity" value="{{$selectcity}}">
                        <input type="hidden" name="filterprovince" value="{{$selectprovince}}">
                        <input type="hidden" name="badge" value="GOLD">
                        <button type="submit" class="form-select select-btn2" style="width:50%;font-size:12px;">Add this badge to profile</button>
                      </form>
                    @elseif($position == 2)
                      <label for="" class="user-place" style="position: absolute;top: 45%;left: 50%;transform: translate(-50%, -50%);">{{$position}}nd</label>
                      <img src="../images/caresilver.png" style="width:55%;height:55%;" alt=""><br>
                      <form action="{{ route('badge_save') }}" method="GET">
                        <input type="hidden" name="filterbarangay" value="{{$selectbarangay}}">
                        <input type="hidden" name="filtercity" value="{{$selectcity}}">
                        <input type="hidden" name="filterprovince" value="{{$selectprovince}}">
                        <input type="hidden" name="badge" value="SILVER">
                        <button type="submit" class="form-select select-btn2" style="width:50%;font-size:12px;">Add this badge to profile</button>
                      </form>
                    @elseif($position == 3)
                      <label for="" class="user-place" style="position: absolute;top: 45%;left: 50%;transform: translate(-50%, -50%);">{{$position}}rd</label>
                      <img src="../images/carebronze.png" style="width:55%;height:5]5%;" alt=""><br>
                      <form action="{{ route('badge_save') }}" method="GET">
                        <input type="hidden" name="filterbarangay" value="{{$selectbarangay}}">
                        <input type="hidden" name="filtercity" value="{{$selectcity}}">
                        <input type="hidden" name="filterprovince" value="{{$selectprovince}}">
                        <input type="hidden" name="badge" value="BRONZE">
                        <button type="submit" class="form-select select-btn2" style="width:50%;font-size:12px;">Add this badge to profile</button>
                      </form>
                    @else
                      <label for="" class="user-place">{{$position}}th</label>
                    @endif
                @else
                    <label for="" class="user-place">None</label>
                @endif
            </div>
            <div class="col-6">
                <div class="profile-circle" style=""> <!-- outer-circle -->
                    <div class="profile-inner"><!-- inner-circle -->
                        <img src="../storage/profile_images/{{Auth::user()->profileImage}}" class="img-con-2" alt="">
                    </div><!-- /inner-circle -->
                </div><!-- /outer-circle -->
                <div class="row">
                    <div class="col name-con">
                        <label for="">You</label>
                    </div>
                </div>
            </div>
            <div class="col-3 user-points-con">
                <div class="row">
                    <div class="col naming-con" style="">
                        Points
                    </div>
                </div>
                <label for="" class="user-points">Php {{number_format((float)Auth::user()->amountGiven, 2, '.', '')}}</label>
            </div>
          </div>
          <!-- /user info -->
        </div>
        <!-- /header part -->
        
        <div class="w-100"></div>

        <!-- leaderboard list -->
        <div class="col">

          <div class="row row-title">
              <div class="col-3">Position</div>
              <div class="col-6">Name</div>
              <div class="col-3">Points</div>
          </div>

          @php
            $a = 1;
          @endphp

          @if(count($vars) > 0)
          @foreach($vars as $var)
          <div class="row place-row"> <!-- repeat this row -->
            <div class="col-3 place-points-con" >
                <img src="../images/wecarelogoblue.png" class="badge-con" alt="">
                
                
                @if($a == 1)
                  <img src="../images/caregold.png" style="width:35px;height:35px;" alt="">
                @elseif($a == 2)
                  <img src="../images/caresilver.png" style="width:35px;height:35px;" alt="">
                @elseif($a == 3)
                  <img src="../images/carebronze.png" style="width:35px;height:35px;" alt="">
                @else
                  <label for="" class="place-pos">{{$a}}th</label>
                @endif
                
                @php
                  $a++
                @endphp

            </div>
            <div class="col-6 place-name">
                <a href="/users/profile/{{$var->id}}" style="color:black;">{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</a>
            </div>
            <div class="col-3 place-points">
                <label for="">Php {{number_format((float)$var->amountGiven, 2, '.', '')}}</label>
            </div>
          </div>
          @endforeach
          @else
          <div class="row place-row"> <!-- repeat this row -->
            <div class="col-6 place-name">
                <label for="">No Available Record as of this moment.</label>
            </div>
          </div>
          @endif
        </div>
        <!-- leaderboard list -->
    </div>
  </div>

  <!--jquery-->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <!--/jquery-->

</body>
</html>