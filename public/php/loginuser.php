<?php
session_start();
include('../includes/config.php');

if (isset($_POST['submit'])) {

    $email=$_POST['email'];
    $password=$_POST['password'];

    $sql="SELECT * FROM user WHERE useremail=:email AND userpassword=:userpassword";
    $query=$dbh->prepare($sql);

    $query->bindParam(':email',$email,PDO::PARAM_STR);
    
    $enc_password = hash('sha256', $password);
    $query->bindParam(":userpassword", $enc_password, PDO::PARAM_STR);

    $query->execute();
    $results=$query->fetch(PDO::FETCH_ASSOC);
    if($query->rowCount()>0)
    {   
        $id=$results["userid"];
        $_SESSION['email'] = $email;
        $_SESSION['userid'] = $id;
    
        echo "<script type='text/javascript'>document.location='../html/user/home.php?id=$id?user=$email';</script>";  
    }
}

?>