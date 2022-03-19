<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="../style/wecarelogin.css" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>WeCare | Log In</title>
</head>
<body>

    <div class="main-con">
        <div class="row">
            <div class="col image-con">
                <img src="../images/wecarebanner.png" class="img-con" alt="">
                <div class="info-con">
                    <p>You always matter! We are here for you.</p>
                </div>
                <div class="lottie">
                    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                    <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_puciaact.json"  background="transparent"  speed="1"  style="width: 500px; height: 500px;"  loop  autoplay></lottie-player>
                </div>
            </div>
            <div class="w-100 hidediv" ></div>
            <div class="col form-con">
                <div class="inner-con">
                <form method="POST" class="needs-validation" novalidate action="{{ route('login') }}">
                        @csrf
                        <div class="welcome-area" style="text-align:center;">
                            <label for="" class="welcome">Welcome back !</label>
                        </div>
                        @if (Session::has('message'))
                         <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                        @endif
                        @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                            @if($error == "These credentials do not match our records.")
                            <div class="alert alert-danger">
                                {{$error}}
                              </div>
                            @else
                            @endif
                        @endforeach
                        @endif
                        
                        <div class="form-group form-con2">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <!-- you can change the message for error -->
                                @if($message == "These credentials do not match our records.")
                                
                                @else
                                <strong>{{$message}}</strong>
                                @endif
                            </span>
                            @enderror
                            <strong id="emailerror"></strong>
                        </div>
                        <div class="form-group form-con2">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Enter Password" name="password" value="{{ old('password') }}" required autocomplete="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <!-- you can change the message for error -->
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="btn-con">
                            <button type="submit" class="btn btn-primary" name="submit" id="button" disabled="disabled">Login</button>
                            <div class="w-100"></div>

                            @if (Route::has('password.request'))
                                <a class="" style="align:center;font-size:14px;" href="{{ route('forget.password.get') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                        <br>
                        <div class="container notreg">
                        No account yet? <a href="{{ route('register') }}">Register here.</a> 
                        </div>
                        
                    </form>
                </div>
                <div class="social-con">
                    
                </div>
            </div>
        </div>
    </div>

    {{-- email validation --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        $(function() {
        $('#button').attr('disabled', true);
        $('#exampleInputEmail1').change(function() {
            if (re.test($('#exampleInputEmail1').val()) != '') {
            $('#button').attr('disabled', false);
            } else {
            $('#button').attr('disabled', true);
            }
        });
        });
    </script>
    {{-- /email validation --}}
    
    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!--/jquery-->

    <!--Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <!--/script-->

</body>
</html>