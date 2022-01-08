<?php
    class Supplier{
        private $supplier_name;
        private $supplier_email;
        private $supplier_number;
        private $supplier_id;
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
            $this->supplier_id = $id;
            $q = sqlsrv_query($con, "select * from suppliers where supplier_id='$id'");
            $q_run = sqlsrv_fetch_array($q);
            $this->supplier_name = $q_run['supplier_name'];
            $this->supplier_email = $q_run['contact_email'];
            $this->supplier_number = $q_run['contact_number'];
        }
        public function insert(){
            global $con;
            $supplier_name = $this->supplier_name;
            $supplier_number = $this->supplier_number;
            $supplier_email = $this->supplier_email;
            $insert_supplier = "insert into suppliers (supplier_name, contact_number, contact_email) values ('$supplier_name', '$supplier_number', '$supplier_email')";
            $insert_sup = sqlsrv_query($con, $insert_supplier);
            if($insert_sup){
                echo "<script>alert('Supplier has been inserted !')</script>";
                echo "<script>window.open('index.php?insert_supplier','_self')</script>";
            }
        }
        public function update(){
            global $con;
            $supplier_id = $this->get_id();
            $supplier_name = $this->supplier_name;
            $supplier_number = $this->supplier_number;
            $supplier_email = $this->supplier_email;
            $update = "update suppliers set supplier_name='$supplier_name' , contact_email='$supplier_email', contact_number='$supplier_number' where supplier_id='$supplier_id'";
            $update_bra = sqlsrv_query($con, $update);
            if($update_bra){
                echo "<script>alert('Supplier has been updated !')</script>";
                echo "<script>window.open('index.php?view_suppliers','_self')</script>";
            }
        }
        public function delete(){
            global $con;
            $supplier_id = $this->get_id();
            $delete = "delete from suppliers where supplier_id='$supplier_id'";
            $delete_sup = sqlsrv_query($con, $delete);
            if($delete_sup){
                echo "<script>alert('The Supplier has been deleted !')</script>";
                echo "<script>window.open('index.php?view_suppliers','_self')</script>";
            }
        }
        public function set_name($name){
            $this->supplier_name = $name;
        }
        public function set_email($email){
            $this->supplier_email = $email;
        }
        public function set_number($number){
            $this->supplier_number = $number;
        }
        public function get_id(){
            return $this->supplier_id;
        }
        public function get_name(){
            return $this->supplier_name;
        }
        public function get_email(){
            return $this->supplier_email;
        }
        public function get_number(){
            return $this->supplier_number;
        }
    }
?>