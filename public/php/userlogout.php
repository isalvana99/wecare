<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['userid']);

header("Location:../html/WeCare.php");
?>