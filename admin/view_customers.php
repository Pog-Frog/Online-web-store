<table width="795" align="center" bgcolor="purple">
    <tr align="center">
        <td colspan="9"><h2>View All Customers</h2></td>
    </tr>
    <tr align="center" bgcolor="pink">
        <th>UserID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Account Status</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
        include("../includes/db.php");
        include("../includes/customer.php");
        $cus_q = sqlsrv_query($con, "select * from customers");
        while($row_cus = sqlsrv_fetch_array($cus_q)){
            $customer = new Customer((int)$row_cus['customer_id']);
    ?>
        <tr align="center">
            <td><?php echo $customer->get_id()?></td>
            <td><?php echo $customer->get_name()?></td>
            <td><?php echo $customer->get_email()?></td>
            <td><?php echo $customer->get_status()?></td>
            <td><a href="index.php?edit_customer=<?php echo $customer->get_id()?>">Edit</a></td>
            <td><a href="delete_customer.php?delete_customer=<?php echo $customer->get_id()?>">Delete</a></td>
        </tr>
        <?php } ?>
</table>