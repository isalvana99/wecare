<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../style/payment.css" rel="stylesheet" type="text/css" >
    <link href="../../style/payment2.css" rel="stylesheet" type="text/css" >
    <link rel="shortcut icon" href="{{ asset('images/gc.png') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>WeCare | Log In</title>
</head>
<style>
    #showMe {
    animation: cssAnimation 0s 4s forwards;
    visibility: hidden;
    }

    @keyframes cssAnimation {
    to   { visibility: visible; }
    }
</style>
<body>

    <div class="container1" style="">
        <div class="row">
            <div class="col">
                <img src="../../images/gcashlogo.png" class="gcashlogo" alt="">
            </div>
            <div class="w-100"></div>
            <div class="col rowgrey">
                <div class="container">
                    <div class="row">
                        <div class="col title3">Login to pay with GCash</div>
                        <div class="w-100" style=""></div>
                        <div class="col cap1">Enter the 6-digit authentication code sent to your registered mobile number.</div>
                    </div>
                </div>
            </div>
            <div class="w-100"></div>
            <div class="col rowwhite">
                <div class="container whitecon">
                    <div class="row" >
                        <div id="divOuter" style="margin:auto;">
                            <div id="divInner">
                                <div id="showMe">

                                <input class="code" value="{{$code}}" id="partitioned" onkeyup="EnableDisable(this)" type="text" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  onKeyPress="if(this.value.length==6) return false;" style="position:relative;"/>
                                

                                </div>

                                <input class="code" id="partitioned" onkeyup="EnableDisable(this)" type="text" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  onKeyPress="if(this.value.length==6) return false;" style="margin-top:-30px;display:block;"/>
                            </div>
                        </div>
                        <div class="w-100" style=""></div>
                            <div class="col cap2">Didn't get the code? Resend in <span id="countdown">300</span>s</div>
                        <div class="w-100"></div>
                        {!! Form::open(['action' => 'App\Http\Controllers\TransactionController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <input type="hidden" name="amountDonated" value="{{$amount}}">
                            <input type="hidden" name="postid" value="{{$postid}}">
                            <input type="hidden" name="postuserid" value="{{$postuserid}}">
                            <input type="hidden" name="action" value="DONATE">
                            <input type="hidden" name="paymenttype" value="GCASH">
                            <input type="hidden" name="recepient" value="{{$postuserid}}">
                            <input type="hidden" name="donor" value="{{Auth::user()->id}}">
                            <input type="hidden" name="previous_url" value="{{$previous_url}}">
                        <button type="submit" class="btnnext2" id="btnsubmit" style="width:440px;">NEXT</button>
                        {!! Form::close() !!}
                    </div>
                </div>
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
    var input = document.getElementById("partitioned");

    if(input.value.length == 6){
        btnsubmit.disabled=false;
        btnsubmit.style.backgroundColor ="#0057e4";
    }else{
        btnsubmit.disabled=true;
        btnsubmit.style.backgroundColor ="#5797ff";
    }
    </script>


    <script>
        var timeleft = 300;
        var downloadTimer = setInterval(function(){
        if(timeleft <= 0){
            clearInterval(downloadTimer);
            document.getElementById("countdown").innerHTML = ""; //finished
        } else {
            document.getElementById("countdown").innerHTML = timeleft + ""; //counting
        }
        timeleft -= 1;
        }, 1000);
    </script>

    <script type="text/javascript">
        function EnableDisable(partitioned) {
            var input = document.getElementById("partitioned");

            if(input.value.length == 6){
                btnsubmit.disabled=false;
                btnsubmit.style.backgroundColor ="#0057e4";
            }else{
                btnsubmit.disabled=true;
                btnsubmit.style.backgroundColor ="#5797ff";
            }
        };
    </script>

    
</body>
</html>