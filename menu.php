<!-- This is webpage which lets anyone view the menu of food items. Only logged in customers can order food -->
<?php 
session_start();
include("config.php");
if(isset($_POST['submit']))
{
    if($_SESSION['user'] == 'cus')
    {
        if($_POST['quantity'] > 0)
        {
        $sql = "INSERT INTO cart VALUES ('', ".$_POST['id'].",".$_POST['quantity'].",".$_SESSION['id'].");";
        $conn->query($sql);
        echo '<script type="text/javascript">alert("Added to cart");</script>';
        }
        else echo '<script type="text/javascript">alert("Quantity should be greater than 0");</script>';
    }
    else if($_SESSION['user'] == 'res')
            echo '<script type="text/javascript">alert("Restaurents cannot order");</script>';
    else 
        {
            header("Location: login_usr.php?login=false");
            die(); 
        }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
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
<?php if(isset($_SESSION['user']) &&  $_SESSION['user']== 'cus')
        echo "<a style='font-size:20 px;', href='cus_home.php'><< Back</a>";
      else if(isset($_SESSION['user']) &&  $_SESSION['user']== 'res')
        echo "<a style='font-size:20px;', href='res_home.php'><< Back</a>";
      else
      echo "<a style='font-size:20px;', href='index.php'><< Back</a>";
        
?>
<div class="menu">
    <?php 
    include("config.php");
    if(isset($_SESSION['user']) &&  $_SESSION['user']== 'cus'){
        $pref = $conn->query("SELECT pref FROM customers WHERE id =".$_SESSION['id'])->fetch_assoc();
        $sql = "SELECT * FROM food ORDER BY pref=".$pref['pref']." DESC";}
    else
        $sql = "SELECT * FROM food";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) 
    {
        // output data of each row
        while($row = $result->fetch_assoc()) 
        { //Display all food items
            $res = $conn->query("SELECT * FROM restaurents WHERE id =".$row['res_id'])->fetch_assoc();
            $pref = $row['pref']?"Non-veg":"Veg";
            echo "<div class='food'>";
            echo "<img width = '250' height = '250' style='vertical-align:top;' src=".$row['image']."> 
                 <h2>Name: " . $row["name"]. "<h2><h2>Price: " . $row["price"]." rs</h2> <h2>Food type: ".$pref."<h2>".
                 "<h2>Restaurent: " . $res["name"]. "<h2><h2>Location: " . $res["location"]." ".
                 "<form action='menu.php' method='POST' >".
                 "<input type='number'  step = '1' id='price' name = 'quantity' placeholder='Enter quantity' >".
                 "<input type='hidden' name = 'id' value ='".$row['id']."' >".
                 "<button type='submit' id='button' name='submit'>Order</button></form>";
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
  
    