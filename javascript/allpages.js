

// to update address of customers
$(document).on('click', '#addressChange', function(){
  
    var cust_id="<?php echo $_SESSION['customer_id']; ?>";
    var address =$('input[name=address]').val();
    var street =$('input[name=street]').val();
    var city =$('input[name=city]').val();
    var state =$('input[name=state]').val();
    var zip =$('input[name=zip]').val();
    var addressChange=true;
      $.ajax({
          url:"../plugins/update_data.php",
          method:"GET",
          data:{cust_id:cust_id,address:address,street:street,city:city,state:state,zip:zip,addressChange:addressChange},
          success:function(data){
            //$("input").load(location.href + " #addressBox>*", "");
              alert("Your address has been updated !");
          }
      });
    
   });