<!DOCTYPE>
<?php 
    include("includes/db.php");
?>
<html>
    <head>
        <title>Inserting Product</title>
    </head>
<body bgcolor="pink"> 
    <form action="make_supplier_orders.php" method="post" enctype="multipart/form-data">
        <table align="center" width="795" border="2" bgcolor="purple">
            <tr align="center">
                <td colorspan="8"><h2>Insert new Post here</h2></td>
            </tr>
            <tr>
                <td align="right"><b>Product Supplier:</b></td>
                <td>
                    <select name="supplier_id" required>
                        <option>Select a supplier</option>
                        <?php
                            $get_sups = "select * from suppliers";
                            $run_sups = sqlsrv_query($con, $get_sups);
                            while($row_sups = sqlsrv_fetch_array($run_sups)){
                                $sup_id = $row_sups['supplier_id'];
                                $supplier_name = $row_sups['supplier_name'];
                                echo "<option value='$sup_id'>$supplier_name</option>";
                            }
                        ?>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Product ID:</b></td>
                <td><input type="text" name="product_id" size="30" required/></td>
            </tr>
            <tr>
                <td align="right"><b>Product Qunatity:</b></td>
                <td><input type="text" name="quantity" size="20" required/></td>
            </tr>
            <tr align="center">
                <td colspan="8"><input type="submit" name="insert_post" value="Confirm"/></td>
            </tr>
            </table>
    </form>

</body>
</html>

<?php
    if(isset($_POST['insert_post'])){
        session_start();
        $sup_id = $_POST['supplier_id'];
        $admin_email = $_SESSION['admin_email'];
        $q = "select * from admins where admin_email='$admin_email'";
        $run_q = sqlsrv_query($con , $q);
        $row_q = sqlsrv_fetch_array($run_q);
        $admin_id = $row_q['admin_id'];
        $quantity = $_POST['quantity'];
        $pro_id = $_POST['product_id'];
        $q = "insert into supplier_orders (supplier_id , admin_id , order_status , product_id , quantity) values ('$sup_id' , '$admin_id' , 'in progress' , '$pro_id' , '$quantity')";
        $run_q = sqlsrv_query($con , $q);
        if($run_q){
            echo "<script>alert('Order has been made !')</script>";
            echo "<script>window.open('index.php?make_supplier_orders','_self')</script>";
        }
    }
?>