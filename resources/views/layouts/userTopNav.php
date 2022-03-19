<head>
</head>
<nav class="navbar navbar-expand-lg navbar-fixed-top" id="navbar">
  <a class="navbar-brand" id="navlogo" href="#">
            <img src="../../images/wecarelogo.png" alt="">   
            <img src="../../images/wecaretitle.png" alt="">                          
        </a>
  <button class="navbar-toggler custom-toggler" id="burgerbtn" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon "></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent"> <!--start of nav div-->

    <form class="form-inline my-2 mx-auto" id="navform">
      <i class="fa fa-search fa-lg" aria-hidden="true"></i>   
      <input class="form-control mr-sm-2 searchnav" type="search" placeholder="Search" aria-label="Search">
    </form>
    
    <ul class="navbar-nav mr-5">
      <li class="nav-item dropdown" >
        <a id="navdropdown" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="profilepic_topbar" src="/storage/profile_images/{{Auth::user()->profileImage}}" alt="">
        {{Auth::user()->firstName." ".Auth::user()->orgName}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/users/profile/{{Auth::user()->id}}">Profile</a>
          <a class="dropdown-item" href="/users/{{Auth::user()->id}}/edit">Settings</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}">Log out</a>
        </div>
      </li>
    </ul>

    <div class="smallmenu"><!--only show in smal screen-->
      <ul class="navbar-nav" >
        <li class="nav-item dropdown" >
            <label for="" class="lblmenu">Profile</label>
        </li>
        <li class="nav-item dropdown" >
            <label for="" class="lblmenu">Settings</label>
        </li><li class="nav-item dropdown" >
            <label for=""></label>
        </li>
        <li class="nav-item dropdown" >
            <label for="" class="lblmenu">Log out</label>
        </li>
      </ul>
    </div>

  </div><!--end of nav div-->

  
</nav>