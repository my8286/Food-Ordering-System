<?php
session_start();
    if(isset($_SESSION['username'])){}
    else{header('Location:../index.php');}

    include('../plugins/config.php');
    $connection= mysqli_connect(constant('HOST'),constant('USER'),constant('PASSWORD'),constant('DB'));
?>
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
                    <img src="../img/<?php echo $row["item_id"]."_".$row['name']; ?>.jpg" alt="Cinque Terre" width="600" height="400">
                    </a>
                    <div class="desc"><?php echo ucwords($name);?><br>&#8377;<?php echo "".ucwords($row['price']);?><br>
                        <button class="addToCart" data-id="<?php echo $row['item_id']; ?>" data-id2="<?php echo ucwords($row['name']); ?>">ADD TO CART</button>
                    </div>
                </div>
            </div>
    <?php }?>

    <div class="clearfix"></div>


</article>