<?php
session_start();
    if(isset($_SESSION['username'])){}
    else{header('Location:../index.php');}

    include('../plugins/config.php');
    $connection= mysqli_connect(constant('HOST'),constant('USER'),constant('PASSWORD'),constant('DB'));
?>
<nav>
    <div style="float:left;margin:0">
        <img class="food-logo" src="../img/food_logo.png">
        <h1 class="title" >Food Junction</h1>
    </div>
    
    <div class="topnav" style="float:left;margin-left:340px">
        <a class="active" href="#home">Home</a>
        <a href="orders.php">Orders</a>
        <a href="#footer">Contact</a>
        <a href="#footer">About</a>
        <a id="cart" href="shopping_cart.php">
            <i class="fa" style="font-size:28px;color:lime">&#xf07a;</i>
            <span class='badge badge-warning' id='lblCartCount' value=0> 
                <?php
                    $cntr=0;
                    $id=$_SESSION['customer_id'];
                    $q=mysqli_query($connection,"select sc.*, ic.* from shopping_cart sc, items_cart ic where sc.customer_id=$id and sc.status=0 and ic.cart_id=sc.cart_id") or die (mysqli_error());
                    while($row=mysqli_fetch_array($q))
                    {
                        $cntr++;
                    }
                    echo $cntr;
                ?>      
            </span>
        </a>
       
    </div> 
    <div id="main">
                <button class="openbtn" onclick="openNav()">☰</button>  
    </div>

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>

        <div class="card">
            <img src="../img/food_logo.png" alt="John" style="width:100%;height:200px;background:white;border-radius: 50px 0px 0px 0px">
            <h1><?php echo ucfirst($_SESSION['first_name']); ?></h1>
            <p><?php echo '+91-'.ucfirst($_SESSION['username']); ?></p>
            <p><?php echo $_SESSION['email']; ?></p>
            <p>
                <form action="" method="post">
                    <input type="submit" value="Logout" name="submit">
                </form>
            </p>
        </div>
        <div id="addressBox" class="address-box" align="center">
                <?php 
                $id=$_SESSION['customer_id'];
                $address=null;
                $street=null;
                $city=null;
                $state=null;
                $zip=null;
                $q=mysqli_query($connection,"select * from address where customer_id=$id") or die (mysqli_error());
                while($row=mysqli_fetch_array($q))
                {
                    $address=$row['address'];
                    $street=$row['street'];
                    $city=$row['city'];
                    $state=$row['state'];
                    $zip=$row['zip'];
                    
                }
                ?>
                <form action="" method="post">
                    Address:<input class="input" style="text-align:left" type="text" name="address" value="<?php echo ucfirst($address);?>" required \><br>
                    Street:<input class="input" type="text" name="street"value="<?php echo ucfirst($street);?>" required \><br>
                    City:<input class="input" type="text" name="city" value="<?php echo ucfirst($city);?>" required \><br>
                    State:<input class="input" type="text" name="state" value="<?php echo ucfirst($state);?>" required \><br>
                    Zip:<input class="input" type="text" name="zip" value="<?php echo ucfirst($zip);?>" required \><br><br><br>
                    <input class="submit" id="addressChange" type="submit" name="addressChange" value="update" \>
                </form>
        </div>
        
        
    </div>
        
    
</nav>