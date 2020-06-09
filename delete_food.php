<!-- This is webpage which lets the restaurent delete food items fom its menu if needed
or the restaurent can simply see what food items it has uploaded. -->
<?php 
session_start();
// If a restaurent is using the session, then only allow access to this page
// else redirect to the index.php page.
if($_SESSION['user'] != 'res')
{
    header("Location: index.php?accessdenied=true");
    die();
}
include("config.php");// Setting up connection to MySQL Database.
//Delete food from 'cart','orders' and 'food' tables. 
//If food is not deleted from all these 3 tables, and just from the food table,
//the orders and cart table may still contain the food item which is deleted,
//but it no longer exists and this will cause error.
if(isset($_GET['id']))
{
    $sql = "DELETE FROM food WHERE id=".$_GET['id'];
    $conn->query($sql);
    $sql2 = "DELETE FROM orders WHERE food_id=".$_GET['id'];
    $conn->query($sql2);
    $sql3 = "DELETE FROM cart WHERE food_id=".$_GET['id'];
    $conn->query($sql3);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Food</title>
    <style>
         body{
            background-image: url('images/background.jpg');
            background-size: cover;
            
            }
        .menu {
            width: 75em;
            height: fit-content;
            border: solid lightblue 2px;
            margin: 10px;
            display: flex;
            flex-wrap: wrap;
            }
        .food{
            width: fit-content;
            height: fit-content;
            padding: 5px ; 
            margin: 18px; 
            display: block; 
            border: dashed  2px; 
        }
        
    </style>
</head>
<body>
<a  href="res_home.php"><h3 style = "margin-left: 10px;"><< Back</h3></a>
<div class="menu">
    <?php 
    $sql = "SELECT * FROM food WHERE res_id =". $_SESSION['id'];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) 
    {
        // output data of each row
        while($row = $result->fetch_assoc()) 
        {
            //Showing all the food items a restaurent created.
            $pref = $row['pref']?"Non-veg":"Veg";
            echo "<div class='food'>";
            echo "<img width = '250' height = '250' style='vertical-align:top;' src=".$row['image']."> 
                 <h2>Name: " . $row["name"]. "<h2><h2>Price: " . $row["price"]." rs</h2>"."<h2>Food type: ".$pref."<h2>".
                 "<a style='font-size:20px;', href='delete_food.php?id=".$row["id"]."'>Delete</a>";// Delete button
            echo "</div>";
        }
    } 
    else
        echo "NO FOOD";
        
    $conn->close();
    ?>
  </div>
</body>
</html>
  
    