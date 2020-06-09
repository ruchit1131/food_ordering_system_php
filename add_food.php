<!-- This is webpage which lets the restaurent add food items into the menu.
 The food Name, Price, preference(veg/non-veg) and an uploaded image is 
 stored in the 'food' table along with the restaurent id which tells which 
 food item beongs to which restaurent. -->

<?php 
session_start();
// If a restaurent is using the session, then only allow access to this page
// else redirect to the index.php page.
if($_SESSION['user'] != 'res') 
{
    header("Location: index.php?accessdenied=true");
    die();
} 

include("config.php"); // Setting up connection to MySQL Database.

if(isset($_POST['submit'])) // If the Add Food(submit) button is clicked.
{
    if($_POST['price'] > 0)
    {
    // Uploading the file to the location 'images/' and storing the path of the image in Database.
    $ImageName = $_FILES['image']['name'];
    $fileElementName = 'image';
    $path = 'images/'; 
    $location = $path . $_FILES['image']['name']; 
    move_uploaded_file($_FILES['image']['tmp_name'], $location);
    
    $foodname=$_POST['foodname'];
    $price=$_POST['price'];
    $pref = NULL;
    if($_POST['pref'] == "veg")
        $pref = 0;
    else
        $pref = 1;

    $sql = "INSERT INTO food VALUES ('', '$foodname', ".$price.", ".$_SESSION['id'].", ".$pref.", '$location');";
    $conn->query($sql);
    echo '<script type="text/javascript">alert("Food Added");</script>';
    }
    else echo '<script type="text/javascript">alert("Enter valid price amount");</script>'; // If price of the food is not a Natural Number.

    $conn->close();

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
            display: list-item;
            list-style: none;
            background-image: url('images/background.jpg');
            background-size: cover;
            
      }
        form {
            width: fit-content;
            height: fit-content;
            border: solid gray 2px;
            margin-left: 10px;
        }
        form > *{
            
            display: list-item;
            list-style: none;
            padding: 5px ;
            margin: 8px;

        }
    </style>
    <title>Add Menu item</title>
</head>
<body>
    <a  href="res_home.php"><h3 style = "margin-left: 10px;"><< Back</h3></a>
    <h2 style="text-decoration: underline; color : darkslategray; margin-left: 5px;">Add Food</h2>
    <br>

    <form action="add_food.php" method="POST" enctype="multipart/form-data">
        <label for="foodname">Food Name</label>
        <input type="text" id="foodname" name = "foodname" placeholder="Food Name" required>
        <label for="price">Price</label>
        <input type="number"  step = "1" id="price" name = "price" placeholder="Enter price" required>
        <fieldset>
            <input type="radio" id="veg" name="pref" value="veg" checked>
            <label for="veg">Veg</label>
            <input type="radio" id="non_veg" name="pref" value="non_veg">
            <label for="non_veg">Non-veg</label>
        </fieldset>
        <label for="image">Image:</label>
        <input type="file" id = "image" name="image">
        <button type="submit" id="button" name="submit">Add Food</button>
    </form>

</body>
</html>
