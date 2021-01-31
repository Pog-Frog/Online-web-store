<br><h2 style="text-align: center; color: blue;"> Confirm the DELETION of your account</h2>
<form method="post">
<br>
    <input type="submit" name="yes" value="yes i do :(">
    <input type="submit" name="no" value="no i don't :)">
</form>
<?php
    if(isset($_POST['yes'])){
        $c = $_SESSION['customer_email'];
        $c_q = mysqli_query($con, "select * from customers where customer_email='$c'"); 
        $c_info = mysqli_fetch_array($c_q);
        $id = $c_info['customer_id'];
        $delete_c = mysqli_query($con, "delete from customers where customer_email='$c'");
        $delete_c = mysqli_query($con, "delete from favorites where customer_id='$id'");
        $delete_c = mysqli_query($con, "delete from customers where customer_id='$id'");
        echo"<script>alert('Account deleted successfully... redirecting to main page')</script>";
        echo"<script>window.open('../logout.php','_self')</script>";
    }
    if(isset($_POST['no'])){
        echo "<script>window.open('my_account.php','_self')</script>";
    }
?>