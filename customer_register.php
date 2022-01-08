<!DOCTYPE>
<?php
    session_start();
    include("functions/functions.php");
    include("includes/db.php");
?>
<html>
    <head>
        <title>Online Store</title>
        <link rel="stylesheet" href="styles/style.css" media="all"/>
    </head>
<body>

    <div class="main_wrapper"> 

        <div class ="header_wrapper">
            <a href="index.php">
                <img id="logo" src="images/logo.png", width=300/>
            </a>
            <div class="slideshow-container">
                <!-- Full-width images with number and caption text -->
                <div class="mySlides fade">
                <div class="numbertext">1 / 3</div>
                <img src="images/banner1.jpg" style="width:700px; height: 287.41px">
                </div>

                <div class="mySlides fade">
                <div class="numbertext">2 / 3</div>
                <img src="images/banner2.jpg" style="width:700px; height: 287.41px">
                </div>

                <div class="mySlides fade">
                <div class="numbertext">3 / 3</div>
                <img src="images/banner3.jpg" style="width:700px; height: 287.41px">
                </div>
                <!-- The dots/circles -->
                <div style="text-align:center">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                </div>
                <script>
                    var slideIndex = 0;
                    showSlides();

                    function showSlides() {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");
                    var dots = document.getElementsByClassName("dot");
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";  
                    }
                    slideIndex++;
                    if (slideIndex > slides.length) {slideIndex = 1}    
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex-1].style.display = "block";  
                    dots[slideIndex-1].className += " active";
                    setTimeout(showSlides, 4000); // Change image every 2 seconds
                    }
                </script>>
            </div>
        </div>

        <div class="menubar" style="margin-top: 10px;">
                <ul id="menu">
                    <li><a href="index.php">home</a></li>
                    <li><a href="all_products.php">All products</a></li>
                    <?php
                        if(isset($_SESSION['customer_email'])){
                            echo"<li><a href='customer/my_account.php'>My Account</a></li>";
                        }
                        else{
                            echo"<li><a href='checkout.php'>My Account</a></li>";
                        }
                    ?>
                    <li><a href="customer_register.php">Sign up</a></li>
                    <li><a href="cart.php">Shopping Cart</a></li>
                </ul>
                <div id="form" style="padding-top: 10px;">
                    <form method="get" action="results.php" enctype="multiplart/form-data">
                        <input type="text" name="user_query" placeholder="Search a product"/>
                        <input type="submit" name="search" value="Search"/>
                    </form>
                </div>
        </div>

        <div class="content_wrapper">
            <div id="sidebar">
                <div id="sidebar_title">All Categories</div>     
                <ul id="categories">
                <?php
                    getCategories();
                ?>
                </ul>
                <div id="sidebar_title">Brands</div>     
                <ul id="categories">
                <?php
                    getBrands();
                ?>
                </ul>
            </div>
            <div id="content_area">
                <?php add_to_cart(); ?>
                <div id="shopping_cart">
                    <span style="float: right; font-size: 18px; padding: 5px; line-height: 40px;">
                        Welcome Guest! 
                        <b style="color: cyan">Shopping Cart</b> - Total items: <?php display_total_items_no(); ?>
                        <a href="cart.php" style="color: cyan">Go to Cart</a>
                    </span>
                </div>
                <form action="customer_register.php" method="post" enctype="multipart/form-data" style="padding-top: 125px; padding-left: 25px;">
                    <table align="center" width="750" bgcolor="purple">
                        <tr>
                            <td><h2>Create an Account</h2></td>
                        </tr>
                        <tr>
                            <td align="right">Name</td>
                            <td><input type="text" name="customer_name" required/></td>
                        </tr>
                        <tr>
                            <td align="right">Email: </td>
                            <td><input type="text" name="customer_email" required/></td>
                        </tr>
                        <tr>
                            <td align="right">Password: </td>
                            <td><input type="password" name="customer_password" required/></td>
                        </tr>
                        <tr>
                            <td align="right">Recovery Question: </td>
                            <td><input type="text" name="recovery_question" required/></td>
                        </tr>
                        <tr>
                            <td align="right">Recovery Question Answer: </td>
                            <td><input type="text" name="recovery_answer" required/></td>
                        </tr>
                        <tr>
                            <td align="right">Profile Picture: </td>
                            <td><input type="file" name="customer_image"/></td>
                        </tr>
                        <tr>
                            <td align="right">Choose a Country: </td>
                            <td>
                                <select name="customer_country">
                                    <option>Egypt</option>
                                    <option>Saudi Arabia</option>
                                    <option>United Arab Emirates</option>
                                    <option>Iraq</option>
                                    <option>Syria</option>
                                    <option>Afghanistan</option>
                                    <option>North korea</option>
                                    <option>Nigeria</option>
                                    <option>Borkina Faso</option>
                                    <option>Kekistan</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Enter City: </td>
                            <td><input type="text" name="customer_city" required/></td>
                        </tr>
                        <tr>
                            <td align="right">Enter Street Address: </td>
                            <td><textarea cols="20" rows="10" name="customer_street" required></textarea></td>
                        </tr>
                        <tr>
                            <td align="right">Customer Contact: </td>
                            <td><input type="text" name="customer_contact" required/></td>
                        </tr>
                        <tr>
                            <td align="right">Choose Membership: </td>
                            <td>
                                <select name="customer_membership">
                                    <option>Normal</option>
                                    <option>Gold</option>
                                    <option>Platinum</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="register" value="Create Account"/></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <div class="footer">
           <h2 style="text-align: center; padding-top: 30px;">&copy; Pog-Frog_201801367</h2>
        </div>
    </div>
</body>
</html>

<?php 
    if(isset($_POST['register'])){
        $ip = getIp();
        $customer_name = $_POST['customer_name'];
        $customer_email = $_POST['customer_email'];
        $customer_password = $_POST['customer_password'];
        $recovery_question = $_POST['recovery_question'];
        $recovery_answer = $_POST['recovery_answer'];
        $customer_image = $_FILES['customer_image']['name'];
        $customer_image_tmp = $_FILES['customer_image']['tmp_name'];
        $customer_country = $_POST['customer_country'];
        $customer_city = $_POST['customer_city'];
        $customer_street = $_POST['customer_street'];
        $customer_contact = $_POST['customer_contact'];
        $customer_membership = $_POST['customer_membership'];
        $account_status = "true";
        $check_customer = sqlsrv_query($con, "select * from customers where customer_email='$customer_email'", array(), array( "Scrollable" => 'static' ));
        if(sqlsrv_num_rows($check_customer) > 0){
            echo"<script>alert('Error this email is already in use')</script>";
        }
        else{
            move_uploaded_file($customer_image_tmp, "customer/customer_profile_pics/$customer_image");
            $q_mem = sqlsrv_query($con, "select membership_id from memberships where membership_title='$customer_membership'");
            $row_mem = sqlsrv_fetch_array($q_mem);
            $cus_mem = $row_mem['membership_id'];
            $insert_customer = "insert into customers (customer_ip,customer_name,customer_email,customer_password,recovery_question,recovery_answer,customer_image,customer_country,customer_city,customer_street,customer_contact,customer_membership,account_status) values ('$ip','$customer_name','$customer_email','$customer_password','$recovery_question','$recovery_answer','$customer_image','$customer_country','$customer_city','$customer_street','$customer_contact','$cus_mem','$account_status')";
            $insert_cus = sqlsrv_query($con, $insert_customer);
            $customer_cart = sqlsrv_query($con , "select * from cart where  AND customer_email='$customer_email'", array(), array( "Scrollable" => 'static' ));
            if(sqlsrv_num_rows($customer_cart) == 0){
                $_SESSION['customer_email'] = $customer_email;
                $_SESSION['customer_name'] = $customer_name;
                echo "<script>alert('Account Created Successfully !!')</script>";
                echo "<script>window.open('customer/my_account.php','_self')</script>";
            }
            else{
                $_SESSION['customer_email'] = $customer_email;
                $_SESSION['customer_name'] = $customer_name;
                echo "<script>alert('Account Created Successfully !!')</script>";
                echo "<script>window.open('checkout.php','_self')</script>";
            }
        }
    }
?>