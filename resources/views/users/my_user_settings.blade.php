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
      <a class="list-group-item list-group-item-action active" id="list-personal-list" data-toggle="list" href="#list-personal" role="tab" aria-controls="home"><i class="fas fa-user icon"></i>Personal Information</a>
      <a class="list-group-item list-group-item-action" href="/users/{{$posts->id}}/change_password" role="tab" aria-controls="profile"><i class="fas fa-sign-in-alt icon"></i>Change Password</a>
    </div>
  </div>

  <!-- Personal Information -->
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-personal" role="tabpanel" aria-labelledby="list-personal-list">
        <label for="">My Information</label>
        <div class="personalcon">
            <div class="formcon">
                {!! Form::open(['action' => ['App\Http\Controllers\UsersController@update', $posts->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <!--form-row-->
                @include('inc.messages')
                <div class="form-row">
                    <!--first name input-->
                    <div class="col-md-5 mb-3">
                        <input type="hidden" value="" name="id"/>
                        <label for="firstname">First name</label>
                        <input type="text" name="firstname" class="form-control" id="validationCustom01" placeholder="John" value="{{$posts->firstName}}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div> <!--first name input-->
                    </div>

                    <!--Last name input-->
                    <div class="col-md-5 mb-3">
                        <label for="lastname">Last name</label>
                        <input type="text" name="lastname" class="form-control" id="validationCustom02" placeholder="Doe" value="{{$posts->lastName}}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div> <!--/Last name input-->

                    <!--Middle initial input-->
                    <div class="col-md-2 mb-3">
                        <label for="middlename">Middle Name</label>
                        <input type="text" name="middlename" class="form-control form-control mi2" id="validationCustom02" placeholder="" value="{{$posts->middleName}}">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div> <!--/Middle initial input-->

                    <!--Birthday inputs-->
                    <div class="col-md-8 mb-3">
                        <label for="birthday">Birthday</label>
                        <div class="row">
                            <div class="col-sm-3 col-sm-2">
                                <select class="form-control" id="day" name="day" onchange=getAge() required> 
                                <option value="{{substr($posts->birthday,6,2);}}">{{substr($posts->birthday,6,2);}}</option>
                                <option value=""></option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                </select>
                                <small>Day</small>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>

                            <p style="font-size:25px; opacity:.5;" id="slash">/</p>

                            <div class="col-sm-3">
                                <select class="form-control" id="month" name="month" onchange=getAge() required>
                                <option value="{{substr($posts->birthday,4,2);}}">{{substr($posts->birthday,4,2);}}</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                </select>
                                <small>Month</small>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>

                            <p style="font-size:25px; opacity:.5;" id="slash">/</p>

                            <div class="col-sm-2">
                                <input type="text" name="year" onkeyup=getAge() class="form-control" id="birth_year" placeholder="YYYY" required value="{{substr($posts->birthday,0,4);}}" style="width:65px;">
                                <small>Year</small>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>        
                    </div> <!--/Birthday inputs-->
                    
                    <input type="hidden" value="{{$posts->birthday}}" id="birthday"/>
                        
                    <!--Age input-->
                    <div class="col-md-2 mb-3">
                        <label for="age label">Age</label>
                        <input type="text" name="age" class="form-control" id="age" placeholder="" value="<?php
                        //date in mm/dd/yyyy format; or it can be in other formats as well
                        $birthDate = date('m/d/Y', strtotime($posts->birthday));
                        //explode the date to get month, day and year
                        $birthDate = explode("/", $birthDate);
                        //get age from date or birthdate
                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                            ? ((date("Y") - $birthDate[2]) - 1)
                            : (date("Y") - $birthDate[2]));
                        echo $age;
                        ?>" required readonly>
                        
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div> <!--/Age input-->

                    <!--sex input-->
                    <div class="col-md-3" style="margin-left:0px;">
                        <label for="sex label">Sex</label>
                        <div class="form-check">
                            <input  class="form-check-input" name="sex" type="radio" name="exampleRadios" id="exampleRadios1" value="Female" required {{ ($posts->sex=="Female")? "checked" : "" }}>
                            <label class="form-check-label" for="exampleRadios1" style="margin-left:15px;">
                                Female
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="sex" type="radio" name="exampleRadios" id="exampleRadios2" value="Male" required {{ ($posts->sex=="Male")? "checked" : "" }}>
                            <label class="form-check-label" for="exampleRadios2" style="margin-left:15px;">
                                    Male
                            </label>
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div> <!--/sex input-->

                    <!--Address input-->
                    <div class="col-md-12 mb-3">
                            <label for="">Address</label>
                            <div class="row">
                            <div class="col-sm-3">
                                    <select class="form-control" name="region" required> 
                                        <option value="{{$posts->region}}">{{$posts->region}}</option>
                                        <option value="Region 7" selected hidden>Region 7</option>
                                    </select>
                                    <small>Region</small>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" name="province" required>
                                        <option value="{{$posts->province}}" selected hidden>{{$posts->province}}</option>
                                        <option value="Cebu" selected>Cebu</option>
                                    </select>
                                    <small>Province</small>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" aria-label="Default select example" onchange="myFunction()" id="selectedCity" name="" required> 
                                        <option value="{{$posts->city}}" selected hidden>{{$posts->city}}</option>
                                        <option value="Mandaue">Mandaue</option>
                                        <option value="Lapu-Lapu">Lapu-Lapu</option>
                                    </select>
                                    <small>City</small>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                

                                <select class="form-control" aria-label="Default select example" style="display:none;" id="city1" name="" onchange=getBarangay1() >
                                    <option value="{{$posts->barangay}}" selected hidden>{{$posts->barangay}}</option>
                                    <option value="Alang-alang">Alang-alang</option>
                                    <option value="Bakilid">Bakilid</option>
                                    <option value="Banilad">Banilad</option>
                                    <option value="Basak">Basak</option>
                                    <option value="Cabancalan">Cabancalan</option>
                                    <option value="Cambaro">Cambaro</option>
                                    <option value="Canduman">Canduman</option>
                                    <option value="Casili">Casili</option>
                                    <option value="Casuntingan">Casuntingan</option>
                                    <option value="Centro">Centro</option>
                                    <option value="Cubacub">Cubacub</option>
                                    <option value="Guizo">Guizo</option>
                                    <option value="Ibabao-Estancia">Ibabao-Estancia</option>
                                    <option value="Jagobiao">Jagobiao</option>
                                    <option value="Labogon">Labogon</option>
                                    <option value="Looc">Looc</option>
                                    <option value="Maguikay">Maguikay</option>
                                    <option value="Mantuyong">Mantuyong</option>
                                    <option value="Opao">Opao</option>
                                    <option value="Pakna-an">Pakna-an</option>
                                    <option value="Pagsabungan">Pagsabungan</option>
                                    <option value="Subangdaku">Subangdaku</option>
                                    <option value="Tabok">Tabok</option>
                                    <option value="Tawason">Tawason</option>
                                    <option value="Tingub">Tingub</option>
                                    <option value="Tipolo">Tipolo</option>
                                    <option value="Umapad">Umapad</option>
                                </select>
                                <!-- /barangays of Mandaue -->
                                <!-- barangays of Lapu-lapu -->
                                <select class="form-control" aria-label="Default select example" id="city2" style="display:none;" name="" onchange=getBarangay2() >
                                    <option value="{{$posts->barangay}}" selected hidden>{{$posts->barangay}}</option>
                                    <option value="Agus">Agus</option>
                                    <option value="Babag">Babag</option>
                                    <option value="Bankal">Bankal</option>
                                    <option value="Baring">Baring</option>
                                    <option value="Basak">Basak</option>
                                    <option value="Buaya">Buaya</option>
                                    <option value="Calawisan">Calawisan</option>
                                    <option value="Canjulao">Canjulao</option>
                                    <option value="Caw-oy">Caw-oy</option>
                                    <option value="Cawhagan">Cawhagan</option>
                                    <option value="Caubian">Caubian</option>
                                    <option value="Gun-ob">Gun-ob</option>
                                    <option value="Ibo">Ibo</option>
                                    <option value="Looc">Looc</option>
                                    <option value="Mactan">Mactan</option>
                                    <option value="Maribago">Maribago</option>
                                    <option value="Marigondon">Marigondon</option>
                                    <option value="Opon">Opon</option>
                                    <option value="Pajac">Pajac</option>
                                    <option value="Pajo">Pajo</option>
                                    <option value="Pangan-an">Pangan-an</option>
                                    <option value="Punta Engaño">Punta Engaño</option>
                                    <option value="Pusok">Pusok</option>
                                    <option value="Sabang">Sabang</option>
                                    <option value="Santa Rosa">Santa Rosa</option>
                                    <option value="Subabasbas">Subabasbas</option>
                                    <option value="Talima">Talima</option>
                                    <option value="Tingo">Tingo</option>
                                    <option value="Tungasan">Tungasan</option>
                                    <option value="San Vicente">San Vicente</option>
                                </select>
                                <!-- /barangays of Lapu-lapu -->
                                
                                <select class="form-select modal_input_select" aria-label="Default select example" id="city0" style="display:block;" disabled>
                                    <option value="{{Auth::user()->barangay}}" selected hidden>{{$posts->barangay}}</option>
                                </select>

                                <small>Barangay</small>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                
                                </div>

                                <input type="hidden" id="citt" name="city" value="{{$posts->city}}">
                                <input type="hidden" id="barr" name="barangay" value="{{$posts->barangay}}">

                                <div class="col-sm-5">
                                    <input type="text" name="sector" class="form-control" id="" placeholder="" value="{{$posts->sector}}" required>
                                    <small>House No./Street/Purok</small>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>        
                       </div> <!--/Address inputs-->

                    <!-- phone num row -->
                    <div class="col-md-4 mb-4" style="margin-top:15px;">
                        <label class="inputs_label">Registered GCash Number</label>
                        <div class="">
                            <img src="../../images/phflag.jpg" style="position:absolute; width:35px;margin:9px;" alt="">
                            <input maxlength="11" minlength="11" type="tel" name="phone_number" class="form-control pn @error('phone_number') is-invalid @enderror" id="phone" placeholder="0912 345 6789" value="{{$posts->phoneNumber}}" style="padding-left:50px;" autocomplete="off" required>
                        </div>

                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>wrong</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- phone num row end -->
                    
                    <!-- profile photo -->
                    <div class="col-md-12 mb-2" style="display:flex;">
                        <div class="col-sm-1" style="margin-right:15px;">
                            <img  class="profilepic2" src="/storage/profile_images/{{Auth::user()->profileImage}}" alt="">
                        </div>
                        <div class="col-sm-5" style="">
                                <div class="" style="position:relative;">
                                    <div class="form-group" style="">
                                        <label class="modal_row_title" style="">Change Your Profile Photo</label>
                                        <div class="input-group" style="">
                                            <span class="input-group-btn">
                                                <span class="btn btn-default btn-file" style="">
                                                    Add image<input type="file" id="imgInp" name="profile_image">
                                                </span>
                                            </span>
                                            <input  type="text" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        
                        <div class="col-sm-2" style="">
                            <small style="padding-left:10px;">Preview</small>
                            <img id='img-upload'/>
                        </div>
                    </div>
                    <!-- /profile photo -->
                    

                    <div class="w-100"></div>
                    <div class="" style="margin-top:20px;">
                        <div class="">
                            {{Form::hidden('_method', 'PUT')}}
                            {{Form::submit('Save Changes', ['class' => 'btn-violet'])}}
                        </div>
                    </div>
                    {!! Form::close() !!}
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
        var birth_year = parseInt($('#birth_year').val(), 10) || 0;
        var birth_month = parseInt($('#month').val(), 10) || 0;
        var birth_day = parseInt($('#day').val(), 10) || 0;
        var year = new Date();
        var curr_year = year.getFullYear();
        var curr_month = year.getMonth() + 1;
        var curr_day = String(year.getDate()).padStart(2, '0');
        if(birth_year == 0) {
            document.getElementById('age').value = 0;
        }

        if(curr_year-birth_year < 150) {
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
        }else{
            document.getElementById('age').value = 0;
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

<script type="text/javascript">
        
    function getBarangay1(){

        var barangay1 = document.getElementById('city1').value;

        document.getElementById("barr").value=barangay1;
    }

    function getBarangay2(){

        var barangay2 = document.getElementById('city2').value;

        document.getElementById("barr").value=barangay2;
    }
</script>

<script>
    var bar = document.getElementById('selectedCity').value;
    var mandaue = document.getElementById("city1");
    var lapu = document.getElementById("city2");
    var none = document.getElementById("city0");

    if(bar.value!=""){
        if (bar=="Mandaue")
        {
            mandaue.style.display = "block";
            none.style.display = "none";
                    
        }else if (bar=="Lapu-Lapu"){
            lapu.style.display = "block";
            none.style.display = "none";
        }
    }

    document.getElementById('test').value=barangay1;
</script>

<script>
    function myFunction() {
        var selectedCity = document.getElementById("selectedCity").value;
        var mandaue = document.getElementById("city1");
        var lapu = document.getElementById("city2");
        var none = document.getElementById("city0");
        document.getElementById("citt").value=selectedCity;
        document.getElementById("barr").value="";

        if (selectedCity == "Mandaue") {
            mandaue.style.display = "block";
            lapu.style.display = "none";
            none.style.display = "none";
            document.getElementById("city1").value = "";
        } else if (selectedCity == "Lapu-Lapu"){
            mandaue.style.display = "none";
            lapu.style.display = "block";
            none.style.display = "none";
            document.getElementById("city2").value = "";
        } 
    }
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