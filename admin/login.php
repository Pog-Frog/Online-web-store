<html>
    <head>
    <link rel="stylesheet" href="styles/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Login</title>
    </head>
    <body>
        <div class="main">
            <p class="sign" align="center">Admin Login</p>
            <form class="form1" method="post">
            <input class="un" type="text" align="center" placeholder="Email" name="email" required="required">
            <input class="pass" type="password" align="center" placeholder="Password" name="password" required="required">
            <button class="submit" align="center" type="submit" name="login">Sign in</button>
        </div> 
    </body>
</html>
<?php
    session_start();
    include("../includes/db.php");
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $q = mysqli_query($con, "select * from admins where admin_email='$email' AND admin_pass='$pass'");
        if(mysqli_num_rows($q) == 0){
            echo "<script>alert('Username or Password is incorrect')</script>";
        }
        else{
            $_SESSION['admin_email'] = $email;
            $_SESSION['admin_password'] = $pass;
            echo "<script>window.open('index.php?Access Granted','_self')</script>";
        }
    }
?>
