<?php
    $servername = "ELGOBLINO";
    $conn = array("Database"=>"online_store", "UID"=>"omara", "PWD"=>"wildjungle");
    $con = sqlsrv_connect($servername , $conn);
    if ($con){
        
    }
    else{
        echo"Failed to connect to sql sever";
    }
?>