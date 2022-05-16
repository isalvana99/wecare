<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/wecarelogo.png') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="../style/wecareRegUser.css" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <title>WeCare | Register</title>
</head>
<body>

    <div class="row parentdiv">
        <div class="col-45p lotdiv">
            <img src="../images/wecarebanner white.png" class="img-con" alt="">
            <p class="slogan">We Care. Let's help build the world a better place.</p>
            <div class="lottiecon">
                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                <lottie-player src="https://assets7.lottiefiles.com/packages/lf20_ZoMAMc.json"  background="transparent"  speed="1"  style="width: 103%; height: 103%;"  loop  autoplay></lottie-player>
            </div>
        </div>
        <div class="w-100 seperator"></div>
        <div class="col-55p rightdiv" >
            <div class="row">
                <div class="col-2 home_icon_col">
                    <a href="/">
                        <button class="home_icon_btn">
                            <i class="fas fa-home-alt home_icon"></i><span class="home_word">Home</span>
                        </button>
                    </a>
                </div>
                <div class="col-8">
                    <label for="" class="titlereg">Glad to see you !</label>
                </div>
                <div class="col-2">

                </div>
            </div>

            <div class="insidediv">
                <form class="needs-validation" novalidate method="POST" action="{{ route('register') }}">@csrf
                    <!-- org name row -->
                    <div class="row inputs_row">
                        <div class="col-sm-12">
                        @include('inc.messages')
                        </div>
                        <input type="hidden" name="firstname">
                        <input type="hidden" name="lastname">
                        <input type="hidden" name="middlename">
                        <input type="hidden" name="day">
                        <input type="hidden" name="month">
                        <input type="hidden" name="year">
                        <input type="hidden" name="age">
                        <input type="hidden" name="sex">
                        <input type="hidden" name="accounttype" value="RECEPIENT">
                        <input type="hidden" name="role" value="USER">

                        <!-- orgname row -->
                        <div class="col-sm-12">
                            <label class="inputs_label">Unit Name / Organization Name<span style="color:red;">*</span></label>
                            <input type="text" name="org_name" class="form-control" id="validationCustom01" value="{{ old('org_name') }}" placeholder="Ex: LGU of Mandaue" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div> 
                        </div>
                        <!-- orgname end -->

                        <!-- license row -->
                        <div class="col-sm-12">
                            <label class="inputs_label">Please provide your Group Certification No. / Accreditation No. as proof of Legitimacy<span style="color:red;">*</span></label>
                            <input type="text" name="license" value="{{ old('license') }}" class="form-control" id="license" placeholder="Certificate No." required>
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
                            <label class="inputs_label">Address<span style="color:red;">*</span></label>
                            <div class="row">

                               <!--  Region col -->
                                <div class="col-sm-3 col_mar_bot" style="display:none;">
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
                                <div class="col-sm-2 col_mar_bot" style="display:none;">
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
                                    <span class="inputs_label_small">Your City</span>
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
                                
                                    <span class="inputs_label_small">Your Barangay</span>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <!-- barangay col end -->

                            <input type="hidden" id="citt" name="city">
                            <input type="hidden" id="barr" name="barangay">

                            <!-- house street row -->
                                <div class="col-sm-5">
                                    <input type="text" autocomplete="off" name="sector" class="form-control" id="" placeholder="" value="" required>
                                    <span class="inputs_label_small">House No./Street/Purok/Sector</span>
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
                        <div class="col-sm-4">
                            <label class="inputs_label">Registered GCash Number<span style="color:red;">*</span> <small>(09XXXXXXXXX)</small> </label>
                            <div class="">
                                <img src="../images/phflag.jpg" style="position:absolute; width:35px;margin:9px;" alt="">
                                <input maxlength="11" minlength="11" type="tel" name="phone_number" class="form-control pn @error('phone_number') is-invalid @enderror" id="phone" placeholder="0912 345 6789" value="{{ old('phone_number') }}" style="padding-left:50px;" autocomplete="off" required>
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
                    </div>
                    <!-- phone num row end -->


                    <!-- email row -->
                    <div class="row inputs_row">
                        <div class="col-sm-6">
                            <label class="inputs_label">Email<span style="color:red;">*</span></label>
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
                            <label class="inputs_label">Password<span style="color:red;">*</span></label>
                            <input type="password" id="password" name="password" class="form-control password" placeholder="password" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <!-- password col end -->

                        <!-- confirm pass col -->
                        <div class="col-sm-6">
                            <label class="inputs_label">Confirm Password<span style="color:red;">*</span></label>
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
                                    Agree to <span type="button" class="term_con_btn" data-toggle="modal" data-target=".bd-example-modal-lg" style="color:blue !important;">terms and conditions</span>
                                </label>
                                <br>
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
                            <span>Already have an account?  <a href="/login">Login here.</a></span>
                        </div>
                        <div class="col-sm-6 reg_as_org">
                            <span><a href="/register">Register as Personal Account</a></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p class="paragraph">These are the Terms and Conditions which govern each use you make of the donation payment services provided through the Website.
            These Terms and Conditions apply separately to each single donation that you make. By confirming on the Website that you wish to make a donation you agree to be bound by these Terms and Conditions for that donation.
            </p>
            
            <label class="title_dark">1. The donation services</label>
            <p class="paragraph">We will use your donation at our discretion but within our stated charitable objectives.</p>
            <p class="paragraph">All payments through the Website are to be made via GCash.</p>
            <p class="paragraph">Once you confirm to us through the Website that you wish to proceed with your donation, your transaction will be processed through our payment services provider. By confirming that you wish to proceed with your donation you authorize WeCare to request funds from your Gcash provider.</p>

            <label class="title_dark">2. Information from you</label>
            <p class="paragraph">Before we can process a donation, you must provide us with <span class="inline_dark">(i)</span> your name, address and email address; and <span class="inline_dark">(ii)</span> details of the GCash that you wish to use to fund the donation. We will use this information to process your donation. It is your responsibility to ensure you have provided us with the correct information.</p>
            <p class="paragraph">When you submit your payment details, these details will be transferred to our payment provider, GCash, and your payment data will be collected and processed securely by them. You should make sure that you are aware of GCash’s terms and conditions, which are different from our own, to ensure that you are comfortable with how they will process your personal data before you make a donation.</p>
            <p class="paragraph">We won’t share your personal details with any other third party other than is set out in our Privacy Policy. Our Privacy Policy forms part of these Donation Payment Terms and Conditions and by agreeing to these Terms and Conditions you are also agreeing to the way we use and protect your personal information in line with our Privacy Policy.</p>

            <label class="title_dark">3. GCash Payment Processing</label>
            <p class="paragraph">WeCare offers payments through GCash, a third-party payment processor. The GCash Terms of Service are available here: https://www.gcash.com/terms-and-conditions. The GCash Privacy Policy is available here: https://www.gcash.com/privacy-notice/20200727/. If you use the GCash payment service, you agree to the GCash Terms of Service and Privacy Policy for the country in which you are located. If you have questions regarding the GCash Terms of Service or Privacy Policy, please refer to the GCash website www.gcash.com or contact GCash at https://help.gcash.com/hc/en-us.</p>
            
            <label class="title_dark">4. Security</label>
            <p class="paragraph">We are committed to ensuring donor personal data from unauthorized access, modification, disclosure, or destruction. Among other things, we attempt a range of security practices, including measures to assist secure web access to sensitive information and undertake efforts to address security vulnerabilities for different devices and databases.</p>

            <label class="title_dark">5. Legal Requirements</label>
            <p class="paragraph">In spite of the fact that such a circumstance may be unlikely, WeCare may be required to disclose user information to appropriate authorities in accordance with law, whether by subpoena or other authentic request, or in case, in our business judgment, such disclosure is sensibly essential to secure the rights, property, or individual safety of our Website, us, our affiliates, our officers, executives, employees, representatives, our licensors, other users, and/or the public.</p>

            <label class="title_dark">6. Interactive Parts of WeCare Website</label>
            <p class="paragraph">WeCare accepts no responsibility or liability in respect of the conduct of any user in connection with the use of posting page, or other message or communication facilities made available on its sites, or for any material submitted by users and carried on WeCare website including, for example, responsibility or liability for the accuracy or reliability of any information, data, opinions, advice or statements made in such material. Chats or comments, postings, and other communications by any users are not endorsed by the WeCare. WeCare reserves the right to remove, for any reason and without notice, any content received from users.</p>

            <label class="title_dark">7. General</label>
            <p class="paragraph">You have got certain rights with regard to the data we collect about you. Upon request, we'll tell you what information we hold about you and correct any incorrect data. We will moreover make reasonable endeavors to delete your data in case you ask us to do so, unless we are otherwise required to keep it. Thus, we reserve the right to amend these Donation Payment Terms and Conditions at any time.</p>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

            $('#license').on('keypress', function (event) {
            var regex = new RegExp("^[a-zA-Z0-9-]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
            event.preventDefault();
            return false;
            }
            });
        });
    </script>

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