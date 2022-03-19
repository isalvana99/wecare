@extends('layouts.topbar_users')
@section('content')

<h1>Edit Profile</h1>
{!! Form::open(['action' => ['App\Http\Controllers\UsersController@update', $posts->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<!--form-row-->
<div class="form-row">
<!--first name input-->
<div class="col-md-5 mb-3">
    <label for="firstname">First name</label>
    <input type="text" name="firstname" class="form-control" id="validationCustom01" placeholder="John" value="{{$posts->firstName}}" required>
    <div class="valid-feedback">
        Looks good!
    </div> 
</div>
<!--first name input-->

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
    <label for="mi">M.I.</label>
    <input type="text" name="mi" class="form-control" id="validationCustom02" placeholder="M" value="{{$posts->middleName}}" required>
    <div class="valid-feedback">
        Looks good!
    </div>
</div> <!--/Middle initial input-->

<!--Birthday inputs-->
<div class="col-md-8 mb-3">
    <label for="birthday">Birthday</label>
    <div class="row">
        <div class="col-sm-3 col-sm-2">
            <select class="form-control" id="exampleFormControlSelect1" name="day" required> 
            <option value="{{substr($posts->birthday,6,2);}}">{{substr($posts->birthday,6,2);}}</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
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
            </select>
            <small>Day</small>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>

        <p style="font-size:25px; opacity:.5;" id="slash">/</p>

        <div class="col-sm-3">
            <select class="form-control" id="exampleFormControlSelect1" name="month" required>
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
            <input type="text" name="year" onkeyup=getAge() class="form-control" id="birth_year" placeholder="YYYY" value="{{substr($posts->birthday,0,4);}}" required style="width:65px;">
            <small>Year</small>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
    </div>        
</div> <!--/Birthday inputs-->

<!--Age input-->
<div class="col-md-2 mb-3">
    <label for="age label">Age</label>
    <input type="text" name="age" class="form-control" id="age" placeholder="" value="" required readonly>
    
    <div class="valid-feedback">
        Looks good!
    </div>
</div> <!--/Age input-->

<!--sex input-->
<div class="col-md-3" style="margin-left:0px;">
    <label for="sex label">Sex</label>
    <div class="form-check">
        <input  class="form-check-input" name="sex" type="radio" name="exampleRadios" id="exampleRadios1" value="Female" required {{ ($posts->sex=="Female")? "checked" : "" }} >
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
<div class="col-md-12 mb-3" style="margin-top:15px;">
    <label for="address label">Address</label>
    <input type="text" name="address" class="form-control" id="" placeholder="Street, Barangay, Municipality, Province/City" value="{{$posts->address}}" required>
    
    <div class="valid-feedback">
        Looks good!
    </div>
</div> <!--/Address input-->

<!--Phone number input-->
<div class="col-md-12 mb-3" style="margin-top:15px;">
    <label for="phone_number label">Phone Number</label>
    <input type="text" name="phone_number" maxlength="14" minlength="9" class="form-control" id="" placeholder="Phone number..." value="{{$posts->phoneNumber}}" required>
    
    <div class="valid-feedback">
        Looks good!
    </div>
</div> <!--/Phone number input-->

<div class="form-group">
{{Form::file('profileImage')}}
</div>

{{Form::hidden('_method', 'PUT')}}
{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
{!! Form::close() !!}

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
    
    

<script src="../script/checkemail.js"></script>


<!--Javascript-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<!--/script-->

<script src="../build/js/intlTelInput2.js"></script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
    // allowDropdown: false,
    // autoHideDialCode: false,
    // autoPlaceholder: "off",
    // dropdownContainer: document.body,
    // excludeCountries: ["us"],
    // formatOnDisplay: false,
    // geoIpLookup: function(callback) {
    //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
    //     var countryCode = (resp && resp.country) ? resp.country : "";
    //     callback(countryCode);
    //   });
    // },
    // hiddenInput: "full_number",
    // initialCountry: "auto",
    // localizedCountries: { 'de': 'Deutschland' },
    // nationalMode: false,
    // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
    // placeholderNumberType: "MOBILE",
    // preferredCountries: ['cn', 'jp'],
    // separateDialCode: true,
    utilsScript: "build/js/utils.js",
    });
</script>
@endsection
