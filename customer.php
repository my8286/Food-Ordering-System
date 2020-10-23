<?php
include('../plugins/config.php');
$connection= mysqli_connect($host,constant('USER'),constant('PASSWORD'),constant('DB'));

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
            <h2 style="color:white;margin-top:15px">Customer</h2>
            <table>
             <tr>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Email</td>
                <td>Contact</td>
            </tr>
            <?php
                
                    $q=mysqli_query($connection,"select * from customers") or die (mysqli_error());
                    while($row=mysqli_fetch_array($q))
                    { ?>
                    <tr>
                        <td><?php echo $row['first_name']?><td>
                        <td><?php echo $row['last_name']?><td>
                        <td><?php echo $row['email']?><td>
                        <td><?php echo $row['contact']?><td>

                    </td>
                    <?php}
                ?>    

            </table>
            
        </div>
    </div>
</body>
</html>


