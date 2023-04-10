<?php
    session_start();
    session_unset();
    setcookie("acc",$row['account'],time());//設立現在，也就是下一秒就清除
    setcookie("name",$row['name'],time());
    header("Location:index.php");
?>