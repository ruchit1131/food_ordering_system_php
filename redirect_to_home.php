<?php
// If a customer is already logged in, he/she will be redirected to the home page cus_home.php
if(isset($_SESSION['user']) &&  $_SESSION['user']== 'cus')
{
    header("Location: cus_home.php");
    die();
}
// If a restaurent is already logged in, he/she will be redirected to the home page res_home.php
if(isset($_SESSION['user']) &&  $_SESSION['user']== 'res')
{
    header("Location: res_home.php");
    die();
}
?>