<table width="795" align="center" bgcolor="purple">
    <tr align="center">
        <td colspan="9"><h2>View All Supplier Orders</h2></td>
    </tr>
    <tr align="center" bgcolor="pink">
        <th>S.N</th>
        <th>Supplier_id</th>
        <th>Admin_id</th>
        <th>Date Made</th>
        <th>Order Status</th>
        <th>Product_id</th>
        <th>Quantity</th>
        <th>Edit</th>
    </tr>
    <?php
        include("includes/db.php");
        $sub_q = sqlsrv_query($con, "select * from supplier_orders");
        while($row_sub = sqlsrv_fetch_array($sub_q)){
            $ord_id = $row_sub['order_id'];
            $sup_id = $row_sub['supplier_id'];
            $admin_id = $row_sub['admin_id'];
            $ord_date = $row_sub['date_made'];
            $ord_status = $row_sub['order_status'];
            $pro_id = $row_sub['product_id'];
            $quantity = $row_sub['quantity'];
    ?>
        <tr align="center">
            <td><?php echo $ord_id?></td>
            <td><a href="index.php?edit_supplier=<?php echo $sup_id?>"><?php echo $pro_id?></a></td>
            <td><?php echo $admin_id?></td>
            <td><?php echo date_format($ord_date, 'n/d/y')?></td>
            <td><?php echo $ord_status?></td>
            <td><a href="index.php?edit_product=<?php echo $pro_id?>"><?php echo $pro_id?></a></td>
            <td><?php echo $quantity ?></td>
            <td><a href="index.php?edit_supplier_orders=<?php echo $ord_id?>">Edit</a></td>
        </tr>
        <?php } ?>
</table>