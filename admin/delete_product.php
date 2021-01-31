<?php
    include("includes/db.php");
    include("../includes/product.php");
    if(isset($_GET['delete_product'])){
        $product = new Product($_GET['delete_product']);
        $product->delete();
    }
?>