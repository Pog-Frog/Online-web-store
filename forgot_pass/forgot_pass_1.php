<div style="margin-top: 100px; margin-left: 150px;">
                        <form method="post">
                            <table width="500" align="center" bgcolor="purple">
                                <tr align="center">
                                    <td colspan="3"><h2>Enter you Email</h2></td>
                                </tr>
                                <tr>
                                    <td align="right" style="padding-top: 20px;"><b>Email:</b></td>
                                    <td><input type="text" name="email" size="40" required/></td>
                                </tr>
                                <tr align="center">
                                    <td colspan="3" style="padding-top: 20px;"><input type="submit" name="login" value="Proceed"/></td>
                                </tr>
                                <tr align="center">
                                    <td colspan="3">Or Login using Facebook  <input type="submit" name="facebook" value="Facebook"/></td>
                                    <td >
                                </tr>
                            </table>
                        </form>
                        <?php 
                            if(isset($_POST['login'])){
                                $customer_email = $_POST['email'];
                                $_SESSION['tmp'] = $customer_email;
                                $check_customer = mysqli_query($con, "select * from customers where customer_email='$customer_email'");
                                $customer_info = mysqli_fetch_array($check_customer);
                                $customer_password = $customer_info['customer_password'];
                                $customer_status = $customer_info['account_status'];
                                if($customer_status == "false"){
                                    echo "<script>alert('Sorry Account Suspended')</script>";
                                }
                                else{
                                    if(mysqli_num_rows($check_customer) == 0){
                                        echo "<script>alert('Email is incorrect')</script>";
                                        exit();
                                    }
                                    else{
                                        echo "<script>window.open('forgot_pass.php?forgot2','_self')</script>";
                                    }
                                }
                            }?>
                        </form>
                    </div>