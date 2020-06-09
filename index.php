<!-- This is the index page. This page will load up in the starting. 
User can register or login or can see the menu but cannot order without logging in as a customer-->
<?php 
session_start();
include("redirect_to_home.php");
if(isset($_GET['reg_success']))// If a registration is successful
{ 
    echo '<script type="text/javascript">alert("Registered successfully");</script>';
}
if(isset($_GET['accessdenied']))// If a user not logged in tries to access the customer or restaurent specific pages, he/she is 
                                // redirected to index.php page. If someone is logged in, and tries to access pages which are denied,
                                // he/she will be redirected to their home page whether restaurent or customer.
{ 
    echo '<script type="text/javascript">alert("Access Denied");</script>';
}
if(isset($_GET['loggedout']))//If a user tries to use the logout.php script using the url but no one is logged in.
{
    echo '<script type="text/javascript">alert("No one logged in!");</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssnormalize/cssnormalize-min.css">
    <style>
        body{
            background-image: url('images/background.jpg');
            background-size: cover;
            
      }
        .nav{
            display: inline-flex;
            background-color: #333;
            width: fit-content;
            margin: 5em 5em 5em 25em;
            list-style: none;
            position: absolute;
            top: 30%;
        }
        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 15px;
            text-decoration: underline;
            border: 1px solid #bbb;
        }
        h1{
            font-family: "Comic Sans MS", cursive, sans-serif;
            font-style: oblique;
            font-weight: bold;
            font-size: 7em;
        }
        
    </style>
    <title>FoodShala</title>
</head>
<body>
    <nav>
        <center><h1>FOODSHALA</h1></center>
        <div class = "nav">
        <li><a href="menu.php">Menu</a></li>
        <li><a href="login_usr.php">Login(Customer)</a></li>
        <li><a href="login_res.php">Login(Restaurent)</a></li>
        <li><a href="register_usr.php">Register(Customer)</a></li>
        <li><a href="register_res.php">Register(Restaurent)</a></li>
        
      </div>
    </nav>
</body>
</html>
