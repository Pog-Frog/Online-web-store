<?php
    class Address{
        private $country;
        private $city;
        private $street;
        
        public function __construct($country, $city, $street){
            $this->country = $country;
            $this->city = $city;
            $this->street = $street;
        }
        public function get_country(){
            return $this->country;
        }
        public function set_country($country){
            $this->country = $country;
        }
        public function get_city(){
            return $this->city;
        }
        public function set_city($city){
            $this->city = $city;
        }
        public function get_street(){
            return $this->street;
        }
        public function set_street($street){
            $this->street = $street;
        }
    }
?>