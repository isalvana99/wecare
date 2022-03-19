<?php
session_start();
include('C:\xampp\htdocs\abc123learning\includes\config.php');
if(isset($_POST['submit']))
{
    $fname=strtoupper($_POST['fname']);
    $mname=strtoupper($_POST['mname']);
    $lname=strtoupper($_POST['lname']);
    $bday=strtoupper($_POST['bday']);
      $dateOfBirth = $bday;
      $today = date("d M Y");
      $diff = date_diff(date_create($dateOfBirth), date_create($today));
      $age = $diff->format('%y');
    $contact=strtoupper($_POST['contact']);
    $address=strtoupper($_POST['address']);
    $email=$_POST['email'];
    $gender=strtoupper($_POST['gender']);
    $password=$_POST['password'];
    $role=strtoupper($_POST['role']);

    $sql="SELECT * FROM user WHERE email=:email";
    $query=$dbh->prepare($sql);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetch(PDO::FETCH_ASSOC);
    if($query->rowCount()>0)
    {
      echo "<script type='text/javascript'>document.location='registration-login.php';</script>";
    }else{


    $sql="INSERT INTO user(fname, mname, lname, bday, age, contact, address, email, gender, password, role)VALUES(:fname, :mname, :lname, :bday, :age, :contact, :address, :email, :gender, :password, :role)";
    $query=$dbh->prepare($sql);
    $query->bindParam(':fname',$fname,PDO::PARAM_STR);
    $query->bindParam(':mname',$mname,PDO::PARAM_STR);
    $query->bindParam(':lname',$lname,PDO::PARAM_STR);
    $query->bindParam(':bday',$bday,PDO::PARAM_STR);
    $query->bindParam(':age',$age,PDO::PARAM_STR);
    $query->bindParam(':contact',$contact,PDO::PARAM_STR);
    $query->bindParam(':address',$address,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':gender',$gender,PDO::PARAM_STR);
    $query->bindParam(':password',$password,PDO::PARAM_STR);
    $query->bindParam(':role',$role,PDO::PARAM_STR);
    $query->execute();

    echo "<script type='text/javascript'>document.location='login.php';</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="copyright" content="MACode ID, https://macodeid.com/">
  <title>Create New Account</title>
  <link rel="shortcut icon" type="image/x-icon" href="../assets/logo/logo2small.png"/>
  <link rel="stylesheet" href="../assets/css/maicons.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">
  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">
  <link rel="stylesheet" href="../assets/css/theme.css">
  <link rel="stylesheet" href="../assets/css/forpages.css">
  <link href="../assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
  <link href="../assets/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
  <link href="../assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
  

  <!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

</head>
<style type="text/css">
/*For role buttons css*/
.rolebutton {
    visibility:hidden;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
.rolebuttonlabel {
    cursor: pointer;
    border: 1px solid rgb(61, 138, 247); 
    padding: 35px; 
    padding-left: 13%; 
    padding-right: 10.32%; 
    background-color: transparent; 
    color: rgb(61, 138, 247);
    width: 48.5%;
}
.rolebutton:checked + .rolebuttonlabel {
    background: #4d88ff;
    color:  white;
}
/**/
/*submit button css*/
#submitbutton {
  background-color: #4492ff;
  width:40%; 
  border-radius: 25px;
  float: right;
}
#submitbutton:hover {
  background-color: #25f36e;
}
#submitbutton:focus {
  background-color: #008f1f;
}
/**/
</style>
<body>
<?php include('..\includes\abctopbarlogin.php')?>

    <div class="container">
      <form class="mt-5" method="post">
        <table>
          <tr>
            <td width="50%" rowspan="2" style="vertical-align:top;">
              <img src="../assets/logo/logo2small.png" class="wow zoomIn" alt="ABC123LEARNING" style="width: 85%; height: 85%;" />
              <div class="col-12 py-2 wow fadeInLeft"><h3 class="webname" style="color: rgb(61, 138, 247);">ABC123LEARNING</h3></div>
            </td>
            <td width="50%">
              <h5 style="text-align: center;">Welcome to ABC123LEARNING. Please set up your account.</h5>
              <p id="error1" style="color:red; text-align:left;"></p>
              <div class="iwantborder wow fadeInDown">
                  <input type='radio' value='teacher' name='role' id='teacher' class="rolebutton" required onclick="colorRole()"/>
                  <label for='teacher' class="rolebuttonlabel" id='teacherlbl'><i class="fas fa-user"></i> I want to teach</label>
                  <input type='radio' value='student' name='role'  id='student' class="rolebutton" required onclick="colorRole()"/>
                  <label for='student' class="rolebuttonlabel" id='studentlbl'><i class="fas fa-user"></i> I want to learn</label>
              </div>
            </td>
          </tr>
          <tr>
            <td width="50%">
              <div style="border: 1px solid rgb(61, 138, 247); padding: 5%;">
                <span style="color: rgb(61, 138, 247);">Please enter your details here:</span>
                <div class="col-12 py-2 wow fadeInLeft">
                  <p id="errorname" style="color:red;"></p>
                  <label for="fname" style="color: rgb(61, 138, 247);">First Name</label>
                  <input type="text" name="fname" id="fname" class="form-control" required="required" autocomplete="on" placeholder="Ex: Juan">
                </div>
                <div class="col-12 py-2 wow fadeInRight">
                  <label for="mname" style="color: rgb(61, 138, 247);">Middle Name</label>
                  <input type="text" name="mname" id="mname" class="form-control" required="required" autocomplete="on" placeholder="Ex: Smith">
                </div>
                <div class="col-12 py-2 wow fadeInLeft">
                  <label for="lname" style="color: rgb(61, 138, 247);">Last Name</label>
                  <input type="text" name="lname" id="lname" class="form-control" required="required" autocomplete="on" placeholder="Ex: Dela Cruz">
                </div>
                <div class="col-12 py-2 wow fadeInRight">
                  <label for="bday" style="color: rgb(61, 138, 247);">Birthdate</label>
                  <input type="date" id="bday" name="bday" class="form-control" required="required" autocomplete="on">
                </div>
                <div class="col-12 py-2 wow fadeInLeft"  style="padding: 10px">
                  <label for="gender" style="color: rgb(61, 138, 247);">Gender</label><br>
                  <div style="padding: 8px">
                  <input type="radio" name="gender" value="Male" required="required"> Male &nbsp;&nbsp;
                  <input type="radio" name="gender" value="Female" required="required"> Female &nbsp;&nbsp;
                  <input type="radio" name="gender" value="Other" required="required"> Other
                  </div>
                </div>
                <div class="col-12 py-2 wow fadeInRight">
                  <label for="address" style="color: rgb(61, 138, 247);">Address</label>
                  <input type="text" id="address" name="address" class="form-control" required="required" autocomplete="on">
                </div>
                <span id="errornum" style="color:red;"></span>
                <div class="col-12 py-2 wow fadeInLeft">
                  <label for="contact" style="color: rgb(61, 138, 247);">Contact Number</label>
                  <input type="text" id="contact" name="contact" class="form-control" required="required" autocomplete="on" placeholder="Ex: 09876543210">
                </div>
                <span id="emailmsg" style="color:red;"></span>
                <span id="erroremail" style="color:red;"></span>
                <div class="col-12 py-2 wow fadeInRight">
                  <label for="email" style="color: rgb(61, 138, 247);">Email</label>
                  <input type="email" id="email" name="email" class="form-control" required="required" autocomplete="on" placeholder="Ex: juandelacruz@gmail.com">
                </div>
                <div class="col-12 py-2 wow fadeInLeft">
                  <label for="password" style="color: rgb(61, 138, 247);">Password</label>
                  <input type="password" id="password" name="password" class="form-control" required="required" placeholder="********">
                </div>
                <div>
                  <br>
                  <p id="error" style="color:red; text-align:right;"></p>
                </div>
                <div class="col-12 py-2 wow fadeInZoom">  
                  <button type="submit" name="submit" class="btn btn-primary wow zoomIn" id="submitbutton"  onclick="checkButton()">Submit</button>
                </div>
                <div style="height: 20px;"></div>
              </div>
            </td>
          </tr>
        </table>
      </form>
    </div>
    <br>
    <br>
  <?php include('..\includes\abcfooter.php')?>
<script type="text/javascript">
  function checkButton() {   

    var regName = /^[ a-zA-Z\-\']+$/;
   var fname = document.getElementById('fname').value;
   var mname = document.getElementById('mname').value;
   var lname = document.getElementById('lname').value;
   if((!regName.test(fname)|| !regName.test(mname)|| !regName.test(lname)) && 
    (fname != null || mname != null || lname != null) && 
    (fname != "" || mname != "" || lname != "")){
      document.getElementById("errorname").innerHTML = "*Please enter a valid name.";
      document.getElementById("error").innerHTML = "*Please check your details above.";
      document.getElementById("fname").style.borderColor = "red";
      document.getElementById("mname").style.borderColor = "red";
      document.getElementById("lname").style.borderColor = "red";
    }else{
      document.getElementById("errorname").innerHTML = "";
      document.getElementById("error").innerHTML = "";
      document.getElementById("fname").style.borderColor = "#d6dbd9";
      document.getElementById("mname").style.borderColor = "#d6dbd9";
      document.getElementById("lname").style.borderColor = "#d6dbd9";
    }


    var contactNum = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
    var num = document.getElementById('contact').value;
    if(!contactNum.test(num) && num != null && num != ""){
      document.getElementById("errornum").innerHTML = "*Please enter a valid contact number.";
      document.getElementById("error").innerHTML = "*Please check your details above.";
      document.getElementById("contact").style.borderColor = "red";
    }else{
      document.getElementById("errornum").innerHTML = "";
      document.getElementById("error").innerHTML = "";
      document.getElementById("contact").style.borderColor = "#d6dbd9";
    }

    var emailCheck = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var email = document.getElementById('email').value;
    if(!emailCheck.test(email) && email != null && email != ""){
      document.getElementById("erroremail").innerHTML = "*Please enter a valid email address.";
      document.getElementById("error").innerHTML = "*Please check your details above.";
      document.getElementById("email").style.borderColor = "red";
    }else{
      document.getElementById("erroremail").innerHTML = "";
      document.getElementById("error").innerHTML = "";
      document.getElementById("email").style.borderColor = "#d6dbd9";
    }

    if(!document.getElementById('teacher').checked && !document.getElementById('student').checked){
       document.getElementById("error1").innerHTML = "*Please choose a category.";
       document.getElementById("error").innerHTML = "*Please check your details above.";
       document.getElementById("teacherlbl").style.borderColor = "red";
       document.getElementById("studentlbl").style.borderColor = "red";
   }else{
      document.getElementById("error1").innerHTML = "";
      document.getElementById("error").innerHTML = "";
   }

   

    
 }

function colorRole() {   
       document.getElementById("teacherlbl").style.borderColor = "rgb(61, 138, 247)";
       document.getElementById("studentlbl").style.borderColor = "rgb(61, 138, 247)";
 }

</script>
<script src="../assets/js/jquery-3.5.1.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
<script src="../assets/vendor/wow/wow.min.js"></script>
<script src="../assets/js/google-maps.js"></script>
<script src="../assets/js/theme.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIA_zqjFMsJM_sxP9-6Pde5vVCTyJmUHM&callback=initMap"></script>
</body>
</html>