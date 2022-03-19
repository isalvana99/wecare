
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../style/adminhomestyle.css" rel="stylesheet" type="text/css" >
    <link href="../../style/adminnavstyle.css" rel="stylesheet" type="text/css" >
    <link href="../../style/admindash.css" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>{{Auth::user()->firstName}}</title>
</head>
<body>
  
    <div class="mainconarea">
        <div class="">
            <!-- top bar of admin -->
            <div class="col">
                <nav>
                <div class="topnav sticky-top">
                    <div class="row">
                    <form class="form-inline my-2 mx-auto" id="navform" action="{{ route('admin_users') }}" method="GET">
                      <i class="fa fa-search fa-lg" aria-hidden="true"></i>   
                      <input class="form-control mr-sm-2 searchnav" type="search" placeholder="Search in User" name="search" onclick="submit_form()" aria-label="Search" value="">
                    </form>
                    <div class="col-2" style="width:50px; padding-right:30px;">
                        <img src="/storage/profile_images/{{Auth::user()->profileImage}}" alt="" class="imagecon">
                    </div>
                    </div>
                </div>
                </nav>
            </div><!-- top bar of admin -->

            @yield('content')

        </div>
    </div>

    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!--/jquery-->

    <!--Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <!--/script-->
</body>
</html>