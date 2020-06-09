<!--Logout Page-->
<?php
    session_start();
    if(isset($_SESSION['id'])){
    session_destroy();
    header("Location: index.php");
    die();}
    else
    {
    header("Location: index.php?loggedout=true");
    die();}
?>