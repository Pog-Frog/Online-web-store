<?php 
    $c = $_SESSION['customer_email'];
    $c_q = sqlsrv_query($con, "select * from customers where customer_email='$c'"); 
    $c_info = sqlsrv_fetch_array($c_q);
    $c_pass = $c_info['customer_password'];
    $c_ques = $c_info['recovery_question'];
    $c_ans = $c_info['recovery_answer'];
    $c_id = $c_info['customer_id'];
?>
<form method="post" enctype="multipart/form-data">
    <table align="center" width="750" bgcolor="purple">
        <tr>
            <td><h2>Edit Your Security Info</h2></td>
        </tr>
        <tr>
            <td align="right">Edit Your Password: </td>
            <td><input type="password" name="customer_password" value="<?php echo $c_pass;?>" required/></td>
        </tr>
        <tr>
            <td align="right">Password Confirmaion: </td>
            <td><input type="password" name="customer_password_c" value="<?php echo $c_pass;?>" required/></td>
        </tr>
        <tr>
            <td align="right">Edit Your Recovery Question: </td>
            <td><input type="text" name="recovery_question" value="<?php echo $c_ques;?>"required/></td>
        </tr>
        <tr>
            <td align="right">Edit Your Recovery Question Answer: </td>
            <td><input type="text" name="recovery_answer"value="<?php echo $c_ans;?>" required/></td>
        </tr>
        <tr>
            <td><input type="submit" name="register" value="Submit"/></td>
        </tr>
    </table>
</form>

<?php 
    if(isset($_POST['register'])){
        $customer_password = $_POST['customer_password'];
        $customer_password_c = $_POST['customer_password_c'];
        $recovery_question = $_POST['recovery_question'];
        $recovery_answer = $_POST['recovery_answer'];
        if($customer_password != $customer_password_c){
            echo "<script>alert('the password confirmation doesnt match the password you entered')</script>";
        }
        else{
            $update_customer = "update customers set customer_password='$customer_password',recovery_question='$recovery_question',recovery_answer='$recovery_answer' where customer_id='$c_id'";
            $update_cus = sqlsrv_query($con, $update_customer);
            if($update_cus){
                echo"<script>alert('YOUR ACCOUNT HAS BEEN UPDATE SUCCESSFULLY')</script>";
                echo"<script>window.open('my_account.php','_self')</script>";
            }
        }
    }
?>