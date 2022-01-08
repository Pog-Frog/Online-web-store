<!DOCTYPE>
<?php
    session_start();
    include("functions/functions.php");
?>
<html>
    <head>
        <title>Online Store</title>
        <link rel="stylesheet" href="styles/style.css" media="all"/>
        <script src="js/jquery-3.5.1.min.js"></script>
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
                        <?php
                            if(isset($_SESSION['customer_email'])){
                                echo "<b>Welcome:</b>  " . $_SESSION['customer_name']."   ";
                            }
                            else{
                                echo "<b>Welcome Guest!  </b>";
                            }
                        ?>
                        <b style="color: cyan">Shopping Cart</b> - Total items: <?php display_total_items_no(); ?>
                        <?php 
                            if(!isset($_SESSION['customer_email'])){
                                echo "<a href='checkout.php' style='color: white;'>Login</a>";
                            }
                            else{
                                echo "<a href='logout.php' style='color: white;'>Logout</a>";
                            }
                        ?>
                    </span>
                </div>
                <div id="products_box">
                    <form method="post" enctype="multipart/form-data">
                        <table align="center" width="700" bgcolor="#F3EBF6">
                            <tr align="center">
                                <th>Remove</th>
                                <th>Product(s)</th>
                                <th>Quantity</th>
                                <th>Price/Item</th>
                            </tr>
                            <?php 
                                global $con;
                                $ip = getIp();
                                $tmp = 0;
                                $total = 0;
                                if((isset($_SESSION['customer_email']))){
                                    $customer_email = $_SESSION['customer_email'];
                                    $item_id = "select * from cart where customer_email='$customer_email'";
                                    $run_item = sqlsrv_query($con, $item_id);
                                    while($cart_product = sqlsrv_fetch_array($run_item)){
                                        $pro_id = $cart_product['product_id'];
                                        $tmp_pro = sqlsrv_query($con, "select * from products where product_id='$pro_id'");
                                        while($pro = sqlsrv_fetch_array($tmp_pro)){
                                            $tmp = $tmp + $pro['product_price'];
                                            $product_price = $pro['product_price'];
                                            $product_title = $pro['product_title'];
                                            $product_image = $pro['product_image'];
                                            ?>
                                            <tr align="center">
                                                <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"/></td>
                                                <td>
                                                    <?php echo $product_title?><br>
                                                    <img src="admin/product_images/<?php echo $product_image;?>" width="60" height="60"/>
                                                </td>
                                                <td>
                                                    <select name="qty[<?php echo $pro_id?>]">
                                                        <?php
                                                            getQuantity($pro_id);
                                                        ?>
                                                    </select>
                                                </td>
                                                <td><?php echo $product_price?></td>
                                            </tr>
                                        <?php }
                                    }
                                }
                            ?>
                            <tr align="right">
                                <td colspan="4"><b>Sub Total</b></td>
                                <td colspan="4"><?php echo total_price();?> LE
                            </tr>
                            <tr align="center">
                                <td colspan="2"><input type="submit" name="update_cart" value="Update Cart"/></td>
                                <td><button><a href="index.php" style="text-decoration: none; color: black;">Continue Shopping</a></button></td>
                                <td><button><a href="checkout.php" style="text-decoration: none; color: black;">Proceed to Checkout</a></button></td>
                            </tr>
                        </table>
                    </form>
                    <?php 
                        global $con;
                        $ip = getIp();
                        $customer_email = $_SESSION['customer_email'];
                        if(isset($_POST['update_cart'])){
                            foreach($_POST['qty'] as $pro_id => $qty){
                                sqlsrv_query($con, "update cart SET quantity='$qty' where product_id='$pro_id' AND customer_email='$customer_email'");
                            }
                            foreach($_POST['remove'] as $remove_id){
                                $delete_product = "delete from cart where product_id='$remove_id' AND customer_email='$customer_email'";
                                sqlsrv_query($con, $delete_product);
                            }
                            echo "<script>window.open('cart.php','_self')</script>";
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