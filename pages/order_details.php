<?php 
session_start();


include('../plugins/config.php');
$connection= mysqli_connect(constant('HOST'),constant('USER'),constant('PASSWORD'),constant('DB'));
date_default_timezone_set('Asia/Kolkata');
?>



<html>
 <head>
  <title>Order Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
  body{
      background:rgba(0, 0, 0, 0)
  }
    tbody{
        padding:10px;
        margin:10px;
    }
    table button{
        background:lime;
        border-radius:10px
    }
    table{
        box-shadow: 0px 0px 20px rgba( 0, 0, 0, 0.9);
        
    }
    .container{
        border-radius:50px;
        position:static;
    }
.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  /*background-color: #ddd; */
  color: yellow;
}

.topnav a.active {
  color: lime;
}
  </style>
 </head>
 <body>
 <div class="topnav">
    <img src="../img/food_logo.png" height="40" width="70" style="float:left;margin-left:3%">
  <a class="active" href="#Orders">Orders</a>
  <a href="history.php">History</a>
  <a href="chef.php">Chef</a>
  <a href="employee.php">Employee</a>
  <a href="customers.php">Customer</a>
  <a href="food_items.php">Menu</a>
</div>
  <div class="container box">
   <h1 align="center">Order Details</h1>
   <br />
   
    <?php
        $cntr=0;
        $q1=mysqli_query($connection,"select o.*, sc.status from orders o, shopping_cart sc where sc.cart_id=o.cart_id and sc.status=1") or die (mysqli_error());
        while($row1=mysqli_fetch_array($q1))
        { 
            $cart_id=$row1['cart_id'];
            $cntr++;
        ?>
            <div class="container">
                <table id="order-dtails" class="table table-bordered table-striped table-hover ">
                <?php
                if($cntr==1)
                {?>
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Order Time</th>
                            <th>Delivery Time</th>
                            <th>Order Date</th>
                        </tr>
                    </thead>
                <?php 
                } ?>
                                
                            
                    <tbody>
                        <?php 
                        $i=0;
                        $q=mysqli_query($connection,"select distinct sc.*,ic.*,c.*, i.* from shopping_cart sc,customers c,items i, items_cart ic where ic.cart_id=$cart_id and sc.cart_id=$cart_id and i.item_id=ic.item_id and c.customer_id=sc.customer_id and sc.status=1") or die (mysqli_error());
                        while($row=mysqli_fetch_array($q))
                        { 
                            $customer_id=$row['customer_id'];
                            if(++$i==1)
                            {?>
                                <tr>
                                    <th colspan=7><?php echo ucfirst($row['first_name']." ".$row['last_name']);?></th>
                                </tr>
                            <?php
                             }?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo ucfirst($row['name']);?></td>
                                <td><?php echo ucfirst($row['quantity']);?></td>
                                <td><?php echo ucfirst($row['price'] * $row['quantity'] );?></td>
                                <td><?php  $date = substr($row1['order_time'],0,8); 
                                            echo date('h:i:s a', strtotime($date));
                                        ?></td>
                                <th><?php $selectedTime =  substr($row1['order_time'],0,8);
                                        echo date('h:i:s a',strtotime($selectedTime . ' +25 minutes'));?></th>
                                <td><?php echo ucfirst($row1['order_date']);?></td>
                            </tr>
                                
                        <?php
                        }?>	
                            <tr>
                                <th colspan=7><div align="right"><button id="delivered" data-id="<?php echo $customer_id; ?>" data-field="<?php echo $cart_id; ?>">Delivered</button></th>
                            </tr>			

                    </tbody>
                </table>
            </div>
        <?php
        }
        if($cntr==0)
        {?>
            <div align="center">
                <h1>No order placed</h1>
            </div>
        <?php } ?>	

<script>
setTimeout(location.reload.bind(location), 60000);

$(document).on('click', '#delivered', function(){
  
  var cust_id=$(this).attr('data-id');
  var cart_id=$(this).attr('data-field');
  var delivered=true;
  alert(cust_id+"  cart "+cart_id)
   $.ajax({
    url:"../plugins/update_data.php",
    method:"POST",
    data:{cust_id:cust_id,delivered:delivered,cart_id:cart_id},
    success:function(data){
     location.reload();
     alert(data);
    
    }
   });
 });
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</script>
 </body>
</html>
