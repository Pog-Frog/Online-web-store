<?php 
    include("db.php");
    include("product.php");
    include("customer.php");
    $q = new Customer(12);
    echo $q->get_adddress()->get_city();