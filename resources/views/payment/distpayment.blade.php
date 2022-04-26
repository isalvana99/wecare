<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../style/payment.css" rel="stylesheet" type="text/css" >
    <link rel="shortcut icon" href="{{ asset('images/gc.png') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>GCash</title>
</head>
<body>
    @if(count($user) > 0)
    @foreach($user as $user)
    <div class="container1" style="">
        <div class="row">
            <div class="col">
                <img src="../../images/gcashlogo.png" class="gcashlogo" alt="">
            </div>
            <div class="w-100"></div>
            <div class="col rowgrey">
                <div class="container">
                    <div class="row">
                        <div class="col col1">Merchant</div>
                        <div class="col" style="color:#696b6d;">{{$user->firstName." ".$user->middleName." ".$user->lastName." ".$user->orgName}}</div>
                        <div class="w-100" style="margin-top:20px;"></div>
                        <div class="col col1">Amount Due</div>
                        <div class="col" style="color:#0057e4;">PHP {{number_format($amount,2)}}</div>
                    </div>
                </div>
            </div>
            <div class="w-100"></div>
            
            <div class="col rowwhite">
            <form action="/distpayment2/" method="GET">
                <div class="container whitecon">
                    <div class="row">
                        @include('inc.messages')
                        
                        <input type="hidden" name="postid" value="{{$postid}}">
                        <input type="hidden" name="amount" value="{{$amount}}">
                        <input type="hidden" name="userid" value="{{$userid}}">
                        <input type="hidden" name="previous_url" value="{{$previous_url}}">

                        <div class="col title1">Login to pay with GCash</div>
                        <div class="w-100"></div>
                        <div class="col title2">Mobile number</div>
                        <div class="w-100"></div>
                        <div class="col-3 num1" style="">+63</div>
                        <div class="col-8 num2" style=""><input type="tel" class="telinput" name="ownernum"></div>
                        <div class="w-100"></div>
                        <button type="submit" class="btnnext">NEXT</button>
                        
                    </div>
                </div>
            </form>
            </div>
            
        </div>
    </div>
    @endforeach
    @endif

    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!--/jquery-->

    <!--Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <!--/script-->

</body>
</html>