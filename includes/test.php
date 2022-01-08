<?php 
    include("db.php");
    include("supplier.php");

    $supplier = new Supplier();
    $supplier->set_name('this is a good sub');
    $supplier->set_email('sub@gmail.com');
    $supplier->set_number('12345679');
    $supplier->insert();