<!DOCTYPE>
<?php 
    include("includes/db.php");
    include("../includes/supplier.php");
?>
<html>
    <head>
        <title>Inserting supplier</title>
    </head>
<body bgcolor="pink"> 
    <form action="insert_supplier.php" method="post" enctype="multipart/form-data">
        <table align="center" width="795" border="2" bgcolor="purple">
            <tr align="center">
                <td colorspan="8"><h2>Insert new Post here</h2></td>
            </tr>
            <tr>
                <td align="right"><b>Supplier Name:</b></td>
                <td><input type="text" name="supplier_name" size="50" required/></td>
            </tr>
            <tr>
                <td align="right"><b>Contact Number:</b></td>
                <td><input type="text" name="contact_number" size="50" required/></td>
            </tr>
            <tr>
                <td align="right"><b>Contact Email:</b></td>
                <td><input type="text" name="contact_email" size="50" required/></td>
            </tr>
            <tr align="center">
                <td colspan="8"><input type="submit" name="insert_post" value="Insert Product"/></td>
            </tr>
            </table>
    </form>

</body>
</html>

<?php
    if(isset($_POST['insert_post'])){
        $supplier = new Supplier();
        $supplier->set_name($_POST['supplier_name']);
        $supplier->set_email($_POST['contact_email']);
        $supplier->set_number($_POST['contact_number']);
        $supplier->insert();
    }
?>