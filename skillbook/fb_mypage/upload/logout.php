<?php
     
    require_once('config.php');
     
    session_start();
     
    $_SESSION = array();
     
    if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-86400, '/skillbook/fb_mypage');
    }
     
    session_destroy();
     
    header('Location: '.SITE_URL);
    
?>