<table width="795" align="center" bgcolor="purple">
    <tr align="center">
        <td colspan="6"><h2>View All Suppliers</h2></td>
    </tr>
    <tr align="center" bgcolor="pink">
        <th>S.N</th>
        <th>Supplier Name</th>
        <th>Contact Email</th>
        <th>Contain Number</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
        include("../includes/db.php");
        include("../includes/supplier.php");
        $sub_q = sqlsrv_query($con, "select * from suppliers");
        while($row_sub = sqlsrv_fetch_array($sub_q)){
            $sub_id = $row_sub['supplier_id'];
            $sub_name = $row_sub['supplier_name'];
            $sub_num = $row_sub['contact_number'];
            $sub_email = $row_sub['contact_email'];
    ?>
        <tr align="center">
            <td><?php echo $sub_id?></td>
            <td><?php echo $sub_name?></td>
            <td><?php echo $sub_email?></td>
            <td><?php echo $sub_num?></td>
            <td><a href="index.php?edit_supplier=<?php echo $sub_id?>">Edit</a></td>
            <td><a href="delete_supplier.php?delete_supplier=<?php echo $sub_id?>">Delete</a></td>
        </tr>
        <?php } ?>
</table>