<?php
ob_start();
session_start();
include('../plugins/config.php');
$connection= mysqli_connect(constant('HOST'),constant('USER'),constant('PASSWORD'),constant('DB'));
            if(isset($_POST['submit']))
			{
			    $un=$_POST['username'];
				$pass=$_POST['password'];
				$c=0;
				$q=mysqli_query($connection,"select * from customers where email='$un'");
			    while($row=mysqli_fetch_array($q))
				{
					$c++;
				    if ($pass==$row['password'])  
				    {   
                        $_SESSION['username']=$row['contact'];
                        $_SESSION['first_name']=$row['first_name'];
                        $_SESSION['customer_id']=$row['customer_id'];
                        $_SESSION['email']=$row['email'];

                        header('Location:home.php');	
				    }
			        else
				    {    
				        echo '<script>alert("Invalid Password '.$pass.'!")</script>';	
				    }
					
                }
                if($un=='admin' and $pass='123')
                {
                    header('Location:order_details.php');
                }
				else if($c==0)
				{
					echo '<script>alert("invalid email !")</script>';
				}
			}			
?>
<! Doctype HTML>
<html>
<title>Login And Sign Up page</title>
<head>
<link rel="stylesheet" type="text/css" href="../css/index.css">
<style>
body {
    background-image: url("../img/sky_clouds.jpg");
    background-color:rgba(0,0,0,1);
    background-position: center; 
    background-repeat: no-repeat; 
    background-size: cover
 
}

</style>
</head>
<body>
    <div class="box">
        <div class="border left_box">
            <h2 style="color:white">Please login</h2>
            <form action="" method="post">
                <input class="input align-value" type="text" name="username" placeholder="Email" required\><br><br><br>
                <input class="input align-value" type="password" name="password"  placeholder="Password" required\><br><br><br>
                <input class="submit" type="submit" name="submit" \><br><br><br>
                <a href="forget.php"><p>Forget password?</p></a>
            </form>

        </div>
        <div style="float:right;width:270px;color:white">
            <div class="right_box">
                <img src="../img/food_logo.png" id="food_logo">
                <div class="content-box"style="height:100px">
                <p style="font-size:14px"> Our core value make us who we are. As we change and grow, the beliefs that are most important to us stay the same.</p>
                
                </div>
                <a href="registration.php"><button class="button submit">Register</button></a>
            
            </div>
        </div>
    </div>
</body>
</html>


