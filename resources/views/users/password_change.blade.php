<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../../style/userhome1.css" rel="stylesheet" type="text/css" >
    <link href="../../../style/navstyle.css" rel="stylesheet" type="text/css" >
    <link href="../../../style/usersettingsstyle.css" rel="stylesheet" type="text/css" >
    <link href="../../../style/fontfamily.css" rel="stylesheet" type="text/css" >
    <link rel="shortcut icon" href="{{ asset('images/wecarelogo.png') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Phone number css -->
    <link rel="stylesheet" href="build/css/countrycode.css">
    <link rel="stylesheet" href="build/css/telInput.css">
    <title>Settings</title>
</head>
<body>
    
<div class="sticky-top">
@extends('layouts.settingsTopNav')
</div>

<div class="row side">
  <div class="col-3 large">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action" href="/users/{{$posts->id}}/edit" role="tab" aria-controls="home"><i class="fas fa-user icon"></i>My Information</a>
      <a class="list-group-item list-group-item-action active" id="list-login-list" data-toggle="list" href="#list-login" role="tab" aria-controls="profile"><i class="fas fa-sign-in-alt icon"></i>Change Password</a>
    </div>
  </div>


    <!--  Login Credentials -->
    <div class="tab-pane" id="list-login" role="tabpanel" aria-labelledby="list-login-list">
        <label for="">Login Credentials</label>
        <div class="logincon">
            
            <label class="conheader">Change your password</label>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

            <form class="form-horizontal" method="POST" action="{{ route('changePasswordPost') }}">
                    {{ csrf_field() }}

                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                    <label for="new-password" class="col-md-4 control-label">Current Password</label>

                    <div class="col-md-6">
                        <input id="current-password" type="password" class="form-control" name="current-password" required>

                        
                    </div>
                </div>

                <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                    <label for="new-password" class="col-md-4 control-label">New Password</label>

                    <div class="col-md-6">
                        <input id="new-password" type="password" class="form-control" name="new-password" required>

                        
                    </div>
                </div>

                <div class="form-group">
                    <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                    <div class="col-md-6">
                        <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn-violet">
                            Change Password
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div><!--end of login credentials-->
</div>
</div>
</div>

<script>
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
    })();
</script>
    
<script src="../script/checkemail.js"></script>

<!--jquery-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!--/jquery-->

<!--Javascript-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<!--/script-->

<!--Javascript-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<!--/script-->

<script src="../script/checkemail.js"></script>

<!--jquery-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!--/jquery-->

</script>
<!--jquery-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!--/jquery-->

<!--Javascript-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<!--/script-->
</body>
</html>