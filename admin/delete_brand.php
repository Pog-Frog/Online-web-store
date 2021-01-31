<?php
    include("includes/db.php");
    include("../includes/product.php");
    if(isset($_GET['delete_brand'])){
        $brand = new Brand($_GET['delete_brand']);
        $brand->delete();
    }
?>