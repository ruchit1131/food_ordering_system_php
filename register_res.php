<!-- Registration page for Restaurents-->
<?php 
session_start();
include("redirect_to_home.php");
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
    <title>Restaurent Registration</title>
</head>
<body>
    <a  href="index.php"><h3 style = "margin-left: 10px;"><< Back</h3></a>
    <?php
    include("config.php");
    if(isset($_POST['submit']))
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $location = $_POST['location'];
        $sql_check = "SELECT * FROM restaurents WHERE email LIKE '$email' ";
        $result_chk = $conn->query($sql_check);
        if(mysqli_num_rows($result_chk) > 0)
        {
            echo '<script type="text/javascript">alert("Restaurent account with that email already exists!");</script>';
        }else{
        $hashedpass = hash('sha256',$password.$email );//hashing the password
        $sql = "INSERT INTO restaurents VALUES ('', '$name', '$email', '$hashedpass', '$location');";
        $conn->query($sql);
        header("Location: index.php?reg_success=yes");
        die();
    }

    }
    $conn->close();
    ?>
  <div>
    <h2 style="text-decoration: underline; color : darkslategray; margin-left: 5px;">Register Restaurent</h2>
    <br>
    <form action="register_res.php" method="POST">
        <label for="name">Name</label>
        <input type="text" id="name" name = "name" placeholder="Enter restaurent Name" required>
        <label for="InputEmail">Email address</label>
        <input type="email" id="InputEmail" name = "email" placeholder="Enter your Email" required>
        <label for="InputPassword">Password</label>
        <input type="password" id="InputPassword" name = "password"placeholder="Enter password" required>
        <label for="location">Location</label>
        <input type="text" id="location" name = "location" placeholder="Enter location" required>
        <button type="submit" id="button" name = "submit">Register</button>
    </form>
  </div>
</body>
</html>
