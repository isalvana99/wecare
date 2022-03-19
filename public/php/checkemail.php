<?php
include('../includes/config.php');
if(isset($_POST['check_submit_btn']))
{
    $email = $_POST['email_id'];
    $sql="SELECT * FROM user WHERE useremail=:email";
    $query=$dbh->prepare($sql);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetch(PDO::FETCH_ASSOC);
    if($query->rowCount()>0)
    {
     // echo "<script type='text/javascript'>alert('Email already exist')</script>";
      //echo "<script type='text/javascript'>window.history.go(-1); return false;</script>";
      echo "*email already exist";
    }else{
        echo "";
    }
}
?>