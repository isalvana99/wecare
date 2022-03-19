<?php
session_start();
include('../includes/config.php');

if (isset($_POST['submit'])) {
  // receive all input values from the form
  $id = $_POST['id'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $mi = $_POST['mi'];
  $birthday = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
  $age = $_POST['age'];
  $sex = $_POST['sex'];
  $useraddress = $_POST['address'];
  $email = $_POST['email'];
  $password_1 = $_POST['password_1'];
  $password_2 = $_POST['password_2'];
  $verified = "NO";


  // a user does not already exist with the same email

  $sql="SELECT * FROM user WHERE useremail=:email";
    $query=$dbh->prepare($sql);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetch(PDO::FETCH_ASSOC);
    if($query->rowCount()>0)
    {
     // echo "<script type='text/javascript'>alert('Email already exist')</script>";
      //echo "<script type='text/javascript'>window.history.go(-1); return false;</script>";
      $_SESSION['status'] = "Email already exist!" ;
      header('Location: ../html/register.php');
    }else{
  	$userpassword = hash("sha256",$password_1);//encrypt the password before saving in the database

  	$sql = "INSERT INTO user (userid, firstname, lastname, mi, birthday, age, sex, useraddress,  useremail, userpassword, verified) 
  			  VALUES(:id, :firstname, :lastname, :mi,:birthday, :age, :sex, :useraddress, :email, :userpassword, :verified)";

    $query=$dbh->prepare($sql);
    $query->bindParam(':id',$id,PDO::PARAM_STR);
    $query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
    $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
    $query->bindParam(':mi',$mi,PDO::PARAM_STR);
    $query->bindParam(':birthday',$birthday,PDO::PARAM_STR);
    $query->bindParam(':age',$age,PDO::PARAM_STR);
    $query->bindParam(':sex',$sex,PDO::PARAM_STR);
    $query->bindParam(':useraddress',$useraddress,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':userpassword',$userpassword,PDO::PARAM_STR);
    $query->bindParam(':verified',$verified,PDO::PARAM_STR);
    $query->execute();

    $_SESSION['email'] = $email;
    $_SESSION['userid'] = $id;
    
    echo "<script type='text/javascript'>document.location='../html/user/home.php?id=$id?user=$email';</script>";
  }
}
?>