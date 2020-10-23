<?php
include('../plugins/config.php');
$connection= mysqli_connect($host,constant('USER'),constant('PASSWORD'),constant('DB'));
if(isset($_REQUEST['submit']))
{
    $fn=$_REQUEST['firstname'];
    $ln=$_REQUEST['lastname'];
    $contact=$_REQUEST['contact'];
    $email=$_REQUEST['email'];
    $pass=$_REQUEST['password'];
    
    mysqli_query($connection,"insert into customers (first_name,last_name,contact,email,password) values ('$fn','$ln',$contact,'$email','$pass')") or die (mysqli_error());
    echo '<script>alert("Registration successfull, now you can login '.$fn.' '.$ln.'!")</script>';
    header('Location:login.php');
}


?>
<! Doctype HTML>
<html>
<title>Login And Sign Up page</title>
<head>
<link rel="stylesheet" type="text/css" href="../css/registration.css">
<style>
body {
 background-image: url("../img/sky_clouds.jpg");
 background-color: ;
 background-position: center; 
background-repeat: no-repeat; 
background-size: cover
 
 
}


</style>
</head>
<body>
    <div class="box">
        <div class="registration-box">
            <h2 style="color:white;margin-top:15px">Register</h2>
            <form action="" method="GET">
                <input class="input" style="text-align:left" type="text" name="firstname" placeholder="First name" required \>
                <input class="input" type="text" name="lastname" placeholder="Last name" required \>
                <input class="input" type="text" name="contact" placeholder="Mobile no." required \>
                <input class="input" type="email" name="email" placeholder="Email" required \>
                <input class="input" type="password" name="password" placeholder="Password" required \>
                <input class="input" type="password" name="password2"  placeholder="Confirm password" required \>
                <input class="submit" type="submit" name="submit" value="Register" \>
            </form>
        </div>
    </div>
</body>
</html>


