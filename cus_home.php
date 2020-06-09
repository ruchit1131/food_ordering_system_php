<!-- This is the home page for Customers -->

<?php
session_start();
// If a customer is using the session, then only allow access to this page
// else redirect to the index.php page.
if($_SESSION['user'] != 'cus')
{
    header("Location: index.php?accessdenied=true");
    die();
} 
include("config.php");// Setting up connection to MySQL Database.
// Getting name of customer from customers table.
$name_ = $conn->query("SELECT name FROM customers WHERE id =".$_SESSION['id'])->fetch_assoc();
$name = $name_['name'];
$conn->close();
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
            margin: 5em 5em 5em 5em;
            position: absolute;
            left: 33em;
            list-style: none;
            position: absolute;
            top: 40%;
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
    <title>Home</title>
</head>
<body>
    <nav>
    <center><h3>Welcome <?php echo $name?></h3></center>
        <center><h1>FOODSHALA</h1></center>
        
        <div class = "nav">
        <li><a href="menu.php">Menu</a></li>
        <li><a href="cart.php">My Cart</a></li>
        <li><a href="cus_orders.php">My orders</a></li>
        <li><a href="logout.php">Logout</a></li>
        
      </div>
    </nav>
</body>
</html>
