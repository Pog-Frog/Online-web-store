<?php
include("category.php");
include("brand.php");
    class Product{
        private $pro_id;
        private $pro_title;
        private $pro_price;
        private $pro_describtion;
        private $pro_image;
        private $pro_keywords;
        private $category;
        private $brand;
        private $pro_quantity;
        public function __construct() {
            $get_arguments = func_get_args();
            $number_of_arguments = func_num_args();
            if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
                call_user_func_array(array($this, $method_name), $get_arguments);
            }
        }
        public function __construct1($id){
            global $con;
            $this->pro_id = $id;
            $q = mysqli_query($con, "select * from products where product_id='$id'");
            $q_run = mysqli_fetch_array($q);
            $this->category = new Category($q_run['product_category']);
            $this->brand = new Brand($q_run['product_brand']);
            $this->pro_title = $q_run['product_title'];
            $this->pro_price = $q_run['product_price'];
            $this->pro_describtion = $q_run['product_describtion'];
            $this->pro_image = $q_run['product_image'];
            $this->pro_keywords = $q_run['product_keywords'];
            $this->pro_quantity = $q_run['product_quantity'];
        }
        public function insert(){
            global $con;
            $product_category = $this->category -> get_id();
            $product_brand = $this->brand->get_id();
            $product_title = $this->get_title();
            $product_image = $this->get_image();
            $product_price = $this->get_price();
            $product_describtion = $this->get_describtion();
            $product_keywords = $this->get_keywords();
            $product_quantity = $this->get_quantity();
            $insert_product = "insert into products (product_category,product_brand,product_title,product_price,product_describtion,product_image,product_keywords,product_quantity) values ('$product_category','$product_brand','$product_title','$product_price','$product_describtion','$product_image','$product_keywords','$product_quantity')";
            $insert_pro = mysqli_query($con, $insert_product);
            if($insert_pro){
                echo "<script>alert('Product has been inserted !')</script>";
                echo "<script>window.open('index.php?insert_product','_self')</script>";
            }
        }
        public function update(){
            global $con;
            $pro_id = $this->get_id();
            $product_category = $this->category -> get_id();
            $product_brand = $this->brand->get_id();
            $product_title = $this->get_title();
            $product_image = $this->get_image();
            $product_price = $this->get_price();
            $product_describtion = $this->get_describtion();
            $product_keywords = $this->get_keywords();
            $product_quantity = $this->get_quantity();
            $update = "update products set product_category='$product_category',product_brand='$product_brand',product_title='$product_title',product_image='$product_image',product_price='$product_price',product_describtion='$product_describtion',product_keywords='$product_keywords',product_quantity='$product_quantity' where product_id='$pro_id'";
            $update_pro = mysqli_query($con, $update);
            if($update_pro){
                echo "<script>alert('Product has been updated !')</script>";
                echo "<script>window.open('index.php?view_products','_self')</script>";
            }
        }
        public function delete(){
            global $con;
            $pro_id = $this->get_id();
            $delete = "delete from products where product_id='$pro_id'";
            $delete_pro = mysqli_query($con, $delete);
            if($delete_pro){
                echo "<script>alert('The product has been deleted !')</script>";
                echo "<script>window.open('index.php?view_products','_self')</script>";
            }
        }
        public function get_quantity(){
            return $this->pro_quantity;
        }
        public function set_quantity($quantity){
            $this->pro_quantity = $quantity;
        }
        public function get_category(){
            return $this->category;
        }
        public function get_price(){
            return $this->pro_price;
        }
        public function set_price($price){
            $this->pro_price = $price;
        }
        public function set_category($category){
            $this->category = $category;
        }
        public function get_brand(){
            return $this->brand;
        }
        public function set_brand($brand){
            $this->brand = $brand;
        }
        public function get_describtion(){
            return $this->pro_describtion;
        }
        public function set_describtion($describtion){
            $this->pro_describtion = $describtion;
        }
        public function get_title(){
            return $this->pro_title;
        }
        public function set_title($title){
            $this->pro_title = $title;
        }
        public function get_id(){
            return $this->pro_id;
        }
        public function set_id($id){
            $this->pro_id = $id;
        }
        public function get_image(){
            return $this->pro_image;
        }
        public function set_image($image){
            $this->pro_image = $image;
        }
        public function get_keywords(){
            return $this->pro_keywords;
        }
        public function set_keywords($keywords){
            $this->pro_keywords = $keywords;
        }
    }
?>