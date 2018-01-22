<?php
session_start();
$num= $_POST['num'];
$_SESSION['num']=$num;
header("Location:http://localhost/WithLove-Food/showContent.php");
?>