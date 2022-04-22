<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../style/navstyle3.css" rel="stylesheet" type="text/css" >
    <link href="../../style/distribution.css" rel="stylesheet" type="text/css" >
    <link href="../../style/dropdown_dots.scss" rel="stylesheet" type="text/css" >
    <link href="../../style/socialmediabuttons.css" rel="stylesheet" type="text/css" >
    <link rel="shortcut icon" href="{{ asset('images/wecarelogo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Distributions</title>
</head>
<body>
    <div class="sticky-top">
     @extends('layouts.usertopnav')
    </div>

    <div class="row">
        <div class="col-12" style="">
            <div class="con post_main_view">
                <div class="con1" >
                    <div class="row view_post_row1">
                        <div class="col-8w">
                            <div class="row"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-left:0;">
        <div class="col-3" style="">
            <div class="row view_post_left_row">
                <div class="col-12">
                    <div class="sticky">
                        <form action="{{route('distributioncontent2')}}">
                            <input type='search' class="form-control" name="searchtitle" value="{{$searchtitle}}" placeholder="Search Title" onclick="submit_form()" autocomplete="off">
                        </form>
                    </div>
                    @if(count($vars) > 0)
                    @foreach($vars as $var)
                    <form action="{{route('distributioncontent2')}}">
                    <input type="hidden" name="referenceno" value="{{$var->postId}}">
                    <button type="submit" class="col-12 title_area" style="margin-bottom:5px;">
                        <h6>{{$var->postCategory}}</h6>
                        <small>Reference Number: {{$var->postId}}</small><br>
                        <small>Posted: {{date('F j, Y', strtotime($var->postCreatedAt))}}</small>
                    </button>
                    </form>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="row view_post_right_row">
                <!-- @include('inc.messages') -->
                @yield('content')
            </div>
        </div>
    </div>

    

<!--jquery-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!--/jquery-->

<!--Javascript-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<!--/script-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- custom scrollbar plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

<Script>
    function myFunction() {
    var x = document.getElementById("dot-con");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
    }
</Script>

<script>
function reportFunction() {
  var x = document.getElementById("reportDiv");
  if (x.style.display === "none") {
    x.style.display = "inline";
  } else {
    x.style.display = "none";
  }
}
</script>

<script>
function editFunction() {
  var x = document.getElementById("editDiv");
  var y = document.getElementById("deleteDiv");
  if (x.style.display === "none") {
    x.style.display = "inline";
    y.style.display = "none";
  } else {
    x.style.display = "none";
  }
}
</script>

<script>
function deleteFunction() {
  var x = document.getElementById("deleteDiv");
  var y = document.getElementById("editDiv");
  if (x.style.display === "none") {
    x.style.display = "inline";
    y.style.display = "none";
  }else {
    x.style.display = "none";
  }
}
</script>

</body>
</html>