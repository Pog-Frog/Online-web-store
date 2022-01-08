<?php
    class Category{
        private $category_title;
        private $category_id;
        public function __construct() {
            $get_arguments = func_get_args();
            $number_of_arguments = func_num_args();
            if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
                call_user_func_array(array($this, $method_name), $get_arguments);
            }
        }
        function __construct1($id){
            $this->category_id = $id;
            $con = mysqli_connect("localhost","root","","onlinestore");
            $q = mysqli_query($con, "select * from categories where category_id='$id'");
            $q_run = mysqli_fetch_array($q);
            $this->category_title = $q_run['category_title'];
        }
        public function insert(){
            global $con;
            $category_title = $this->get_title();
            $insert_category = "insert into categories (category_title) values ('$category_title')";
            $insert_cat = mysqli_query($con, $insert_category);
            if($insert_cat){
                echo "<script>alert('Category has been inserted !')</script>";
                echo "<script>window.open('index.php?insert_category','_self')</script>";
            }
        }
        public function update(){
            global $con;
            $cat_id = $this->get_id();
            $category_title = $this->get_title();
            $update = "update categories set category_title='$category_title' where category_id='$cat_id'";
            $update_cat = mysqli_query($con, $update);
            if($update_cat){
                echo "<script>alert('Category has been updated !')</script>";
                echo "<script>window.open('index.php?view_categories','_self')</script>";
            }
        }
        public function delete(){
            global $con;
            $cat_id = $this->get_id();
            $delete = "delete from categories where category_id='$cat_id'";
            $delete_pro = "delete from products where product_category='$cat_id'";
            $delete_pros = mysqli_query($con, $delete_pro);
            $delete_cat = mysqli_query($con, $delete);
            if($delete_cat and $delete_pros){
                echo "<script>alert('The category and all its products have been deleted !')</script>";
                echo "<script>window.open('index.php?view_categories','_self')</script>";
            }
        }
        public function get_title(){
            return $this->category_title;
        }
        public function set_title($title){
            $this->category_title = $title;
        }
        public function get_id(){
            return $this->category_id;
        }
    }
?>