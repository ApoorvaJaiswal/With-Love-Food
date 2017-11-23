<?php
session_start();
$num= $_POST['num'];
$_SESSION['num']=$num;
header("Location:http://localhost/With%20Love-Food/showContent.php");
?>