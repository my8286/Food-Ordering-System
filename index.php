<?php

    include('plugins/config.php');
    $connection= mysqli_connect(constant('HOST'),constant('USER'),constant('PASSWORD'),constant('DB'));
        
    if(isset($_POST['submit']))
    {
        session_unset(); 
        session_destroy();
        header("Location:../index.php");
    }


?>
<! Doctype html>
<html>
<title>Home-Food Ordering System</title>
<link rel="icon" href="img/food_logo.png" type="image/gif">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
<link rel="stylesheet" type="text/css" href="css/home.css">
<script src="jquery-3.3.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>

.topnav button{
    background:rgb(0,255,0,0.8);
    border:1px solid white;
    color:white;
    height:26px;
    width:70px;
    border-radius:10px;
    font-size:15px
}
</style>
</head>
<body>
<nav>
    <div style="float:left;margin:0">
        <img class="food-logo"src="img/food_logo.png">
        <h1 class="title" >Food Junction</h1>
    </div>
    <div class="topnav" style="float:right">
        <a class="active" href="#home">Home</a>
        <a href="#food">Food</a>
        <a href="#footer">Contact</a>
        <a href="#footer">About</a>
        <a id="cart" href="#cart">
            <i class="fa" style="font-size:28px;color:lime">&#xf07a;</i>
            <span class='badge badge-warning' id='lblCartCount'> 0 </span>
        </a>
        <a href="pages/login.php"><button>Login</button></a>
    </div>
</nav>
<section >
    <div class="content-div">
        <div id="info">
            <h1 style="font-size:75px">Are you hungry?</h1>
            <h2 style="font-size:25px;margin-top:-60px">Don't wait !!!</h2>
            <h2 style="font-size:25px">Let's start to order food now</h2>
            <a href="#food"><button>CHECKOUT MENU</button></a>
        </div>
        <div id="info2">
        <div class="ribbon ribbon-top-left" ><span >&nbsp; 	&nbsp;	&nbsp;	&nbsp;	&nbsp;offer</span></div>
            <h1>Free Delivery on orders above ₹49</h1>
        </div>
        </div>
    </div>
</section>
<!------------ favorite food section------------>
<article id="food">
    <h1 class="favourite-title">Favourite Foods</h1>
    <?php
        $val=100;
        $q=mysqli_query($connection,"select * from items") or die (mysqli_error());
        while($row=mysqli_fetch_array($q))
        {
            $name=$row['name'];
            ?>
            <div class="responsive">
                <div class="gallery">
                    <a target="_blank" href="img/burger-cheese.jpg">
                    <img src="img/<?php echo $row["item_id"]."_".$row['name']; ?>.jpg" alt="Cinque Terre" width="600" height="400">
                    </a>
                    <div class="desc"><?php echo ucwords($name);?><br> &#8377;<?php echo ' '.ucwords($row['price']);?><br>
                        <button class="addToCart" data-id="<?php echo $row['item_id']; ?>">ADD TO CART</button>
                    </div>
                </div>
            </div>
    <?php }?>

    <div class="clearfix"></div>


</article>
<footer id="footer">
    <div class="container">
        <div class="about ">
            <h1> About us</h1>
            <p>Our core value make us who we are. As we change and grow, the beliefs that are most important to us stay the same.</p>
        </div>
        <div class="contact ">
            <h1>Contact</h1>
            <p> <b> Add: </b>123, Plaza Dadar, CityMax mall, Mumbai 400019</p>
            <p style="line-height: 0;margin-top:-10px"><b>Con: </b> +91-2124156789</p>
            <p style="line-height: 0;margin-top:-1px"><b>Email: </b> abc@gmail.com</p>
        </div>

    </div>
    <div class="container2">
        <div class="policy">
            <h1>Policy</h1><br>
            <a href=""><p>Term & Conditions</p></a>
            <a href=""><p>Refund & Cancellation</p></a>
            <a href=""><p>Privacy Policy</p></a>
            <a href=""><p>Offer Term</p></a>
        </div>
        <div class="store-img-div">
            <a href=""><img src="img/google_play.png" height="100px" width="300px"></a><br>
            <a href=""><img src="img/ios_store.png" style="margin-left:22px" height="76px" width="260px"></a>

        </div>

    </div>

</footer>
<script>
    
    $(document).on('click', '.addToCart', function () {

    alert("You have to login first !");
    });
    /*function run()
    {
        alert("");
    }*/
</script>
</body>
</html>