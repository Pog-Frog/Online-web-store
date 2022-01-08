<div style="margin-top: 100px; margin-left: 150px;">
    <?php 
        $customer_email = $_SESSION['tmp'];
        $check_customer = sqlsrv_query($con, "select * from customers where customer_email='$customer_email'");
        $customer_info = sqlsrv_fetch_array($check_customer);
        $customer_name = $customer_info['customer_name'];
        $recovery_question = $customer_info['recovery_question'];
        $recovery_answer = $customer_info['recovery_answer'];
    ?>
    <form method="post">
        <table width="500" align="center" bgcolor="purple">
            <tr align="center">
                <td colspan="3"><h2>Enter you security question answer</h2></td>
            </tr>
            <tr>
                <td align="right" style="padding-top: 20px;"><b><?php echo $recovery_question;?></b></td>
                <td><input type="text" name="ans" size="40" required/></td>
            </tr>
            <tr align="center">
                <td colspan="3" style="padding-top: 20px;"><input type="submit" name="login" value="Proceed"/></td>
            </tr>
        </table>
        <?php 
            if(isset($_POST['login'])){
                $ans = $_POST['ans'];
                if($recovery_answer == $ans){
                    $ip = getIp();
                    $customer_cart = sqlsrv_query($con , "select * from cart where ip_address='$ip'", array(), array( "Scrollable" => 'static' ));
                    $check_cart = sqlsrv_num_rows($customer_cart);
                    if($check_customer > 0 AND $check_cart == 0){
                        $_SESSION['customer_email'] = $customer_email;
                        $_SESSION['customer_name'] = $customer_name;
                        echo "<script>alert('Login Successfull !!')</script>";
                        echo "<script>window.open('../customer/my_account.php','_self')</script>";
                    }
                    else{
                        $_SESSION['customer_email'] = $customer_email;
                        $_SESSION['customer_name'] = $customer_name;
                        echo "<script>alert('Login Successfull !!')</script>";
                        echo "<script>window.open('../checkout.php','_self')</script>";
                    }
                }
                else{
                    echo "<script>alert('wrong answer !!')</script>";
                }
            }?>
    </form>
</div>