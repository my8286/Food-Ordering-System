<?php
session_start();
    if(isset($_SESSION['username'])){}
    else{header('Location:../index.php');}

    include('../plugins/config.php');
    $connection= mysqli_connect(constant('HOST'),constant('USER'),constant('PASSWORD'),constant('DB'));

    if(isset($_POST['submit']))
    {
        session_unset(); 
        session_destroy();
        header("Location:login.php");
    }


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
 section{
     background:rgba(0,0,0,0);
     overflow:auto;
     height:auto;
 }
 .cart-item {
    font-size:15px
 }




 .plus-minus-input {
    align-items: center;
         
}

.plus-minus-input .input-group-field, .input-group-button button {
  text-align: center;
  height:40px;
  border:none;
  box-shadow: 0px 0px 10px rgba(0,0,0, 0.5)
}
.input-group-field{
    height:20px;
    width:70px
}
.input-group-button-left  {
    border-radius: 0px 5px 5px 0px;
    width:50px;
}
.input-group-button-right  {
    border-radius: 5px 0px 0px 5px;
    width:50px;
}

.input-group-button button{
    background:lime
}
.address-box input[type=submit]{
    border-radius: 50px;
    background-color:rgba(0, 0, 0, 0.9);
    margin-left:16%;
    margin-top:5px;
    height:30px;
    width:150px;
    color:white;
}
.place-order{
    float:right;
    right:14px;
    width:25%;
    height:80%;
    margin-top:15px;
    background:rgba(0, 255, 0, 0.4);;
    box-shadow: -1px 2px 8px rgba(0, 0, 0, 0.4);
    position:fixed;
    border-radius:25px;
}
.place-order button{
    border-radius: 50px;
    background-color:rgba(255, 0, 0, 0.9);
    margin-top:5px;
    height:30px;
    width:150px;
    color:white;

}
.scrollbar{
    height:calc(100% - 30px);
    position: absolute;
    width: 100%;
    overflow-y: auto;
}
#footer{
    top:150px;
    position:relative
}
#placeOrder:hover{
    background:lime
}
</style>
</head>
<body>
<nav>
    <div style="float:left;margin:0">
        <img class="food-logo" src="../img/food_logo.png">
        <h1 class="title" >Food Junction</h1>
    </div>
    
    <div class="topnav" style="float:left;margin-left:340px">
        <a class="active" href="home.php">Home</a>
        
        <a href="#">Orders</a>
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
            <img src="../img/food_logo.png" alt="John" style="width:100%;height:200px;background:white;border-radius:50px 0px 0px 0px">
            <h1><?php echo ucfirst($_SESSION['first_name']); ?></h1>
            <p><?php echo '+91-'.ucfirst($_SESSION['username']); ?></p>
            <p><?php echo $_SESSION['email']; ?></p>
            <p>
                <form action="" method="post">
                    <input type="submit" value="Logout" name="submit">
                </form>
            </p>
        </div>
        <div class="address-box" align="center">
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
<section >

    <?php 
         $c=0;
         $customer_id=$_SESSION['customer_id'];
        $q=mysqli_query($connection,"select ic.*, sc.*,i.*  from items_cart ic,shopping_cart sc,items i where ic.cart_id=sc.cart_id and i.item_id=ic.item_id and sc.customer_id=$customer_id and sc.status>0 order by sc.status") or die (mysqli_error());
        while($row=mysqli_fetch_array($q))
        {
            $name=$row['name'];
            $c=1;
           
        ?>
                <div class="cart-item" style="overflow:auto;float:left;width:70%">
                    <div style="float:left;width:45%;margin-left:10%;margin-top:4%">
                         <img style="border-radius:100px" src="../img/<?php echo $row["item_id"]."_".$row['name']; ?>.jpg" height="200" width="200">
                        <!-- Change the `data-field` of buttons and `name` of input field's for multiple plus minus buttons-->
                        <?php 
                        if($row['status']==1)
                        {?>
                             <div class="input-group plus-minus-input" style="color:lime;width:200px;height:50px;background:;margin-left:-1%;margin-top:9%" align="center">
                            <h1>Ordered</h1>
                            </div>
                        <?php
                        }
                        else if($row['status']==2)
                        {?>
                            <div class="input-group plus-minus-input" style="color:lime;width:200px;height:50px;background:;margin-left:-1%;margin-top:9%" align="center">
                            <h1>Delivered</h1>
                            </div>
                        <?php 
                        }
                        else if($row['status']==3)
                        {?>
                            <div class="input-group plus-minus-input" style="color:red;width:200px;height:50px;background:;margin-left:-1%;margin-top:9%" align="center">
                            <h1>Cancelled</h1>
                            </div>
                        <?php }?>


                    </div>
                    <div style="float:left;color:black;margin-top:4%;width:40%;height:100px">
                        <h1 style="line-height:"><span style="font-size:25px"><?php echo ucfirst($name); ?></span>
                        <?php if($row['status']==2){?><span style="font-size:15px;color:lime">(Delivered) </span><?php }?>
                        <?php if($row['status']==3){?><span style="font-size:15px;color:red">(Cancelled) </span><?php }?>
                        
                        <br>( &#8377; <?php echo $row['price']; ?> )</h1>
                    
                    </div>
                    
                    
                </div>

    <?php
        }
        if($c==0)
        {
            ?> <div class="cart-item" style="float:left;width:70%;height:350px" align="center">
                <h1 align="center" style="font-size:50px">No selected item</h1>
                </div>
        <?php
        }
        ?>

        <div id="po" class="place-order"style="" align="center">
            <h3>Your Ordered items</h3>
            <div style="width:100%;height:40%;overflow-y:auto" align="center">
            <?php
                $sum=0;
                $status=0;
                $time="";
                 $q=mysqli_query($connection,"select ic.*, sc.status,i.*,o.*  from items_cart ic,shopping_cart sc,items i,orders o where ic.cart_id=o.cart_id and i.item_id=ic.item_id and ic.cart_id=sc.cart_id and sc.status=1  and sc.customer_id=$customer_id order by sc.status ") or die (mysqli_error());
                 while($row=mysqli_fetch_array($q))
                {
                    $name=$row['name'];
                    $sum= $sum + $row['price'];
                    $time=$row['delivery_time'];
                    $cart_id=$row['cart_id'];
                ?>
                    <p> <?php echo ucfirst($name); ?> &nbsp; &nbsp; &#10006;  &nbsp; &nbsp;<span id="<?php echo $name[0].''.$row["item_id"]; ?>"> <?php echo $row["quantity"]; ?> <span></p>
            <?php
                }?>
            
            </div>
            <h4> Invoice Id:FJ111X235 </h4>
            <h4> Expected Delivery Time:<?php echo  substr($time,0,8); ?> </h4>
            <h3>Total amount: <span id="total_price"> 
                <?php echo $sum; ?></span> &nbsp;  &#8377;</h3>
                <button id="cancelOrder" data-field="<?php echo $cart_id; ?>">cancel order</button>
        </div>
</section>

<!--- footer---->

<div id="footer"></div>
<script>
   $(function(){
        $('#footer').load('footer.php');

   });

    $(document).on('click', '.addToCart', function () {
        const num = parseInt($('#lblCartCount').text());
        var val = parseInt(num) + 1;
        $("#lblCartCount").text(val);
        var item_id=$(this).data("id");
        var cust_id="<?php echo $_SESSION['customer_id']; ?>";
       // alert("id="+cust_id);
        updateShoppingCart(item_id,cust_id);
    });
    function updateShoppingCart(item_id,cust_id)
    {
		var xhttp;
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				//alert(this.responseText);
				location.reload();
			}
		};
		xhttp.open("GET",  "../plugins/update_data.php?shoppingCart=1&&item_id="+item_id+"&&cust_id="+cust_id, true);
		xhttp.send(); 
	return false;
}



    jQuery(document).ready(function(){
    // This button will increment the value
    $('[data-quantity="plus"]').click(function(e){
    
        e.preventDefault();
        var fieldName = $(this).attr('data-field');
        var item_price = parseInt($(this).attr('data-id'));
        var total_price = parseInt($('#total_price').text());
        var item_id= fieldName.substring(1,99);
        var cust_id="<?php echo $_SESSION['customer_id']; ?>";
        
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        //alert(item_id);
        if (!isNaN(currentVal)) {
            $('input[name='+fieldName+']').val(currentVal + 1);
            var v=currentVal+1;
            $('#'+fieldName+'').text(''+v+'');
            var total = total_price + item_price;
            $('#total_price').text(''+total+'');
            updateItemQuantity(cust_id,item_id,v);
            //alert(item_id);
        } else {

            $('input[name='+fieldName+']').val(0);
            updateItemQuantity(cust_id,item_id,0);
        }
    });
    // This button will decrement the value till 0
    $('[data-quantity="minus"]').click(function(e) {
        e.preventDefault();
        var fieldName = $(this).attr('data-field');
        var item_price = parseInt($(this).attr('data-id'));
        var total_price = parseInt($('#total_price').text());
        var item_id= fieldName.substring(1,99);
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        var cust_id="<?php echo $_SESSION['customer_id']; ?>";
       
        if (!isNaN(currentVal) && currentVal > 0) {
        
            $('input[name='+fieldName+']').val(currentVal - 1);
            var v=currentVal - 1;
            $('#'+fieldName+'').text(''+v+'');
            total = total_price - item_price;
            $('#total_price').text(''+total+'');
            updateItemQuantity(cust_id,item_id,v);
        } else {
           
            $('input[name='+fieldName+']').val(0);
            updateItemQuantity(cust_id,item_id,0);
        }
    });
});
function updateItemQuantity(cust_id,item_id,quantity)
{
    //alert("update");
    var updateItemQuantity=true;
    $.ajax({
     url:"../plugins/update_data.php",
     method:"POST",
     data:{cust_id:cust_id,item_id:item_id,quantity:quantity,updateItemQuantity:updateItemQuantity},
     success:function(data){
      //alert(data);
     }
    });
}
// scoll down then place order box disappear when footer appear
$(window).scroll(() => { 
  // Distance from top of document to top of footer.
  topOfFooter = $('#footer').position().top;
  // Distance user has scrolled from top, adjusted to take in height of sidebar (570 pixels inc. padding).
  scrollDistanceFromTopOfDoc = $(document).scrollTop() + 450;
  // Difference between the two.
  scrollDistanceFromTopOfFooter = scrollDistanceFromTopOfDoc - topOfFooter;

  // If user has scrolled further than footer,
  // pull sidebar up using a negative margin.
  if (scrollDistanceFromTopOfDoc > topOfFooter) {
    $('#po').css('display',  'none');
  } else  {
    $('#po').css('display', 'block');
  }
});


$(document).on('click', '#cancelOrder', function(){
  
  var cust_id="<?php echo $_SESSION['customer_id']; ?>";
  var cart_id=$(this).attr('data-field');
  var cancelOrder=true;
  var total_price = parseInt($('#total_price').text());
  //alert(cust_id+"  cart "+cart_id);
  if(total_price > 0)
   {
   $.ajax({
    url:"../plugins/update_data.php",
    method:"POST",
    data:{cust_id:cust_id,cancelOrder:cancelOrder,cart_id:cart_id},
    success:function(data){
     location.reload();
     alert(data);
    
    }
   });
   }
 });

</script>
<script src="../javascript/collapsed_sidepanel.js" type="text/javascript"></script>
<script src="../javascript/allpages.js" type="text/javascript"></script>
</body>
</html>