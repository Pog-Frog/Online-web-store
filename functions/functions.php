<?php

    $servername = "ELGOBLINO";
    $conn = array("Database"=>"online_store", "UID"=>"omara", "PWD"=>"wildjungle");
    $con = sqlsrv_connect($servername , $conn);
    
    function getCategories(){
        global $con;
        $get_cats = "select * from categories";
        $run_cats = sqlsrv_query($con, $get_cats);
        while($row_cats = sqlsrv_fetch_array($run_cats)){
            $cat_id = $row_cats['category_id'];
            $cat_title = $row_cats['category_title'];
            echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a><li>";
        }
    }

    function getQuantity($id){
        global $con;
        $ip =getIp();
        if(isset($_SESSION['customer_email'])){
            $customer_email = $_SESSION['customer_email'];
            $get_pro = "select * from products where product_id='$id'";
            $run_pro = sqlsrv_query($con, $get_pro);
            $row_pro = sqlsrv_fetch_array($run_pro);
            $cart_pro = sqlsrv_fetch_array(sqlsrv_query($con, "select * from cart where product_id='$id' AND customer_email='$customer_email'"));
            $product_quantity = $row_pro['product_quantity'];
            $cart_quantity = $cart_pro['quantity'];
            for($i=1;$i<=$product_quantity;$i++){
                if($i == $cart_quantity){
                    echo "<option value='$i' selected>$i</option>";
                }
                else{
                    echo "<option value='$i'>$i</option>";
                }
            }
        }
    }
    
    function getBrands(){
        global $con;
        $get_brands = "select * from brands";
        $run_brands = sqlsrv_query($con, $get_brands);
        while($row_brands = sqlsrv_fetch_array($run_brands)){
            $brand_id = $row_brands['brand_id'];
            $brand_title = $row_brands['brand_title'];
            echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a><li>";
        }
    }
    function getProducts(){
        if(!isset($_GET['cat']) and !isset($_GET['brand'])){
            global $con;
            $get_pro = "select TOP 6 * from products order by RAND() ";
            $run_pro = sqlsrv_query($con, $get_pro);
            while($row_pro = sqlsrv_fetch_array($run_pro)){
                $pro_id = $row_pro['product_id'];
                $pro_category = $row_pro['product_category'];
                $pro_brand = $row_pro['product_brand'];
                $pro_title = $row_pro['product_title'];
                $pro_price = $row_pro['product_price'];
                $pro_description = $row_pro['product_description'];
                $pro_image = $row_pro['product_image'];
                $pro_keywords = $row_pro['product_keywords'];
                $product_quantity = $row_pro['product_quantity'];
                if($product_quantity <= 0){
                    continue;
                }
                echo "
                    <div id='single_product'>
                        <h3>$pro_title</h3>
                        <a href='details.php?pro_id=$pro_id'>
                            <img src='admin/product_images/$pro_image' width='180' height='180'/>
                        </a>
                        <p><b>$pro_price</b>L.E</p>
                        <a href='details.php?pro_id=$pro_id' style='float:left;'>view more</a>
                        <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>

                    </div>
                ";
            }
        }
    }
    
    function get_product_by_cartegory(){
        if(isset($_GET['cat'])){
            global $con;
            $cat_id = $_GET['cat'];
            $get_cat_pro = "select * from products where product_category='$cat_id'";
            $run_pro = sqlsrv_query($con, $get_cat_pro, array(), array( "Scrollable" => 'static' ));
            $count_pro = sqlsrv_num_rows($run_pro);
            if($count_pro ==0){
                echo"<h2 style='padding: 200px;'>Sorry no products available under this category currently</h2>";
            }
            else{
                while($row_pro = sqlsrv_fetch_array($run_pro)){
                    $pro_id = $row_pro['product_id'];
                    $pro_category = $row_pro['product_category'];
                    $pro_brand = $row_pro['product_brand'];
                    $pro_title = $row_pro['product_title'];
                    $pro_price = $row_pro['product_price'];
                    $pro_description = $row_pro['product_description'];
                    $pro_image = $row_pro['product_image'];
                    $pro_keywords = $row_pro['product_keywords'];
                    $product_quantity = $row_pro['product_quantity'];
                    if($product_quantity <= 0){
                        continue;
                    }
                    echo "
                        <div id='single_product'>
                            <h3>$pro_title</h3>
                            <a href='details.php?pro_id=$pro_id'>
                                <img src='admin/product_images/$pro_image' width='180' height='180'/>
                            </a>
                            <p><b>$pro_price</b>L.E</p>
                            <a href='details.php?pro_id=$pro_id' style='float:left;'>view more</a>
                            <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
    
                        </div>
                    ";
                }
            }
        }
    }

    function get_Product_by_brand(){
        if(isset($_GET['brand'])){
            global $con;
            $brand_id = $_GET['brand'];
            $get_pro = "select * from products where product_brand='$brand_id'";
            $run_pro = sqlsrv_query($con, $get_pro, array(), array( "Scrollable" => 'static' ));
            $count_pro = sqlsrv_num_rows($run_pro);
            if($count_pro == 0){
                echo"<h2 style='padding: 200px;'>Sorry no products available under this brand currently</h2>";
            }
            else{
                while($row_pro = sqlsrv_fetch_array($run_pro)){
                    $pro_id = $row_pro['product_id'];
                    $pro_category = $row_pro['product_category'];
                    $pro_brand = $row_pro['product_brand'];
                    $pro_title = $row_pro['product_title'];
                    $pro_price = $row_pro['product_price'];
                    $pro_description = $row_pro['product_description'];
                    $pro_image = $row_pro['product_image'];
                    $pro_keywords = $row_pro['product_keywords'];
                    $product_quantity = $row_pro['product_quantity'];
                    if($product_quantity <= 0){
                        continue;
                    }
                    echo "
                        <div id='single_product'>
                            <h3>$pro_title</h3>
                            <a href='details.php?pro_id=$pro_id'>
                                <img src='admin/product_images/$pro_image' width='180' height='180'/>
                            </a>
                            <p><b>$pro_price</b>L.E</p>
                            <a href='details.php?pro_id=$pro_id' style='float:left;'>view more</a>
                            <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
    
                        </div>
                    ";
                }
            }
        }
    }

        function getIp() {
            $ip = $_SERVER['REMOTE_ADDR'];
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        
            return $ip;
        }

    function add_to_cart(){
        if(isset($_GET['add_cart'])){
            global $con;
            $ip = getIp();
            $pro_id = $_GET['add_cart'];
            if(isset($_SESSION['customer_email'])){
                $customer_email = $_SESSION['customer_email'];
                $check_pro = "select * from cart where customer_email = '$customer_email' AND product_id='$pro_id'";
                $run_check = sqlsrv_query($con, $check_pro, array(), array( "Scrollable" => 'static' ));
                if(sqlsrv_num_rows($run_check) > 0){
                    echo "";
                }
                else{
                    if(isset($_SESSION['customer_email'])){
                        $c = $_SESSION['customer_email'];
                        $insert_pro = "insert into cart (product_id,quantity, customer_email) values ('$pro_id','1', '$c')";
                        $run_pro = sqlsrv_query($con, $insert_pro);
                        echo "<script>window.open('index.php','self')</script>";
                    }
                    else{
                        echo "<script>alert('Please login first')</script>";
                        echo "<script>window.open('index.php','self')</script>";
                    }
                }
            }
            else{
                echo "<script>alert('Please login first')</script>";
                echo "<script>window.open('index.php','self')</script>";
            }
            
        }
    }

    function add_to_fav(){
        if(isset($_GET['add_fav'])){
            global $con;
            $ip = getIp();
            $pro_id = $_GET['add_fav'];
            $c = $_SESSION['customer_email'];
            $c_q = sqlsrv_query($con, "select * from customers where customer_email='$c'"); 
            $c_info = sqlsrv_fetch_array($c_q);
            $c_id = $c_info['customer_id'];
            $check_pro = "select * from favorites where customer_id= '$c_id' AND product_id='$pro_id'";
            $run_check = sqlsrv_query($con, $check_pro, array(), array( "Scrollable" => 'static' ));
            if(sqlsrv_num_rows($run_check) > 0){
                echo "<script>alert('Product already in your favourites')</script>";
                echo "<script>window.open('details.php?pro_id=$pro_id','_self')</script>";
            }
            else{
                $date_added = date("Y/m/d");
                $insert_pro = "insert into favorites (customer_id,product_id,date_added) values ('$c_id','$pro_id','$date_added')";
                $run_pro = sqlsrv_query($con, $insert_pro);
                echo "<script>alert('Successfully added item to your favourites')</script>";
                echo "<script>window.open('details.php?pro_id=$pro_id','_self')</script>";
            }
        }
    }

    function display_total_items_no(){
        global $con;
        $ip = getIp();
        $count_items = 0;
        if(isset($_SESSION['customer_email'])){
            $customer_email = $_SESSION['customer_email'];
            $get_items = "select * from cart where customer_email='$customer_email'";
            $run_items = sqlsrv_query($con, $get_items, array(), array( "Scrollable" => 'static' ));
            $count_items = sqlsrv_num_rows($run_items);
        }
        echo $count_items;
    }

    function total_price(){
        global $con;
        $ip = getIp();
        $customer_email = $_SESSION['customer_email'];
        $total = 0;
        $item_id = "select * from cart where customer_email='$customer_email'";
        $run_item = sqlsrv_query($con, $item_id);
        while($cart_product = sqlsrv_fetch_array($run_item)){
            $tmp = 0;
            $pro_id = $cart_product['product_id'];
            $tmp_pro = sqlsrv_query($con, "select * from products where product_id='$pro_id'");
            while($pro = sqlsrv_fetch_array($tmp_pro)){
                $tmp = $tmp + $pro['product_price'];
            }
            $tmp = $tmp * $cart_product['quantity'];
            $total = $total + $tmp;
        }
        return $total;   
    }


?>