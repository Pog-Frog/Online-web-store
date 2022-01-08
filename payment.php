<?php 
    include("includes/product.php");
    $customer = new Customer($_SESSION['customer_email']);    
?>
<div>
    <h2>Products</h2>
    <form  method="post" enctype="multipart/form-data"">
        <table align="center" width="750" bgcolor="purple">
            <tr bgcolor="pink" align='center'>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            <tr>
                <?php 
                    $tmp_email = $customer->get_email();
                    $run_item = mysqli_query($con, "select * from cart where customer_email='$tmp_email'");
                    while($cart_product = mysqli_fetch_array($run_item)){
                        $quantity = $cart_product['quantity'];
                        $product = new Product($cart_product['product_id'])?>

                        <tr align="center">
                            <td>
                                <?php echo $product->get_title()?><br>
                                <img src="admin/product_images/<?php echo $product->get_image();?>" width="60" height="60"/>
                            </td>
                            <td>
                                <?php echo $product->get_describtion();?>
                            </td>
                            <td><?php echo $product->get_price();?></td>
                            <td><?php echo $quantity?></td>
                        </tr>
                    <?php }
                ?>
            </tr>
            <tr>
        </table>
        <p style="background-color:white; width: 750px;">Total: <?php if($customer->get_membership() == "Normal"){total_price();} elseif($customer->get_membership() == "Gold"){echo"Total - 10% = ";((double)total_price())-((double)total_price()*0.1);} else{echo "Total - 15% = ";echo ((double)total_price())-((double)total_price()*0.15);}?>L.E</p>
    </form>
    <br>
    <form  method="post" enctype="multipart/form-data"">
        <table align="center" width="750" bgcolor="purple" style="border-spacing: 8px;">
            <tr><td colspan="4" align="center"><b>Select Address<b></td></tr>
            <tr>
                <td align="center"><b>Customer Address: </b></td>
                <td><?php echo $customer->get_adddress()->get_country().", ";echo $customer->get_adddress()->get_city().", ";echo $customer->get_adddress()->get_street()?><input type="radio" name="address" value="0" required/></td>
            </tr>
            <tr>
                <td align="center"><b>Add Custom Address City</b><input type="radio" name="address" value="1" required/></td>
            </tr>
            <tr>
                <td align="right">Enter Country: </td>
                <td><input type="text" name="custom_country"/></td>
            </tr>
            <tr>
                <td align="right">Enter City: </td>
                <td><input type="text" name="custom_city"/></td>
            </tr>
            <tr style="padding-buttom: 10px;">
                <td align="right">Enter Street address: </td>
                <td><input type="text" name="custom_street" size="40"/></td>
            </tr>
            <tr>
                <td align="center"><b>Enter Credit Card number: </b></td>
                <td><input type="text" size="40" required/></td>
            </tr>
            <tr>
                <td align="center"><b>Enter ccv: </b></td>
                <td><input type="text" size="10" required/></td>
            </tr>
            <tr><td><td colspan="2"><p><img src="images/MasterCard_logo.png" width="200" height="100"/></p></td></td></tr>
            <tr><td><td colspan="2"><input type="submit" name="order" value="Confirm Order"/></td></td></tr>
        </table>
    </form>
    <?php
        if(isset($_POST['order'])){
            if(isset($_POST['address'])){
                $customer_id = $customer->get_id();
                $date_added = date("Y/m/d");
                $tmp_email = $customer->get_email();
                $run_item = mysqli_query($con, "select * from cart where customer_email='$tmp_email'");
                if($_POST['address'] == 1){
                    if(isset($_POST['custom_street']) && isset($_POST['custom_street']) && !empty($_POST['custom_street']) && !empty($_POST['custom_street'])){
                        $country = $_POST['custom_country'];
                        $city = $_POST['custom_city'];
                        $street = $_POST['custom_street'];
                        while($cart_product = mysqli_fetch_array($run_item)){
                            $quantity = $cart_product['quantity'];
                            $product = new Product($cart_product['product_id']);
                            $product_id = $product->get_id();
                            $insert = "insert into orders (customer_id,product_id,product_quantity,date_added,custom_country,custom_city,custom_street) values ('$customer_id','$product_id','$quantity','$date_added','$country','$city','$street')";
                            mysqli_query($con, $insert);
                            $product->set_quantity($product->get_quantity() - $quantity);
                            $product->update();
                            mysqli_query($con , "delete from cart where product_id='$product_id' AND customer_email='$tmp_email'");
                        }
                    }
                    else{
                        echo"<script>alert('Error Please enter a Valid Address')</script>";
                        exit();
                    }
                }
                else{
                    while($cart_product = mysqli_fetch_array($run_item)){
                        $quantity = $cart_product['quantity'];
                        $product = new Product($cart_product['product_id']);
                        $product_id = $product->get_id();
                        $insert = "insert into orders (customer_id,product_id,product_quantity,date_added) values ('$customer_id','$product_id','$quantity','$date_added')";
                        mysqli_query($con, $insert);
                        $product->set_quantity($product->get_quantity() - $quantity);
                        $product->update();
                        mysqli_query($con , "delete from cart where product_id='$product_id' AND customer_email='$tmp_email'");
                    }
                }
                echo "<script>alert('Thank you for purchasing our products')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }
        }
    ?>
</div>