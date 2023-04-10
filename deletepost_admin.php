<?php
    error_reporting(E_ALL^E_NOTICE^E_WARNING);

    require "connectDB.php";

    $pid = $_GET['post_id'];

    $sql = "delete from post where post_id = $pid;";

    mysqli_query($conn,$sql);


    
    echo "<script>alert('刪除成功');";
    echo "window.location = ('postmanage.php');</script>";




?>