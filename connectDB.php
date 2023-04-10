<?php
    $server="localhost";
    $username="project";
    $password="password";
    $dbname="project";

    $conn=new mysqli($server,$username,$password,$dbname);

    mysqli_query($conn,"SET NAMES 'UTF8'");

    if($conn->connect_error)
    {
        die("Connect error".$conn->connect_error."<br>");
    }
    else
    {
        //echo ("connect success");
    }
?>