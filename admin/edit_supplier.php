<?php 
    include("includes/db.php");
    include("../includes/supplier.php");
    if(isset($_GET['edit_supplier'])){
        $supplier = new Supplier($_GET['edit_supplier']);
    }
?>
<html>
    <head>
        <title>Edit Supplier</title>
    </head>
<body bgcolor="pink"> 
    <form action="" method="post" enctype="multipart/form-data">
        <table align="center" width="795" border="2" bgcolor="purple">
            <tr align="center">
                <td colorspan="8"><h2>Edit Supplier here</h2></td>
            </tr>
            <tr>
                <td align="right"><b>Supplier Name:</b></td>
                <td><input type="text" name="supplier_name" size="35" value="<?php echo $supplier->get_name()?>"/></td>
            </tr>
            <tr>
                <td align="right"><b>Contact Email:</b></td>
                <td><input type="text" name="supplier_email" size="35" value="<?php echo $supplier->get_email()?>"/></td>
            </tr>
            <tr>
                <td align="right"><b>Contact Number:</b></td>
                <td><input type="text" name="supplier_number" size="35" value="<?php echo $supplier->get_number()?>"/></td>
            </tr>
            <tr align="center">
                <td colspan="8">
                    <input type="submit" name="update_supplier" value="Update Supplier"/>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>

<?php
    if(isset($_POST['update_supplier'])){
        $supplier = new Supplier($_GET['edit_supplier']);
        $supplier->set_name($_POST['supplier_name']);
        $supplier->set_email($_POST['supplier_email']);
        $supplier->set_number($_POST['supplier_number']);
        $supplier->update();
    }
?>