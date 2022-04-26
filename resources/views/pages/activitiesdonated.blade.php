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
    <title>Donation History</title>
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
    
<div class="sticky-top">
    @extends('layouts.topbar_users')
</div>

<div class="row side" style="margin-left:1px;">
    <div class="col-3 large">
        <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active" id="list-personal-list" data-toggle="list" href="#list-personal" role="tab" aria-controls="home"><i class="fas fa-money-bill-alt icon"></i>Donation History</a>
            <a class="list-group-item list-group-item-action" href="/activity/you-received" role="tab" aria-controls="profile"><i class="far fa-money-bill-alt icon"></i>Received History</a>
        </div>
    </div>

    <!-- Personal Information -->
    <div class="col-8">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="list-personal" role="tabpanel" aria-labelledby="list-personal-list">
            <label for="">Your Donation History</label>
                <div class="personalcon">
                    <div class="formcon">
                        <div class="form-row">
                            <table id="customers">
                                <tr>
                                    <th>Date Donated</th>
                                    <th>Organization</th>
                                    <!-- <th>GCash Number</th> -->
                                    <th>Date of Post</th>
                                    <th>Amount Donated</th>
                                </tr>
                                @if(count($tran) > 0)
                                @foreach ($tran as $var)
                                <tr>
                                    
                                    <td>{{date('F j, Y | h:i A', strtotime($var->transactionCreatedAt))}}</td>
                                    <td>{{$var->firstName." ".$var->middleName." ".$var->lastName." ".$var->orgName}}</td>
                                    <!-- <td>{{$var->phoneNumber}}</td> -->
                                    <td>{{date('F j, Y', strtotime($var->postCreatedAt))}}</td>
                                    <td>PHP {{number_format($var->transactionAmount, 2)}}</td>
                                </tr>
                                @endforeach
                                <tr style="border-top:2px solid grey;">
                                    <td colspan="3" style="text-align:center">Total</td>
                                    <td>PHP {{number_format(Auth::user()->amountGiven, 2)}}</td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="10" style="text-align:center">No Record.</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>

    
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

<script type="text/javascript">
    function getAge(){
        var birth_year = parseFloat(document.getElementById('birth_year').value);
        var birth_month = parseFloat(document.getElementById('month').value);
        var birth_day = parseFloat(document.getElementById('day').value);
        var year = new Date();
        var curr_year = year.getFullYear();
        var curr_month = year.getMonth() + 1;
        var curr_day = String(year.getDate()).padStart(2, '0');
        if(curr_month == birth_month)
        {
            if(curr_day < birth_day)
            {
                document.getElementById('age').value = curr_year-birth_year-1;
            }else if(curr_day >= birth_day){
                document.getElementById('age').value = curr_year-birth_year;
            }
        }else if(curr_month < birth_month){
            document.getElementById('age').value = curr_year-birth_year-1;
        }else{
            document.getElementById('age').value = curr_year-birth_year;
        }
    }
</script>

<script>
    $(document).ready(function () {
        $('#validationCustom01').on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
        event.preventDefault();
        return false;
        }
        });

        $('#validationCustom02').on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
        event.preventDefault();
        return false;
        }
        });

        $('.mi2').on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
        event.preventDefault();
        return false;
        }
        });

        $('.pn').on('keypress', function (event) {
        var regex = new RegExp("^[0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
        event.preventDefault();
        return false;
        }
        });
    });
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