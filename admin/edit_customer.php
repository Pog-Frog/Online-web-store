<!DOCTYPE>
<?php 
    include("includes/db.php");
    include("../includes/customer.php");
    if(isset($_GET['edit_customer'])){
        $customer = new Customer((int)$_GET['edit_customer']);
    }
?>
<html>
    <head>
        <title>View/Edit Customer</title>
    </head>
<body bgcolor="pink"> 
    <form method="post" enctype="multipart/form-data">
        <table align="center" width="795" border="2" bgcolor="purple">
            <tr align="center">
                <td colorspan="8"><h2>View/Edit Customer</h2></td>
            </tr>
            <tr>
                <td align="right"><b>Customer Name:</b></td>
                <td><?php echo $customer->get_name()?></td>
            </tr>
            <tr>
                <td align="right"><b>Customer Email:</b></td>
                <td><?php echo $customer->get_email()?></td>
            </tr>
            <tr>
                <td align="right"><b>Customer Password:</b></td>
                <td><?php echo $customer->get_password()?></td>
            </tr>
            <tr>
                <td align="right"><b>Customer IP:</b></td>
                <td><?php echo $customer->get_ip()?></td>
            </tr>
            <tr>
                <td align="right"><b>Customer Country:</b></td>
                <td><?php echo $customer->get_adddress()->get_country()?></td>
            </tr>
            <tr>
                <td align="right"><b>Customer City:</b></td>
                <td><?php echo $customer->get_adddress()->get_city()?></td>
            </tr>
            <tr>
                <td align="right"><b>Customer Street Address:</b></td>
                <td><?php echo $customer->get_adddress()->get_street()?></td>
            </tr>
            <tr>
                <td align="right"><b>Customer Profile Picture:</b></td>
                <td><img src="../customer/customer_profile_pics/<?php echo $customer->get_image()?>" width="60" height="60"/></td>
            </tr>
            <tr>
                <td align="right"><b>Customer Membership:</b></td>
                <td><?php echo $customer->get_membership()?></td>
            </tr>
            <tr>
                <td align="right"><b>Customer Recovery Question:</b></td>
                <td><?php echo $customer->get_recovery_ques()?></td>
            </tr>
            <tr>
                <td align="right"><b>Customer Recovery Answer:</b></td>
                <td><?php echo $customer->get_recovery_ans()?></td>
            </tr>
            <tr>
                <td align="right"><b>Account Status:</b>
                    <select name="account_status">
                        <option <?php if("true" == $customer->get_status()){echo "selected";}?>>true</option>
                        <option <?php if("false" == $customer->get_status()){echo "selected";}?>>false</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Report User:</b>
                    <select name="report_user">
                        <option <?php if("true" == $customer->get_report()){echo "selected";}?>>true</option>
                        <option <?php if("false" == $customer->get_report()){echo "selected";}?>>false</option>
                    </select>
                </td>
            </tr>
            <tr align="center">
                <td colspan="8"><input type="submit" name="update_post" value="Update Customer"/></td>
            </tr>
    </form>

</body>
</html>

<?php
    if(isset($_POST['update_post'])){
        $tmp = $_POST['account_status'];
        $tmp1 = $customer->get_id();
        $tmp2 = $_POST['report_user'];
        $q = mysqli_query($con, "update customers set account_status='$tmp',report_status='$tmp2' where customer_id='$tmp1'");
        if($q){
            echo "<script>alert('Done!')</script>";
            echo "<script>window.open('index.php?view_customers','_self')</script>";
        }
    }
?>