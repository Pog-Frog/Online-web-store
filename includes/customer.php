<?php
include("address.php");
    class Customer{
        private $customer_id;
        private $customer_ip;
        private $customer_name;
        private $customer_email;
        private $customer_password;
        private $customer_address;
        private $customer_image;
        private $customer_contact;
        private $customer_membership;
        private $account_status;
        private $recovery_question;
        private $recovery_answer;
        private $report_status;
        public function __construct() {
            $get_arguments = func_get_args();
            $number_of_arguments = func_num_args();
            if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
                call_user_func_array(array($this, $method_name), $get_arguments);
            }
        }
        public function __construct1($arg){
            global $con;
            if(gettype($arg) == "integer"){
                $this->customer_id = $arg;
                $q_run = sqlsrv_query($con, "select * from customers where customer_id='$arg'");
                $q = sqlsrv_fetch_array($q_run);
                $this->customer_address = new Address($q['customer_country'], $q['customer_city'], $q['customer_street']);
                $this->customer_ip = $q['customer_ip'];
                $this->customer_name = $q['customer_name'];
                $this->customer_email = $q['customer_email'];
                $this->customer_password = $q['customer_password'];
                $this->customer_image = $q['customer_image'];
                $this->customer_contact = $q['customer_contact'];
                $this->customer_membership = $q['customer_membership'];
                $this->account_status = $q['account_status'];
                $this->recovery_question = $q['recovery_question'];
                $this->recovery_answer = $q['recovery_answer'];
                $this->report_status = $q['report_status'];
            }
            elseif(gettype($arg) == "string"){
                $this->customer_email = $arg;
                $q_run = sqlsrv_query($con, "select * from customers where customer_email='$arg'");
                $q = sqlsrv_fetch_array($q_run);
                $this->customer_address = new Address($q['customer_country'], $q['customer_city'], $q['customer_street']);
                $this->customer_ip = $q['customer_ip'];
                $this->customer_name = $q['customer_name'];
                $this->customer_id = $q['customer_id'];
                $this->customer_password = $q['customer_password'];
                $this->customer_image = $q['customer_image'];
                $this->customer_contact = $q['customer_contact'];
                $this->customer_membership = $q['customer_membership'];
                $this->account_status = $q['account_status'];
                $this->recovery_question = $q['recovery_question'];
                $this->recovery_answer = $q['recovery_answer'];
                $this->report_status = $q['report_status'];
            }
        }
        public function __construct2($email ,$pass){
            global $con;
            $this->customer_email = $email;
            $this->customer_password = $pass;
            $q_run = sqlsrv_query($con, "select * from customers where customer_email='$email' and customer_password='$pass'");
            $q = sqlsrv_fetch_array($q_run);
            $this->customer_address = new Address($q['customer_country'], $q['customer_city'], $q['customer_street']);
            $this->customer_ip = $q['customer_ip'];
            $this->customer_name = $q['customer_name'];
            $this->customer_id = $q['customer_id'];
            $this->customer_image = $q['customer_image'];
            $this->customer_contact = $q['customer_contact'];
            $this->customer_membership = $q['customer_membership'];
            $this->account_status = $q['account_status'];
            $this->recovery_question = $q['recovery_question'];
            $this->recovery_answer = $q['recovery_answer'];
            $this->report_status = $q['report_status'];
        }
        public function delete(){
            global $con;
            $id = $this->get_id();
            $q_1 = sqlsrv_query($con, "delete from orders where customer_id='$id'");
            $q_2 = sqlsrv_query($con, "delete from favorites where customer_id='$id'");
            $q = sqlsrv_query($con, "delete from customers where customer_id='$id'");
            if($q && $q_1 && $q_2){
                echo "<script>alert('Done!')</script>";
                echo "<script>window.open('index.php?view_customers','_self')</script>";
            }
        }
        public function isEmpty(){
            if(empty($this->customer_name)){
                return "true";
            }
            return "false";
        }
        public function get_report(){
            return $this->report_status;
        }
        public function get_id(){
            return $this->customer_id;
        }
        public function set_id($id){
            $this->customer_id = $id;
        }
        public function get_ip(){
            return $this->customer_ip;
        }
        public function set_ip(){
            $ip = $_SERVER['REMOTE_ADDR'];
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } 
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            $this->ip = $ip;
        }
        public function get_name(){
            return $this->customer_name;
        }
        public function set_name($name){
            $this->customer_name = $name;
        }
        public function get_password(){
            return $this->customer_password;
        }
        public function set_password($pass){
            $this->customer_password = $pass;
        }
        public function get_email(){
            return $this->customer_email;
        }
        public function set_email($email){
            $this->customer_email = $email;
        }
        public function get_adddress(){
            return $this->customer_address;
        }
        public function set_address($address){
            $this->customer_address = $address;
        }
        public function get_image(){
            return $this->customer_image;
        }
        public function set_image($image){
            $this->customer_image = $image;
        }
        public function get_membership(){
            global $con;
            $mem_id = $this->customer_membership;
            $q = sqlsrv_query($con , "select * from memberships where membership_id='$mem_id'");
            $row_q = sqlsrv_fetch_array($q);
            return $row_q['membership_title'];
        }
        public function set_membership($mem){
            $this->customer_membership = $mem;
        }
        public function get_status(){
            return $this->account_status;
        }
        public function set_status($stat){
            $this->account_status = $stat;
        }
        public function get_recovery_ans(){
            return $this->recovery_answer;
        }
        public function set_recovery_ans($ans){
            $this->recovery_answer = $ans;
        }
        public function get_recovery_ques(){
            return $this->recovery_question;
        }
        public function set_recovery_ques($ques){
            $this->recovery_question = $ques;
        }
    }




?>


