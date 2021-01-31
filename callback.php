<?php
    session_start();
    require_once('fb_config.php');
    include("includes/db.php");
    include("includes/customer.php");
    include("functions/functions.php");
    try{
       $accesstoken = $handler->getAccessToken();

    }catch(\Facebook\Exceptions\FacebokResponseException $e){
        echo "Response Exception: ".$e->getMessage();
    }catch(\Facebook\Exceptions\FacebokSDKException $e){
        echo "SDK Exception: ".$e->getMEssage();
        exit();
    }
    if(!$accesstoken){
        header('Location: chechout.php');
        exit();
    }
    $oAuth2Client = $fb_obj->getOAuth2Client();
    if(!$accesstoken->isLongLived()){
        $accesstoken = $oAuth2Client->getLongLivedAccessToken($accesstoken);
    }
    $response = $fb_obj->get("/me?fields=id, name, email, picture.type=(large)", $accesstoken);
    $response_image = $fb_obj->get("/me/picture?redirect=false&width=320&height=320", $accesstoken);
    $user_data = $response->getGraphNode()->asArray();
    $user_image = $response_image->getGraphNode()->asArray();
    $_SESSION['user_data'] = $user_data;
    $_SESSION['access_token'] = (string)$accesstoken;
    $_SESSION['customer_email'] = $_SESSION['user_data']['email'];
    $_SESSION['customer_name'] = $_SESSION['user_data']['name'];
    $customer_email = $_SESSION['customer_email'];
    $q = mysqli_query($con, "select * from customers where customer_email='$customer_email'");
    if(mysqli_num_rows($q) == 0){
        $customer_name = $_SESSION['customer_name'];
        $customer_image = "$customer_name.jpg";
        $ch = curl_init($user_image['url']);
        $fp = fopen("customer/customer_profile_pics/$customer_name.jpg", "wb");
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
        $customer_ip = getIp();
        $insert_c = "insert into customers (customer_ip,customer_name,customer_email,customer_image) values ('$customer_ip','$customer_name','$customer_email','$customer_image')";
        $insert_q = mysqli_query($con, $insert_c);
        if($insert_q){
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
    else{
        $customer = new Customer($_SESSION['customer_email']);
        if($customer->get_status() != "false"){
            if($customer->get_report() != "false"){
                echo "<script>alert('Login Successfull BUT YOU HAVE BEEN REPORTED BY THE ADMIN BAD BOY!!')</script>";
                echo "<script>window.open('customer/my_account.php','_self')</script>";
            }
            else{
                echo "<script>alert('Login Successfull !!')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }
        }
        else{
            unset($_SESSION['customer_email']);
            unset($_SESSION['customer_name']);
            echo "<script>alert('Sorry Account Suspended')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
        }
    }
    exit();
?>