<nav class="mainsidebar sticky-top">
    <div class="banner">
      <img src="../../images/wecarebanner admin.png" alt="" class="imgbanner">
    </div>

    <div class="adminarea">
      <label for="">Hi! Admin {{Auth::user()->firstName}}</label>
    </div>

    <div class="sidecon">
      <div class="col-13">
        <div class="list-group" id="list-tab" role="tablist"  style="border-radius:0 !important;">
        
        <a class="list-group-item list-group-item-action active" href="/admin" role="tab" aria-controls="home">Dashboard</a>

        <a class="list-group-item list-group-item-action" href="/admin/records/users" role="tab" aria-controls="home">Users</a>

        <a class="list-group-item list-group-item-action" href="/admin/records/organization" role="tab" aria-controls="org">Organization</a>

        <a class="list-group-item list-group-item-action" href="/admin/records/posts" role="tab" aria-controls="profile">Posts</a>

        <a class="list-group-item list-group-item-action" href="/admin/leaderboards" role="tab" aria-controls="leaderboard">View Leaderboard</a>

        <a class="list-group-item list-group-item-action" href="/admin/stats" role="tab" aria-controls="stats">Donation Statistics</a>

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