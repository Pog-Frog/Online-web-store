<?php 
    $c = $_SESSION['customer_email'];
    $c_q = sqlsrv_query($con, "select * from customers where customer_email='$c'"); 
    $c_info = sqlsrv_fetch_array($c_q);
    $c_name = $c_info['customer_name'];
    $c_pass = $c_info['customer_password'];
    $c_image = $c_info['customer_image'];
    $c_country = $c_info['customer_country'];
    $c_city = $c_info['customer_city'];
    $c_street = $c_info['customer_street'];
    $c_contact = $c_info['customer_contact'];
    $c_mem = $c_info['customer_membership'];
    $c_id = $c_info['customer_id'];
?>
<form method="post" enctype="multipart/form-data">
    <table align="center" width="750" bgcolor="purple">
        <tr>
            <td><h2>Edit Your Account</h2></td>
        </tr>
        <tr>
            <td align="right">Edit Your Name</td>
            <td><input type="text" name="customer_name" value="<?php echo $c_name;?>" required/></td>
        </tr>
        <tr>
            <td align="right">Edit Your Profile Picture: </td>
            <td><input type="file" name="customer_image" required/><img src="customer_profile_pics/<?php echo $c_image;?>" width="50" height="50"/></td>
        </tr>
        <tr>
            <td align="right">Edit Your Country: </td>
            <td>
                <select name="customer_country" <?php if(!empty($c_country)){echo "disabled";}?>>
                    <option <?php if($c_country == "Egypt"){echo "selected";}?>>Egypt</option>
                    <option <?php if($c_country == "Saudi Arabia"){echo "selected";}?>>Saudi Arabia</option>
                    <option <?php if($c_country == "United Arab Emirates"){echo "selected";}?>>United Arab Emirates</option>
                    <option <?php if($c_country == "Iraq"){echo "selected";}?>>Iraq</option>
                    <option <?php if($c_country == "Syria"){echo "selected";}?>>Syria</option>
                    <option <?php if($c_country == "Afghanistan"){echo "selected";}?>>Afghanistan</option>
                    <option <?php if($c_country == "North korea"){echo "selected";}?>>North korea</option>
                    <option <?php if($c_country == "Nigeria"){echo "selected";}?>>Nigeria</option>
                    <option <?php if($c_country == "Borkina"){echo "selected";}?>>Borkina Faso</option>
                    <option <?php if($c_country == "Kekistan"){echo "selected";}?>>Kekistan</option>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right">Edit Your City: </td>
            <td><input type="text" name="customer_city" value="<?php echo $c_city;?>"required/></td>
        </tr>
        <tr>
            <td align="right">Edit Your Street Address: </td>
            <td><textarea cols="20" rows="10" name="customer_street" required><?php echo $c_street;?></textarea></td>
        </tr>
        <tr>
            <td align="right">Edit Your Customer Contact: </td>
            <td><input type="text" name="customer_contact"value="<?php echo $c_contact;?>" required/></td>
        </tr>
        <tr>
            <td align="right">Edit Your Membership: </td>
            <td>
                <select name="customer_membership">
                    <option <?php if("Normal" == $c_mem){echo "selected";}?>>Normal</option>
                    <option <?php if("Gold" == $c_mem){echo "selected";}?>>Gold</option>
                    <option <?php if("Platinum " == $c_mem){echo "selected";}?>>Platinum</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="register" value="Submit"/></td>
        </tr>
    </table>
</form>

<?php 
    if(isset($_POST['register'])){
        $customer_name = $_POST['customer_name'];
        $customer_image = $_FILES['customer_image']['name'];
        $customer_image_tmp = $_FILES['customer_image']['tmp_name'];
        $customer_country = $_POST['customer_country'];
        $customer_city = $_POST['customer_city'];
        $customer_street = $_POST['customer_street'];
        $customer_contact = $_POST['customer_contact'];
        $customer_membership = $_POST['customer_membership'];
        move_uploaded_file($customer_image_tmp, "customer_profile_pics/$customer_image");
        $update_customer = "update customers set customer_name='$customer_name',customer_image='$customer_image',customer_country='$customer_country',customer_city='$customer_city',customer_street='$customer_street', customer_contact='$customer_contact', customer_membership='$customer_membership' where customer_id='$c_id'";
        $update_cus = sqlsrv_query($con, $update_customer);
        if($update_cus){
            $_SESSION['customer_name'] = $customer_name;
            echo"<script>alert('YOUR ACCOUNT HAS BEEN UPDATE SUCCESSFULLY')</script>";
            echo"<script>widow.open('my_account.php','_self')</script>";
        }
    }
?>