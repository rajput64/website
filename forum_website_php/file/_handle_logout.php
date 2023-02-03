<?php
    session_start();
    session_unset();
    session_destroy();
    header("location: /forum_website_php/index.php");
    exit();
?>