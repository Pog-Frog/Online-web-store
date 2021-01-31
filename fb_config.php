<?php
    require_once('Facebook/autoload.php');
    $fb_obj = new \Facebook\Facebook([
        'app_id' =>'401393217785660',
        'app_secret' => 'aab7a3c1ce0d5828f548d1ab2e97d604',
        'default_graph_version' => 'v2.10',
    ]);
    $handler = $fb_obj->getRedirectLoginHelper();
?>