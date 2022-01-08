<?php
    require_once('fb_config.php');
    $redirect = "http://localhost/onlinestore/callback.php";
    $data = ['email'];
    $fullurl = $handler->getLoginUrl($redirect, $data);
?>
<div style="margin-top: 100px; margin-left: 150px;">
    <form method="post">
        <table width="500" align="center" bgcolor="purple">
            <tr align="center">
                <td colspan="3"><h2>Login or Register to Proceed</h2></td>
            </tr>
            <tr>
                <td align="right" style="padding-top: 20px;"><b>Email:</b></td>
                <td><input type="text" name="email" size="40" /></td>
            </tr>
            <tr>
                <td align="right" style="padding-top: 20px;"><b>Password:</b></td>
                <td><input type="password" name="pass" size="30" /></td>
            </tr>
            <tr align="center">
                <td colspan="3" style="padding-top: 20px;">
                    <a href="forgot_pass/forgot_pass.php" style="color: white;">Forgot Password?</a>
                    <br><a href="customer_register.php" style=" color: white;">New ? Register Here</a>
                </td>
            </tr>
            <tr align="center">
                <td colspan="3" style="padding-top: 20px;"><input type="submit" name="login" value="Login"/></td>
            </tr>
            <tr align="center">
                <td colspan="3">Or Login with Facebook</td>
            </tr>
            <tr align="center"><td colspan="3"><input type="button" onclick="window.location='<?php echo $fullurl;?>'" value="FB"/></td></tr>
        </table>
    </form>
    <?php 
        if(isset($_POST['login'])){
            $customer_email = $_POST['email'];
            $customer_password = $_POST['pass'];
            $check_customer = mysqli_query($con, "select * from customers where customer_email='$customer_email' and customer_password='$customer_password'");
            $customer_info = mysqli_fetch_array($check_customer);
            $customer_name = $customer_info['customer_name'];
            $customer_status = $customer_info['account_status'];
            $report_status = $customer_info['report_status'];
            if($customer_status == "false"){
                echo "<script>alert('Sorry Account Suspended')</script>";
            }
            else{
                if(mysqli_num_rows($check_customer) == 0){
                    echo "<script>alert('Password or Email is incorrect')</script>";
                    exit();
                }
                $ip = getIp();
                $customer_cart = mysqli_query($con , "select * from cart where ip_address='$ip'");
                $check_cart = mysqli_num_rows($customer_cart);
                if($check_customer > 0 AND $check_cart == 0){
                    $_SESSION['customer_email'] = $customer_email;
                    $_SESSION['customer_name'] = $customer_name;
                    if($report_status == "true"){
                        echo "<script>alert('Login Successfull BUT YOU HAVE BEEN REPSORTED BY THE ADMIN BAD BOY!!')</script>";
                        echo "<script>window.open('customer/my_account.php','_self')</script>";
                    }
                    else{
                        echo "<script>alert('Login Successfull !!')</script>";
                        echo "<script>window.open('customer/my_account.php','_self')</script>";
                    }
                }
                else{
                    $_SESSION['customer_email'] = $customer_email;
                    $_SESSION['customer_name'] = $customer_name;
                    if($report_status == "true"){
                        echo "<script>alert('Login Successfull BUT YOU HAVE BEEN REPSORTED BY THE ADMIN BAD BOY!!')</script>";
                        echo "<script>window.open('customer/my_account.php','_self')</script>";
                    }
                    else{
                        echo "<script>alert('Login Successfull !!')</script>";
                        echo "<script>window.open('checkout.php','_self')</script>";
                    }
                }
            }
        }
    ?>
</div>