<?php
    class Brand{
        private $brand_title;
        private $brand_id;
        public function __construct() {
            $get_arguments = func_get_args();
            $number_of_arguments = func_num_args();
            if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
                call_user_func_array(array($this, $method_name), $get_arguments);
            }
        }
        function __construct1($id){
            $servername = "ELGOBLINO";
            $conn = array("Database"=>"online_store", "UID"=>"omara", "PWD"=>"wildjungle");
            $con = sqlsrv_connect($servername , $conn);
            $this->brand_id = $id;
            $q = sqlsrv_query($con, "select * from brands where brand_id='$id'");
            $q_run = sqlsrv_fetch_array($q);
            $this->brand_title = $q_run['brand_title'];
        }
        public function insert(){
            global $con;
            $brand_title = $this->get_title();
            $insert_brand = "insert into brands (brand_title) values ('$brand_title')";
            $insert_bra = sqlsrv_query($con, $insert_brand);
            if($insert_bra){
                echo "<script>alert('Brand has been inserted !')</script>";
                echo "<script>window.open('index.php?insert_brand','_self')</script>";
            }
        }
        public function update(){
            global $con;
            $brand_id = $this->get_id();
            $brand_title = $this->get_title();
            $update = "update brands set brand_title='$brand_title' where brand_id='$brand_id'";
            $update_bra = sqlsrv_query($con, $update);
            if($update_bra){
                echo "<script>alert('Brand has been updated !')</script>";
                echo "<script>window.open('index.php?view_brands','_self')</script>";
            }
        }
        public function delete(){
            global $con;
            $brand_id = $this->get_id();
            $delete = "delete from brands where brand_id='$brand_id'";
            $delete_pro = "delete from products where product_brand='$brand_id'";
            $delete_pros = sqlsrv_query($con, $delete_pro);
            $delete_bra = sqlsrv_query($con, $delete);
            if($delete_bra and $delete_pros){
                echo "<script>alert('The brand and all its products have been deleted !')</script>";
                echo "<script>window.open('index.php?view_brands','_self')</script>";
            }
        }
        public function set_title($title){
            $this->brand_title = $title;
        }
        public function get_title(){
            return $this->brand_title;
        }
        public function get_id(){
            return $this->brand_id;
        }
    }
?>