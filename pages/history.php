<?php 
session_start();


include('../plugins/config.php');
$connection= mysqli_connect(constant('HOST'),constant('USER'),constant('PASSWORD'),constant('DB'));
date_default_timezone_set('Asia/Kolkata');
?>



<html>
 <head>
  <title>Order Details</title>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  <script src="jquery-3.3.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  color: lime;
}
  </style>
 </head>
 <body>
 <div class="topnav">
  <a class="active" href="Order_details.php">Orders</a>
  <a href="#history">history</a>
  <a href="chef.php">chef</a>
  <a href=employees.php>Employees</a>
</div>
  <div class="container box">
   <h1 align="center">Order Details</h1>
   <br />
   
    <?php
        $cntr=0;
        $q1=mysqli_query($connection,"select o.*, sc.status from orders o, shopping_cart sc where sc.cart_id=o.cart_id and  sc.status>1") or die (mysqli_error());
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
                        $q=mysqli_query($connection,"select distinct sc.*,ic.*,c.*, i.* from shopping_cart sc,customers c,items i, items_cart ic where ic.cart_id=$cart_id and sc.cart_id=$cart_id and i.item_id=ic.item_id and c.customer_id=sc.customer_id and sc.status>0") or die (mysqli_error());
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
</script>
 </body>
</html>
