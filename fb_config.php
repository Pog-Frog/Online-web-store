<?php
    require_once('Facebook/autoload.php');
    $fb_obj = new \Facebook\Facebook([
        'app_id' =>'insert your app id',
        'app_secret' => 'insert your app secret key',
        'default_graph_version' => 'v2.10',
    ]);
    $handler = $fb_obj->getRedirectLoginHelper();
?>