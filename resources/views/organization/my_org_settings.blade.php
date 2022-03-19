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
    <title>Settings</title>
</head>
<body>
    
<div class="sticky-top">
@extends('layouts.settingsTopNav')
</div>

<div class="row side">
  <div class="col-3 large">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-personal-list" data-toggle="list" href="#list-personal" role="tab" aria-controls="home"><i class="fas fa-user icon"></i>My Information</a>
      <a class="list-group-item list-group-item-action" href="/users/{{$posts->id}}/change_password" role="tab" aria-controls="profile"><i class="fas fa-sign-in-alt icon"></i>Login Credentials</a>
    </div>
  </div>

  <!-- Personal Information -->
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-personal" role="tabpanel" aria-labelledby="list-personal-list">
        <label for="">Personal Info</label>
        <div class="personalcon">
            <div class="formcon">
                {!! Form::open(['action' => ['App\Http\Controllers\UsersController@update', $posts->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <!--form-row-->
                @include('inc.messages')
                <div class="form-row">
                    <!--org name input-->
                    <div class="col-md-6 mb-3">
                        <input type="hidden" value="" name="id"/>
                        <label for="org_name">Organization Name</label>
                        <input type="text" name="org_name" class="form-control" id="validationCustom01" placeholder="" value="{{$posts->orgName}}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div> <!--org name input-->
                    </div>
                    
                    <!--License input-->
                    <div class="col-md-6 mb-3" >
                        <label for="license label">Organization License</label>
                        <input type="text" name="license" class="form-control mi2" id="validationCustom01" placeholder="" value="{{$posts->license}}" required>
                        
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div> <!--/License input-->

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

                    <!--Phone number input-->
                    <div class="col-md-4 mb-4" style="margin-top:15px;">
                        <label for="phone_number label">Registered GCash Number</label>
                        <input type="text" name="phone_number" maxlength="14" minlength="9" class="form-control pn" id="" placeholder="Phone number..." value="{{$posts->phoneNumber}}" required>
                        
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div> <!--/Phone number input-->

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
        var birth_year = parseFloat(document.getElementById('birth_year').value);
        var year = new Date();
        var curr_year = year.getFullYear();
        document.getElementById('age').value = curr_year-birth_year;
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
        var regex = new RegExp("^[a-zA-Z0-9 ]+$");
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



<script src="../script/checkemail.js"></script>

<!--jquery-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!--/jquery-->

</script>
<!--jquery-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!--/jquery-->
</body>
</html>