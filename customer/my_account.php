<!DOCTYPE>
<?php
    session_start();
    include("../functions/functions.php");
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
                <img id="logo" src="../images/logo.png", width=300/>
            </a>
            <div class="slideshow-container">
                <!-- Full-width images with number and caption text -->
                <div class="mySlides fade">
                <div class="numbertext">1 / 3</div>
                <img src="../images/banner1.jpg" style="width:700px; height: 287.41px">
                </div>

                <div class="mySlides fade">
                <div class="numbertext">2 / 3</div>
                <img src="../images/banner2.jpg" style="width:700px; height: 287.41px">
                </div>

                <div class="mySlides fade">
                <div class="numbertext">3 / 3</div>
                <img src="../images/banner3.jpg" style="width:700px; height: 287.41px">
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
                    <li><a href="../index.php">home</a></li>
                    <li><a href="../all_products.php">All products</a></li>
                    <li><a href="../customer/my_account.php">My Account</a></li>
                    <li><a href="../customer_register.php">Sign up</a></li>
                    <li><a href="../cart.php">Shopping Cart</a></li>
                    <li><a href="#">Contact us</a></li>
                
                    <div style="float: right;">
                        <form method="get" action="../results.php" enctype="multiplart/form-data">
                            <input type="text" name="user_query" placeholder="Search a product"/>
                            <input type="submit" name="search" value="Search"/>
                        </form>
                    </div>
                </ul>
        </div>

        <div class="content_wrapper">
            <div id="sidebar">
                <div id="sidebar_title">Account Options</div>     
                    <ul id="categories">
                        <?php 
                            $customer = $_SESSION['customer_email'];
                            $customer_q = mysqli_query($con, "select * from customers where customer_email='$customer'"); 
                            $customer_info = mysqli_fetch_array($customer_q);
                            $customer_name = $customer_info['customer_name'];
                            $customer_image = $customer_info['customer_image'];
                            echo"<p style='text-align: center;'><img src='customer_profile_pics/$customer_image' width='150' height='150'/>";
                        ?>
                        <li><a href="my_account.php?my_orders">My Orders</a></li>
                        <li><a href="my_account.php?my_favorites">My Favorites</a></li>
                        <li><a href="my_account.php?edit_account">Edit Account</a></li>
                        <li><a href="my_account.php?change_pass">ChangePassword</a></li>
                        <li><a href="my_account.php?delete_account">Delete Account</a></li>
                    </ul>
            </div>
            <div id="content_area">
                <div id="shopping_cart">
                    <span style="float: right; font-size: 18px; padding: 5px; line-height: 40px;">
                        <?php
                            if(!isset($_SESSION['customer_email'])){
                                echo "<a href='../checkout.php' style='color: white;'>Login</a>";
                            }
                            else{
                                echo "<a href='../logout.php' style='color: white;'>Logout</a>";
                            }
                        ?>
                    </span>
                </div>
                <div id="products_box">
                    <h2 style="padding: 20px;">Hello  <?php echo"$customer_name";?> !</h2>
                    <?php
                        if(isset($_GET['edit_account'])){
                            include("edit_account.php");
                        }
                        elseif(isset($_GET['change_pass'])){
                            include("change_pass.php");
                        }
                        elseif(isset($_GET['my_favorites'])){
                            include("my_favorites.php");
                        }
                        elseif(isset($_GET['delete_account'])){
                            include("delete_account.php");
                        }
                        elseif(isset($_GET['my_orders'])){
                            include("my_orders.php");
                        }
                    ?>
                </div>
            </div>  
        <div class="footer">
           <h2 style="text-align: center; padding-top: 30px;">&copy; Pog-Frog_201801367</h2>
        </div>
    </div>
</body>
</html>