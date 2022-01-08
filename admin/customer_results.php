<?php
    session_start();
    if(!isset($_SESSION['admin_email'])){
        echo "<script>window.open('index.php?Access Denied','_self')</script>";
    }
    else{?>
<!DOCTYPE>
<?php
    include("../includes/db.php");
    include("../includes/customer.php");
?>
<html>
    <head>
        <title>Admin panel</title>
        <link rel="stylesheet" href="styles/style.css" media="all"/>
    </head>

<body>
    <div class="main_wrapper">
        <div id="header"></div>
        <div id="right">
            <h2 id="right_title">Manage Content</h2>
            <a href="index.php?insert_product">Insert New Product</a>
            <a href="index.php?view_products">View All products</a>
            <a href="index.php?insert_category">Insert New Category</a>
            <a href="index.php?view_categories">View All Categories</a>
            <a href="index.php?insert_brand">Insert New Brand</a>
            <a href="index.php?view_brands">View All Brands</a>
            <a href="index.php?view_customers">View Customers</a>
            <a href="customer_search.php">Search Customers</a>
            <a href="logout.php">Log Out</a>
        </div>
        <div id="left">
            <form action="customer_results.php" method="get" enctype="multipart/form-data">
                <table align="center" width="795" border="2" bgcolor="pink">
                    <tr align="center" bgcolor="purple">
                        <th><b>by ID: </b><input type="text" name="by_id" size="8"/></th>
                        <th><b>by Name: </b><input type="text" name="by_name" size="10"/></th>
                        <th><b>by Email: </b><input type="text" name="by_email" size="15"/></th>
                        <th><input type="submit" name="search_user" value="Search"/></th>
                    </tr>
                </table>
            </form>
            <?php 
                if(isset($_GET['insert_product'])){
                    include("insert_product.php");
                }
                if(isset($_GET['view_products'])){
                    include("view_products.php");
                }
                if(isset($_GET['product_customers'])){
                    include("product_customers.php");
                }
                if(isset($_GET['edit_product'])){
                    include("edit_product.php");
                }
                if(isset($_GET['delete_product'])){
                    include("delete_product.php");
                }
                if(isset($_GET['insert_category'])){
                    include("insert_category.php");
                }
                if(isset($_GET['view_categories'])){
                    include("view_categories.php");
                }
                if(isset($_GET['edit_category'])){
                    include("edit_category.php");
                }
                if(isset($_GET['delete_category'])){
                    include("delete_category.php");
                }
                if(isset($_GET['insert_brand'])){
                    include("insert_brand.php");
                }
                if(isset($_GET['view_brands'])){
                    include("view_brands.php");
                }
                if(isset($_GET['edit_brand'])){
                    include("edit_brand.php");
                }
                if(isset($_GET['delete_brand'])){
                    include("delete_brand.php");
                }
                if(isset($_GET['view_customers'])){
                    include("view_customers.php");
                }
                if(isset($_GET['delete_customer'])){
                    include("delete_customer.php");
                }
                if(isset($_GET['edit_customer'])){
                    include("edit_customer.php");
                }
                if(isset($_GET['search_user'])){?>
                    <table width="795" align="center" bgcolor="purple">
                        <tr align="center" bgcolor="pink">
                            <th>UserID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Account Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr><?php
                    if(isset($_GET['by_id']) && !empty($_GET['by_id'])){
                        $customer = new Customer((int)$_GET['by_id']);?>
                        <tr align="center">
                            <td><?php echo $customer->get_id()?></td>
                            <td><?php echo $customer->get_name()?></td>
                            <td><?php echo $customer->get_email()?></td>
                            <td><?php echo $customer->get_status()?></td>
                            <td><a href="index.php?edit_customer=<?php echo $customer->get_id()?>">Edit</a></td>
                            <td><a href="delete_customer.php?delete_customer=<?php echo $customer->get_id()?>">Delete</a></td>
                        </tr>
                    <?php } 
                    elseif(isset($_GET['by_name']) && !empty($_GET['by_name'])){
                        $tmp = $_GET['by_name'];
                        global $con;
                        $q = sqlsrv_query($con, "select * from customers where customer_name='$tmp'", array(), array( "Scrollable" => 'static' ));
                        if(sqlsrv_num_rows($q) > 0){
                            while($q_run = sqlsrv_fetch_array($q)){
                                $customer = new Customer((int)$q_run['customer_id']);
                                ?>
                                <tr align="center">
                                    <td><?php echo $customer->get_id()?></td>
                                    <td><?php echo $customer->get_name()?></td>
                                    <td><?php echo $customer->get_email()?></td>
                                    <td><?php echo $customer->get_status()?></td>
                                    <td><a href="index.php?edit_customer=<?php echo $customer->get_id()?>">Edit</a></td>
                                    <td><a href="delete_customer.php?delete_customer=<?php echo $customer->get_id()?>">Delete</a></td>
                                </tr><?php
                            }
                        }
                    }
                    elseif(isset($_GET['by_email']) && !empty($_GET['by_email'])){
                        $tmp = $_GET['by_email'];
                        global $con;
                        $q = sqlsrv_query($con, "select * from customers where customer_email='$tmp'", array(), array( "Scrollable" => 'static' ));
                        if(sqlsrv_num_rows($q) > 0){
                            $customer = new Customer($_GET['by_email']);?>
                            <tr align="center">
                                <td><?php echo $customer->get_id()?></td>
                                <td><?php echo $customer->get_name()?></td>
                                <td><?php echo $customer->get_email()?></td>
                                <td><?php echo $customer->get_status()?></td>
                                <td><a href="index.php?edit_customer=<?php echo $customer->get_id()?>">Edit</a></td>
                                <td><a href="delete_customer.php?delete_customer=<?php echo $customer->get_id()?>">Delete</a></td>
                            </tr>
                            <?php   }
                        
                     }?>
                    </table><?php
                }
            ?>
        </div>
    </div>
</body>
</html>
<?php } ?>