<form method="post" enctype="multipart/form-data">
    <table align="center" width="700" bgcolor="pink">
        <tr align="center">
            <th>Remove</th>
            <th>Product</th>
            <th>Porduct Price</th>
            <th>Date Added</th>
        </tr>
        <?php 
            $c = $_SESSION['customer_email'];
            $c_q = mysqli_query($con, "select * from customers where customer_email='$c'"); 
            $c_info = mysqli_fetch_array($c_q);
            $c_id = $c_info['customer_id'];
            $item_q = mysqli_query($con, "select * from favorites where customer_id='$c_id'");
            while($item = mysqli_fetch_array($item_q)){
                $item_id = $item['product_id'];
                $item_date = $item['date_added'];
                $pro_q = mysqli_query($con, "select * from products where product_id='$item_id'");
                $pro = mysqli_fetch_array($pro_q);
                $p_id = $pro['product_id'];
                $product_quantity = $pro['product_quantity'];
                $product_image = $pro['product_image'];
                $product_title = $pro['product_title'];
                $product_price = $pro['product_price'];
                if($product_quantity == 0 or mysqli_num_rows($pro_q) == 0){
                    continue;
                }
                else{
                    ?>
                    <tr align="center">
                        <td><input type="checkbox" name="remove[]" value="<?php echo $p_id;?>"/></td>
                        <td>
                            <?php echo $product_title;?><br>
                            <a href="../details.php?pro_id=<?php echo $p_id;?>">
                                <img src="../admin/product_images/<?php echo $product_image;?>" width="60" height="60"/>
                            </a>
                        </td>
                        <td><?php echo $product_price;?></td>
                        <td>
                            <?php echo $item_date ;?>
                        </td>
                    </tr>
                <?php
                }
            }
            ?>
            <tr align="center"><td colspan="6"><input type="submit" name="update_fav" value="Update"/></td></tr>
    </table>
</form>
<?php
    if(isset($_POST['update_fav'])){
        foreach($_POST['remove'] as $remove_id){
            $delete_product = "delete from favorites where product_id='$remove_id' AND customer_id='$c_id'";
            mysqli_query($con, $delete_product);
        }
        echo "<script>window.open('my_account.php?my_favorites','_self')</script>";
    }
?>