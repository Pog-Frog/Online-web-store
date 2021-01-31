<?php
    include("includes/db.php");
    include("../includes/customer.php");
    if(isset($_GET['delete_customer'])){
        $customer = new Customer((int)$_GET['delete_customer']);
        $customer->delete();
    }
?>