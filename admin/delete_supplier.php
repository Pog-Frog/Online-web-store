<?php
    include("includes/db.php");
    include("../includes/supplier.php");
    if(isset($_GET['delete_supplier'])){
        $supplier = new Supplier($_GET['delete_supplier']);
        $supplier->delete();
    }
?>