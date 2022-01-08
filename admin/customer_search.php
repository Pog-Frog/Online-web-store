<?php
    session_start();
    if(!isset($_SESSION['admin_email'])){
        echo "<script>window.open('index.php?Access Denied','_self')</script>";
    }
    else{?>
<!DOCTYPE>
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
            <a href="index.php?insert_supplier">Insert a supplier</a>
            <a href="index.php?view_suppliers">View suppliers</a>
            <a href="index.php?view_supplier_orders">View supplier orders</a>
            <a href="index.php?make_supplier_orders">Make a Supplier order</a>
            <a href="logout.php">Log Out</a>
        </div>
        <div id="left">
            <form action="customer_results.php" method="get" enctype="multipart/form-data">
                <table align="center" width="795" border="2" bgcolor="pink">
                    <tr align="center" bgcolor="purple">
                        <th><b>by ID: </b><input type="text" name="by_id" size="8"/></th>
                        <th><b>by Name:</b><input type="text" name="by_name" size="10"/></th>
                        <th><b>by Email:</b><input type="text" name="by_email" size="15"/></th>
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
                if(isset($_GET['insert_supplier'])){
                    include("insert_supplier.php");
                }
                if(isset($_GET['view_suppliers'])){
                    include("view_suppliers.php");
                }
                if(isset($_GET['delete_supplier'])){
                    include("delete_supplier.php");
                }
                if(isset($_GET['edit_supplier'])){
                    include("edit_supplier.php");
                }
                if(isset($_GET['view_supplier_orders'])){
                    include("view_supplier_orders.php");
                }
                if(isset($_GET['edit_supplier_orders'])){
                    include("edit_supplier_orders.php");
                }
                if(isset($_GET['make_supplier_orders'])){
                    include("make_supplier_orders.php");
                }
            ?>
        </div>
    </div>
</body>
</html>
<?php } ?>