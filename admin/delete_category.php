<?php
    include("includes/db.php");
    include("../includes/product.php");
    if(isset($_GET['delete_category'])){
        $category = new Category($_GET['delete_category']);
        $category->delete();
    }
?>