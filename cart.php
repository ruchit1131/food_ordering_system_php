<!-- This is webpage which lets the user delete unnecessary food items from the cart
and order the remaining food items -->
  
<?php 
session_start();
// If a customer is using the session, then only allow access to this page
// else redirect to the index.php page.
if($_SESSION['user'] != 'cus')
{
    header("Location: index.php?accessdenied=true");
    die();
}

include("config.php"); // Setting up connection to MySQL Database.

// delete a particular food item from the cart table
if(isset($_GET['id']))
{
    $sql = "DELETE FROM cart WHERE id=".$_GET['id'];
    $conn->query($sql);
}
//order the food
if(isset($_GET['order']))
{
    $sql = "SELECT * FROM cart WHERE user_id =". $_SESSION['id'];
    $result = $conn->query($sql);
    $price = 0;
    while($row = $result->fetch_assoc()) 
    {
        $food = $conn->query("SELECT * FROM food WHERE id =".$row['food_id'] )->fetch_assoc();
        $price = $price + $row['quantity'] * $food['price'];
        $conn->query("INSERT INTO orders VALUES (NULL,".$food['id'].",".$row['quantity'].",".$row['user_id'].",current_timestamp())");
        $cart_del = "DELETE FROM cart WHERE user_id=".$_SESSION['id'];
        $conn->query($cart_del);
    }
    //Outputs an alert with the Total amount to be paid after order
    echo '<script type="text/javascript">alert("Successfully ordered. Pay a total of '.$price.' rs on delivery.");</script>';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
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
    include("config.php");

    $sql = "SELECT * FROM cart WHERE user_id =". $_SESSION['id'];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) 
    {
        // output data of each row
        while($row = $result->fetch_assoc()) 
        {
            $food = $conn->query("SELECT * FROM food WHERE id =".$row['food_id'] )->fetch_assoc();
            $res = $conn->query("SELECT * FROM restaurents WHERE id =".$food['res_id'])->fetch_assoc();
            $pref = $food['pref']?"Non-veg":"Veg";
            echo "<div class='food'>";
            // shows all the food items in the cart.
            echo "<img width = '250' height = '250' style='vertical-align:top;' src=".$food['image']."> 
                 <h2>Name: " . $food["name"]. "<h2><h2>Price: " . $food["price"]." rs</h2>"."<h2>Food type: ".$pref."<h2>".
                 "<h2>Quantity: " . $row["quantity"]. "<h2><h2>Restaurent: " . $res["name"]."</h2>".
                 "<h2>Location: " . $res["location"]."</h2>".
                 "<a style='font-size:20px;', href='cart.php?id=".$row["id"]."'>Delete</a>";
            echo "</div>";
        }
        //Order button
        echo "</div><a style='font-size:30px; color:white; background-color:grey; border:solid black 2px;  margin: 10px; padding: 5px ; text-decoration:none; ', href='cart.php?order=true'>Order</a>"; 
    } 
    else 
        echo "Cart Empty</div>";
    $conn->close();
    ?>
</body>
</html>
  
    