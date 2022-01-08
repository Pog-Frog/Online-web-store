<form method="post" enctype="multipart/form-data">
    <table align="center" width="700" bgcolor="purple">
        <tr align="center">
            <th>Product</th>
            <th>Date Added(s)</th>
        </tr>
        <?php 
            global $con;
            $ip = getIp();
            $tmp = 0;
            $total = 0;
            $item_id = "select * from cart where ip_address='$ip'";
            $run_item = sqlsrv_query($con, $item_id);
            while($cart_product = sqlsrv_fetch_array($run_item)){
                $pro_id = $cart_product['product_id'];
                $tmp_pro = sqlsrv_query($con, "select * from products where product_id='$pro_id'");
                while($pro = sqlsrv_fetch_array($tmp_pro)){
                    $tmp = $tmp + $pro['product_price'];
                    $product_price = $pro['product_price'];
                    $product_title = $pro['product_title'];
                    $product_image = $pro['product_image'];
                    ?>
                    <tr align="center">
                        <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"/></td>
                        <td>
                            <?php echo $product_title?><br>
                            <img src="admin/product_images/<?php echo $product_image;?>" width="60" height="60"/>
                        </td>
                        <td>
                            <select name="qty[<?php echo $pro_id?>]">
                                <?php
                                    getQuantity($pro_id);
                                ?>
                            </select>
                        </td>
                        <td><?php echo $product_price?></td>
                    </tr>
                <?php }
            }
        ?>
        <tr align="right">
            <td colspan="4"><b>Sub Total</b></td>
            <td colspan="4"><?php total_price();?> LE
        </tr>
        <tr align="center">
            <td colspan="2"><input type="submit" name="update_cart" value="Update Cart"/></td>
            <td><input type="submit" name="continue" value="Continue shopping"/></td>
            <td><button><a href="checkout.php" style="text-decoration: none; color: black;">Proceed to Checkout</a></button></td>
        </tr>
    </table>
</form>