<table width="795" align="center" bgcolor="purple">
    <tr align="center">
        <td colspan="9"><h2>Buying Customers</h2></td>
    </tr>
    <tr align="center" bgcolor="pink">
        <th>Product ID</th>
        <th>Customer ID</th>
        <th>Customer Address</th>
        <th>Quantity</th>
        <th>Date Ordered</th>
    </tr>
    <?php
        include("../includes/db.php");
        include("../includes/product.php");
        include("../includes/customer.php");
        $p_id = $_GET['product_customers'];
        $pro_q = mysqli_query($con, "select * from orders where product_id='$p_id'");
        while($row_pro = mysqli_fetch_array($pro_q)){
            $product = new Product($row_pro['product_id']);
            $customer = new Customer((int)$row_pro['customer_id']);
            $quantity = $row_pro['product_quantity'];
            $date = $row_pro['date_added'];
            $country = $row_pro['custom_country'];
            $city = $row_pro['custom_city'];
            $street = $row_pro['custom_street'];
    ?>
        <tr align="center">
            <td><a href="index.php?edit_product=<?php echo $product->get_id()?>"><?php echo $product->get_id()?></a></td>
            <td><a href="index.php?edit_customer=<?php echo $customer->get_id()?>"><?php echo $customer->get_id()?></a></td>
            <td>
                <?php 
                    if(!empty($country)){
                        ?>
                            <?php echo "$country $city $street"?>
                        <?php
                    }
                    else{
                        ?>
                        <?php echo $customer->get_adddress()->get_country()." ";echo $customer->get_adddress()->get_city()." ";echo $customer->get_adddress()->get_street();?><?php
                    }
                ?>
            </td>
            <td><?php echo $quantity?></td>
            <td><?php echo $date?></td>
        </tr>
        <?php } ?>
</table>