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
  <a class="active" href="#Orders">Orders</a>
  <a href="history.php">history</a>
  <a href="chef.php">chef</a>
  <a href="employee.php">Employees</a>
</div>
  <div class="container box">
   <h1 align="center">Customers</h1>
   <br />
            <div class="container">
                <table id="order-dtails" class="table table-bordered table-striped table-hover ">
                <       
                    <tbody>
                    $q1=mysqli_query($connection,"select o.*, sc.status from orders o, shopping_cart sc where sc.cart_id=o.cart_id and sc.status=1") or die (mysqli_error());
        while($row1=mysqli_fetch_array($q1))
        { 
                       
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo ucfirst($row['first_name']);?></td>
                                <td><?php echo ucfirst($row['last_name']);?></td>
                                <td><?php echo ucfirst($row['email'] );?></td>
                                <td><?php echo ucfirst($row['contact_no'] );?></td>
                                <td><?php ?></td>
                                <th><?php ?></th>
                                <td><?php ?></td>
                            </tr>
                    </tbody>
                </table>
            </div>
       
       

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
