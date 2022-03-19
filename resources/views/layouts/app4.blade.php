<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/style/userhome1.css" rel="stylesheet" type="text/css" >
    <link href="/style/nav2.css" rel="stylesheet" type="text/css" >
    <link href="/style/postbuttons.css" rel="stylesheet" type="text/css" >
    <link href="/style/fontfamily.css" rel="stylesheet" type="text/css" >
    <link rel="shortcut icon" href="{{ asset('images/wecarelogo.png') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>WeCare</title>
</head>
<body>
<div class="sticky-top">
<nav class="navbar navbar-expand-lg navbar-fixed-top" id="navbar">
  <a class="navbar-brand" id="navlogo" href="/home">
            <img src="../../images/wecarelogo.png" alt="">   
            <img src="../../images/wecaretitle.png" alt="">                          
        </a>
  <button class="navbar-toggler custom-toggler" id="burgerbtn" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon "></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent"> <!--start of nav div-->

    <form class="form-inline my-2 mx-auto" id="navform" action="" method="GET">
      <i class="fa fa-search fa-lg" aria-hidden="true"></i>   
      <input class="form-control mr-sm-2 searchnav" type="hidden" placeholder="Search" name="search" aria-label="Search" value="">
    </form>

    <ul class="navbar-nav mr-5">
      <li class="nav-item dropdown" >
        
      </li>
    </ul>

    

  </div><!--end of nav div-->
</nav>
</div>

<div class="part2">

@yield('content')
</div>

    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!--/jquery-->

    <!--Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <!--/script-->

</body>
</html>