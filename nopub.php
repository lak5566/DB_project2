<?php
    error_reporting(E_ALL^E_NOTICE^E_WARNING);

    require "connectDB.php";

    $pub = $_GET['public'];
    $pid = $_GET['post_id'];

    $sql = "update post set public = $pub where post_id = $pid;";

    mysqli_query($conn,$sql);



    echo "<script>alert('貼文已設成不公開');";
    echo "window.location = ('selfpost.php');</script>";

?>

