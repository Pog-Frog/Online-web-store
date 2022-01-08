<!DOCTYPE>
<?php 
    include("includes/db.php");
    $ord_id = $_GET['edit_supplier_orders'];
    $q = sqlsrv_query($con, "select * from supplier_orders where order_id='$ord_id'");
    $sub_q = sqlsrv_fetch_array($q);
    $sup_id = $sub_q['supplier_id'];
    $admin_id = $sub_q['admin_id'];
    $ord_date = $sub_q['date_made'];
    $ord_status = $sub_q['order_status'];
    $pro_id = $sub_q['product_id'];
    $quantity = $sub_q['quantity'];
?>
<html>
    <head>
        <title>View/Edit Supplier Orders</title>
    </head>
<body bgcolor="pink"> 
    <form method="post" enctype="multipart/form-data">
        <table align="center" width="795" border="2" bgcolor="purple">
            <tr align="center">
                <td colspan=10><h2>View/Edit Supplier Orders</h2></td>
            </tr>
            <tr>
                <td align="center"><b>Order ID:</b></td>
                <td align="left"><?php echo $ord_id?></td>
            </tr>
            <tr>
                <td align="center"><b>Supplier ID:</b></td>
                <td><?php echo $sup_id?></td>
            </tr>
            <tr>
                <td align="center"><b>Admin ID:</b></td>
                <td><?php echo $admin_id?></td>
            </tr>
            <tr>
                <td align="center"><b>Date Ordered:</b></td>
                <td><?php echo date_format($ord_date, 'n/d/y')?></td>
            </tr>
            <tr>
                <td align="center"><b>Order Status:</b>
                    <select name="order_status">
                        <option <?php if("in progress" == $ord_status){echo "selected";}?>>In progress</option>
                        <option <?php if("delivered" == $ord_status){echo "selected";}?>>Delivered</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="center"><b>Product ID:</b></td>
                <td><?php echo $pro_id?></td>
            </tr>
            <tr>
                <td align="center"><b>Quantity:</b></td>
                <td><?php echo $quantity?></td>
            </tr>
            <tr align="center">
                <td colspan="8"><input type="submit" name="update_post" value="Update Order"/></td>
            </tr>
    </form>

</body>
</html>

<?php
    if(isset($_POST['update_post'])){
        $tmp = $_POST['order_status'];
        $q = sqlsrv_query($con, "update supplier_orders set order_status='$tmp' where order_id='$ord_id'");
        if($q){
            echo "<script>alert('Done!')</script>";
            echo "<script>window.open('index.php?view_supplier_orders','_self')</script>";
        }
    }
?>