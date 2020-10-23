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

</style>
</head>
<body>
<div id="header"></div>

<div id="section"></div>

<div id="article"></div>

<div id="footer"></div>

<script>
     $(function(){
        $("#header").load("header.php"); 
        $("#section").load("section.php"); 
        $("#article").load("article.php"); 
        $("#footer").load("footer.php"); 
    });
    $(document).on('click', '.addToCart', function () {
        const num = parseInt($('#lblCartCount').text());
        var val = parseInt(num) + 1;
        $("#lblCartCount").text(val);
        var item_id=$(this).data("id");
        var cust_id="<?php echo $_SESSION['customer_id']; ?>";
        var item_name=$(this).data("id2");
       //alert(item_name+" added in cart !");
       $(this).prop('disabled', true);
       $(this).css('background-color', 'lime');
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
				alert(item_name+" added in cart !");
                //location.reload();
                //gototab();
			}
		};
		xhttp.open("GET",  "../plugins/update_data.php?shoppingCart=1&&item_id="+item_id+"&&cust_id="+cust_id, true);
		xhttp.send(); 
	return false;
}

</script>
<script src="../javascript/collapsed_sidepanel.js" type="text/javascript"></script>
<script src="../javascript/allpages.js" type="text/javascript"></script>
</body>
</html>