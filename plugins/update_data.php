<?php
session_start();
if(isset($_SESSION['username'])){}
else{header('Location:../index.php');}
include('../plugins/config.php');
$connection= mysqli_connect(constant('HOST'),constant('USER'),constant('PASSWORD'),constant('DB'));

////////////////////////////////////////////////////////////////////////////////////////////////////


date_default_timezone_set('Asia/Kolkata');

function cartId($connection,$cust_id,$status)
{
	$q=mysqli_query($connection,"select * from shopping_cart where customer_id=$cust_id and status=0") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		return $cart_id=$row['cart_id'];
	}
}


if(isset($_REQUEST['shoppingCart']))
{
    $item_id=(int) $_REQUEST['item_id'];
	$cust_id=(int) $_REQUEST['cust_id'];
	$quantity=1;
	$cntr=0;
	$q=mysqli_query($connection,"select * from shopping_cart where customer_id=$cust_id and status=0") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr++;
		$cart_id=$row['cart_id'];
		mysqli_query($connection,"insert into items_cart values ($cart_id,$item_id,$quantity)") or die (mysqli_error());
	}
	if($cntr==0)
	{
		mysqli_query($connection,"insert into shopping_cart(customer_id,status) values ($cust_id,0)") or die (mysqli_error());
		$q=mysqli_query($connection,"select * from shopping_cart where customer_id=$cust_id and status=0") or die (mysqli_error());
		while($row=mysqli_fetch_array($q))
		{
			$cart_id=$row['cart_id'];
			mysqli_query($connection,"insert into items_cart values ($cart_id,$item_id,$quantity)") or die (mysqli_error());
		}
	}
}
if(isset($_REQUEST['placeOrder']))
{
    
	$cust_id=(int) $_REQUEST['cust_id'];
	$amount=(int) $_REQUEST['amount'];
	$date = date('Y-m-d');
	$time = date('H:i:s');
	$selectedTime =  substr($time,0,8);
	$delivery_time=date('h:i:s a',strtotime($selectedTime . ' +25 minutes'));
	$status=1;
	$cart_id=cartId($connection,$cust_id,$status);
	mysqli_query($connection,"insert into orders(cart_id,delivery_time,order_time,order_date) values ($cart_id,'$delivery_time','$time','$date')") or die (mysqli_error());
	mysqli_query($connection,"update shopping_cart set status=$status where cart_id=$cart_id") or die (mysqli_error());
	mysqli_query($connection,"insert into payment(cart_id,amount,time,date) values ($cart_id,$amount,'$time','$date')") or die (mysqli_error());
}
if(isset($_REQUEST['addressChange']))
{
	$cust_id=(int) $_REQUEST['cust_id'];
	$address= $_REQUEST['address'];
	$street=$_REQUEST['street'];
	$city=$_REQUEST['city'];
	$state=$_REQUEST['state'];
	$zip=(int) $_REQUEST['zip'];
	$cntr=0;
	$q=mysqli_query($connection,"select * from address where customer_id=$cust_id") or die (mysqli_error());
	while($row=mysqli_fetch_array($q))
	{
		$cntr++;
		mysqli_query($connection,"update address set address='$address', street='$street', state='$state', city='$city', zip=$zip where customer_id=$cust_id") or die (mysqli_error());
	}
	
	if($cntr==0)
		mysqli_query($connection,"insert into address values ($cust_id,'$address','$street','$city','$state',$zip)") or die (mysqli_error());
}
if(isset($_REQUEST['updateItemQuantity']))
{
	$cust_id=(int) $_REQUEST['cust_id'];
	$item_id=(int) $_REQUEST['item_id'];
	$quantity=(int) $_REQUEST['quantity'];
	$cart_id=cartId($connection,$cust_id,0);
	mysqli_query($connection,"update items_cart set quantity=$quantity where cart_id=$cart_id and item_id=$item_id") or die (mysqli_error());
}
if(isset($_REQUEST['delivered']))
{
	$cust_id=(int) $_REQUEST['cust_id'];
	$cart_id=(int) $_REQUEST['cart_id'];
	echo 'cart '.$cart_id." customer ".$cust_id;
	$status=2;
	mysqli_query($connection,"update shopping_cart set status=$status where cart_id=$cart_id and customer_id=$cust_id") or die (mysqli_error());
}
if(isset($_REQUEST['cancelOrder']))
{
	$cust_id=(int) $_REQUEST['cust_id'];
	$cart_id=(int) $_REQUEST['cart_id'];
	$status=3;
	mysqli_query($connection,"update shopping_cart set status=$status where cart_id=$cart_id and customer_id=$cust_id") or die (mysqli_error());
}










?>