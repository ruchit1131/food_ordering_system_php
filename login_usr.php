<!--Customer Login Page-->
<?php 
session_start();
if(isset($_GET['login']))
    echo '<script type="text/javascript">alert("You need to login first");</script>';

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
    <title>Customer Login</title>
</head>
<body>
    <a  href="index.php"><h3 style = "margin-left: 10px;"><< Back</h3></a>
    <h2 style="text-decoration: underline; color : darkslategray; margin-left: 5px;">Customer Login</h2>
    <br>
    <?php
    include("config.php");
    if(isset($_POST['submit']))
    {
        $email=$_POST['email'];
        $pass=$_POST['password'];
        $password = hash('sha256',$pass.$email );
        $email_chk = "SELECT * FROM customers WHERE email LIKE '$email' ";
        $result_email_chk = $conn->query($email_chk);
        $pass_chk = "SELECT * FROM `customers` WHERE `email` LIKE '$email' AND `password` LIKE '$password'";
        $result_pass_chk = $conn->query($pass_chk);
        if(mysqli_num_rows($result_email_chk) > 0)
        {
            if(mysqli_num_rows($result_pass_chk) > 0)
            {
                #echo '<script type="text/javascript">alert("WELCOME");</script>';
                    if(isset($_SESSION['id'])) {
                    header("Location: index.php?loggedin=true");
                    die();
                }
                    else
                    {
                        if(isset($_POST['rememberme']))
                        {
                            setcookie ("email", $email, time()+ 3600);//1 hr
	                        setcookie ("password", $pass, time()+ 3600);//1 hr
                        }
                        $get_id = "SELECT id FROM `customers` WHERE `email` LIKE '$email' AND `password` LIKE '$password'";
                        $id_ = $conn->query($get_id);
                        $id =  $id_->fetch_assoc();
                        $_SESSION['id'] = $id["id"];
                        $_SESSION['user'] = 'cus';
                        header('Location: cus_home.php'); 
                        die(); 
                    }
                
            }
            else echo '<script type="text/javascript">alert("Password Incorrect");</script>';
        }
        else echo '<script type="text/javascript">alert("Email not Found");</script>';
        
        
    
        $conn->close();
    }
    
    ?>
    <form action="login_usr.php" method="POST">
        <label for="InputEmail">Email address</label>
        <input type="email" id="InputEmail" name = "email" placeholder="Enter your Email" value="<?php $strEmail=isset($_COOKIE['email']) ? $_COOKIE['email'] : ""; echo $strEmail; ?>" required>
        <label for="InputPassword">Password</label>
        <input type="password" id="InputPassword" name = "password" placeholder="Enter password" value="<?php $strEmail=isset($_COOKIE['password']) ? $_COOKIE['password'] : ""; echo $strEmail; ?>" required>
        <fieldset>
        <label for="rememberme">Remember me?  </label>
        <input type="checkbox" id="rememberme" name = "rememberme" >
        </fieldset>
        <button type="submit" id="button" name="submit">Login</button>
    </form>
</body>
</html>
