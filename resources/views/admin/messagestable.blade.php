
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../style/adminhomestyle.css" rel="stylesheet" type="text/css" >
    <link href="../../style/adminnavstyle.css" rel="stylesheet" type="text/css" >
    <link rel="shortcut icon" href="{{ asset('images/wecarelogo.png') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>{{Auth::user()->firstName." ".Auth::user()->orgName}}</title>
</head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #2f335c;
  color: white;
}
</style>
<body>
  <nav class="mainsidebar sticky-top">
    <div class="banner">
      <img src="../../images/wecarebanner admin.png" alt="" class="imgbanner">
    </div>

    <div class="adminarea">
      <label for="">Hi! {{Auth::user()->firstName." ".Auth::user()->orgName}}</label>
    </div>

    <div class="sidecon">
      <div class="col-13">
        <div class="list-group" id="list-tab" role="tablist"  style="border-radius:0 !important;">
          
          <a class="list-group-item list-group-item-action" href="/admin/records/users" role="tab" aria-controls="home">Users</a>

          <a class="list-group-item list-group-item-action" href="/admin/records/organization" role="tab" aria-controls="org">Organization</a>

          <a class="list-group-item list-group-item-action" href="/admin/records/posts" role="tab" aria-controls="profile">Posts</a>

          <a class="list-group-item list-group-item-action" href="/admin/leaderboards" role="tab" aria-controls="leaderboard">View Leaderboard</a>

          <a class="list-group-item list-group-item-action" href="/admin/stats" role="tab" aria-controls="stats">Donation Monitoring</a>

          <a class="list-group-item list-group-item-action" href="/admin/reports" role="tab" aria-controls="report">Report/Review Requests</a>

          <a class="list-group-item list-group-item-action" href="/admin/inquiry_message" role="tab" aria-controls="messages">View User Inquiries</a>

          <a class="list-group-item list-group-item-action" href="/admin/settings" role="tab" aria-controls="settings">Settings</a>

          <a class="list-group-item list-group-item-action" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </div>
      </div>
    </div><!--end sidecon-->
  </nav>

  <div class="mainconarea">
    <div class="">
      <div class="tab-content" id="nav-tabContent">
        <!-- USERS TABLE -->
        <!-- search -->
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
        <!-- end search -->
        <div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list"><br></div>
        <!-- END USERS TABLE -->
        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list"><br></div>
        <div class="tab-pane fade" id="list-org" role="tabpanel" aria-labelledby="list-profile-list"><br></div>
        <div class="tab-pane fade show active" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">Messages</div>
        <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">Setings</div>
      </div>
    </div>
  </div>
  <!--jquery-->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <!--/jquery-->

  <!--Javascript-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
  <!--/script-->
  <script>
    function submit_form(){
        var form = document.getElementById("my_form");
        form.submit();
        alert("Your Message Sent");
    }
  </script>
</body>
</html>