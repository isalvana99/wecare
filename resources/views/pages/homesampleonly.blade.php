<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="images/wecarelogo.png"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="../style/wecareRegUser.css" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="build/css/countrycode.css">
    <link rel="stylesheet" href="build/css/telInput.css">
    <title>WeCare | Log In</title>
</head>
<body>
    <input type="hidden" name="value" id="">
    <div class="row parentdiv">
        <div class="col-45p lotdiv">
            <img src="../images/wecarebanner white.png" class="img-con" alt="">
            <p class="slogan">We Care. Hindi kami nangingi-alam. Kami ay concern lang.<br>PS. Scammer din po kami.</p>
            <div class="lottiecon">
                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                <lottie-player src="https://assets7.lottiefiles.com/packages/lf20_ZoMAMc.json"  background="transparent"  speed="1"  style="width: 103%; height: 103%;"  loop  autoplay></lottie-player>
            </div>
        </div>
        <div class="w-100 seperator"></div>
        <div class="col-55p rightdiv" >
            <div class="row">
                <div class="col-2 home_icon_col">
                    <button class="home_icon_btn">
                        <i class="fas fa-home-alt home_icon"></i><span class="home_word">Home</span>
                    </button>
                </div>
                <div class="col-8">
                    <label for="" class="titlereg">Glad to see you !</label>
                </div>
                <div class="col-2">

                </div>
            </div>

            <div class="insidediv">
                <form class="needs-validation" novalidate method="POST" action="{{ route('register') }}">
                    <!-- org name row -->
                    <div class="row inputs_row">

                        <input type="hidden" name="firstname">
                        <input type="hidden" name="lastname">
                        <input type="hidden" name="middlename">
                        <input type="hidden" name="day">
                        <input type="hidden" name="month">
                        <input type="hidden" name="year">
                        <input type="hidden" name="age">
                        <input type="hidden" name="sex">
                        <input type="hidden" name="role" value="USER">

                        <!-- orgname row -->
                        <div class="col-sm-6">
                            <label class="inputs_label">Organization Name</label>
                            <input type="text" name="org_name" class="form-control" id="validationCustom01" placeholder="Organization Name" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div> 
                        </div>
                        <!-- orgname end -->

                        <!-- license row -->
                        <div class="col-sm-6">
                            <label class="inputs_label">Organization License</label>
                            <input type="text" name="license" class="form-control" id="validationCustom02" placeholder="License" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <!-- license end -->

                        
                    </div>
                    <!-- org name row end -->

                    <!-- Address row -->
                    <div class="row inputs_row">
                        <div class="col">
                            <label class="inputs_label">Address</label>
                            <div class="row">

                               <!--  Region col -->
                                <div class="col-sm-3 col_mar_bot">
                                    <select class="form-control" name="region" required> 
                                        <option value="Region 7" selected>Region 7</option>
                                    </select>
                                    <span class="inputs_label_small">Region</span>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <!-- region col end -->

                                <!--  province col -->
                                <div class="col-sm-2 col_mar_bot">
                                    <select class="form-control" name="province" required>
                                        <option value="Cebu" selected>Cebu</option>
                                    </select>
                                    <span class="inputs_label_small">Province</span>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <!-- province col end -->

                                <!-- city col -->
                                <div class="col-sm-3 col_mar_bot">
                                    <select class="form-control" aria-label="Default select example" onchange="myFunction()" id="selectedCity" name="" required> 
                                        <option value="" selected hidden></option>
                                        <option value="Mandaue">Mandaue</option>
                                        <option value="Lapu-Lapu">Lapu-Lapu</option>
                                    </select>
                                    <span class="inputs_label_small">City</span>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <!-- city col end -->

                                <!-- barangay col -->
                                <div class="col-sm-4 col_mar_bot">
                                    <!-- barangays of Mandaue -->
                                    <select class="form-control" aria-label="Default select example" style="display:none;" id="city1" name="" onchange=getBarangay1() >
                                        <option value="" selected hidden></option>
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
                                        <option value="" selected hidden></option>
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

                                    <select class="form-control" aria-label="Default select example" id="city0" style="display:block;" disabled name="" >
                                        <option>Select City first</option>
                                    </select>
                                
                                    <span class="inputs_label_small">Barangay</span>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <!-- barangay col end -->
                            </div>

                            <input type="hidden" id="citt" name="city">
                            <input type="hidden" id="barr" name="barangay">

                            <!-- house street row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="sector" class="form-control" id="" placeholder="" value="" required>
                                    <span class="inputs_label_small">House No./Street/Purok/span>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <!-- house street row end-->
                        </div>
                    </div>
                    <!-- Address row end -->
                    
                    <!-- phone num row -->
                    <div class="row inputs_row">
                        <div class="col-sm-6">
                            <label class="inputs_label">Registered GCash Number</label>
                            <div class="input-box">
                                <input type="hidden" id="unitspan" name="phone_number">
                                <input maxlength="14" minlength="9" type="tel" name="phone_number2" class="form-control pn @error('phone_number') is-invalid @enderror" id="phone" placeholder="912 345 6789" value="{{ old('phone_number') }}"  required>
                                <span class="unit" id="unitspan2" value=""></span>
                            </div>

                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>
                    <!-- phone num row end -->


                    <!-- email row -->
                    <div class="row inputs_row">
                        <div class="col-sm-6">
                            <label class="inputs_label">Email</label>
                            <label id="emailreport" style="font-size:10px; color:red;"></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="example@email.com" value="{{ old('email') }}" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- email row end -->

                    <div class="row inputs_row">

                        <!-- password col -->
                        <div class="col-sm-6">
                            <label class="inputs_label">Password</label>
                            <input type="password" id="password" name="password" class="form-control password" placeholder="password" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <!-- password col end -->

                        <!-- confirm pass col -->
                        <div class="col-sm-6">
                            <label class="inputs_label">Confirm Password</label>
                            <label id="passwordreport" style="font-size:10px; color:red;"></label>
                            <input type="password" id="confirm_password" name="password_confirmation" class="form-control password_confirmation" placeholder="confirm_password" required>
                             <span id="confirm_password_msg"></span>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <!-- confirm pass col end -->
                    </div>

                    <!-- terms and condition row -->
                    <div class="row inputs_row_2">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required style="margin-left:-10px;">
                                <label class="form-check-label" for="invalidCheck" style="margin-left:10px;">
                                    Agree to terms and conditions
                                </label>
                                <div class="invalid-feedback">
                                    *You may proceed if you agree to terms and conditions.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- terms and condition row end -->
                    
                    <!-- register button -->
                    <div class="row btn_reg_row">
                        <div class="col">
                            <button onclick="checkVal()" type="submit" name="submit" id="submit">
                                Register
                            </button>
                        </div>
                    </div>
                    <!-- register button end -->

                    <div class="row link_row">                        
                        <div class="col-sm-6 link_login">
                            <span>Already have an account?  <a href="">Login here.</a></span>
                        </div>
                        <div class="col-sm-6 reg_as_org">
                            <span><a href="">Register as an Organization</a></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!--/jquery-->

    <!--Javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <!--/script-->

    <script type="text/javascript">
        
        function checkVal(){
            
            var phnum = document.getElementById('phone');
            if(phnum == ""){
                document.getElementById("phone").style.borderColor = "red";
            }
        
        }
    </script>

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
        var curr_day = String(year.getDate()). padStart(2, '0');

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
        
    <script type="text/javascript">
     $(document).ready(function () {
         $(".password_confirmation").keyup(function (e) { 
             var password_1 = $('.password').val();
             var password_2 = $('.password_confirmation').val();

             if(password_1 != password_2){
                 $("#passwordreport").text("   *password did not match");
                 document.getElementById("submit").disabled = true;
             }else if(password_2== null){
                 $("#passwordreport").text("");
                document.getElementById("submit").disabled = false;
             }else{
                 $("#passwordreport").text("");
                document.getElementById("submit").disabled = false;
             }
         });
     });
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

    <script src="build/js/intlTelInput3.js"></script>
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
        utilsScript: "build/js/utils.js",
        });
    </script>

    <script>
        //$("#selectid").find("option").eq(0).remove();
        $('select > option:first').hide();
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
            } else if (selectedCity == "none" || selectedCity == ""){
                mandaue.style.display = "none";
                lapu.style.display = "none";
                none.style.display = "block";
                document.getElementById("city0").value = 'Select City';
            }
        }
    </script>

</body>
</html>