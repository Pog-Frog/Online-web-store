<!DOCTYPE>
<?php
    session_start();
    include("../functions/functions.php");
?>
<html>
    <head>
        <title>Online Store</title>
        <link rel="stylesheet" href="../styles/style.css" media="all"/>
    </head>
<body>

    <div class="main_wrapper"> 

        <div class ="header_wrapper">
            <a href="../index.php">
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
                    <?php
                        if(isset($_SESSION['customer_email'])){
                            echo"<li><a href='../customer/my_account.php'>My Account</a></li>";
                        }
                        else{
                            echo"<li><a href='../checkout.php'>My Account</a></li>";
                        }
                    ?>
                    <li><a href="../customer_register.php">Sign up</a></li>
                    <li><a href="../cart.php">Shopping Cart</a></li>
                    <li><a href="#">Contact us</a></li>
                </ul>
                <div id="form" style="padding-top: 10px;">
                    <form method="get" action="../results.php" enctype="multiplart/form-data">
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
                <div id="shopping_cart">
                    <span style="float: right; font-size: 18px; padding: 5px; line-height: 40px;">
                        <?php
                            if(isset($_SESSION['customer_email'])){
                                echo "<b>Welcome:</b>  " . $_SESSION['customer_name']."   ";
                            }
                            else{
                                echo "<b>Welcome Guest!  </b>";
                            }
                        ?> 
                        <b style="color: yellow">Shopping Cart</b> - Total items: <?php display_total_items_no(); ?>
                        <a href="cart.php" style="color: yellow">Go to Cart</a>
                    </span>
                </div>
                <div id="products_box">
                    <?php 
                        if(!isset($_GET['forgot2'])){
                            include("forgot_pass_1.php");
                        }
                        if(isset($_GET['forgot2'])){
                            include("forgot_pass_2.php");
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="footer">
           <h2 style="text-align: center; padding-top: 30px;">&copy; Pog-Frog_201801367</h2>
        </div>
    </div>
    


</body>
</html>