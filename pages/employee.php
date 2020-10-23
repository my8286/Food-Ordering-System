<?php


    include('../plugins/config.php');
    $connection= mysqli_connect(constant('HOST'),constant('USER'),constant('PASSWORD'),constant('DB'));




?>
<! Doctype html>
<html>
<title>Home-Food Ordering System</title>
<link rel="icon" href="../img/food_logo.png" type="image/gif">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
<link rel="stylesheet" type="text/css" href="../css/home.css">
<link rel="stylesheet" type="text/css" href="../css/collapsed_sidepanel.css">
<script src="jquery-3.3.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
    body{
        background:rgba(0,0,0,0);
        color:white
    }
    .input{
    background-color:rgba(0, 0, 0, 0);
    color:white;
    border-top: none;  
    border-left: none; 
    border-right: none; 
    box-shadow: none;
    text-align: left; 
    height:20px;
    width:250px;
    margin-top:35px;
    margin-left:12px;
    align:right
    
}
input[type=submit]{
    background:lime;
    border:none;
    border-radius:50px;
    width:80px;
    height:30px;
    margin-top:20px;
  

}
div{
    background:rgba(0,0,0,1);
    height:80%;
    width:30%;
    margin-left:35%;
    margin-top:4%
}
</style>
</head>
<body>

<div align="center">

<form action="" method="post">
                    Name:<input class="input" style="text-align:left" type="text" name="name"  required \><br>
                    Contact:<input class="input" type="text" name="contact"  required \><br>
                    Email:<input class="input" type="text" name="email"required \><br>
                    Address:<input class="input" type="text" name="address"  required \><br>
                    City:<input class="input" type="text" name="city"  required \><br>
                    State:<input class="input" type="text" name="state"  required \><br>
                    Zip:<input class="input" type="text" name="zip"  required \><br>
                    <input class="submit" id="addChef" type="submit" name="addChef" value="submit" \>
                </form>
</div>

</body>
<html>