<?php
    //session_start();
    require "connectDB.php";
    require "create_acc.php";
    $name=$_POST['nickname'];
    $acc=$_POST['acc'];
    $pwd=$_POST['password'];
    $pwd2=$_POST['password2'];

    $sql = "SELECT * from user WHERE account='$acc'";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
        echo "帳戶已被使用";
        // while($row=$result->fetch_assoc()){
        //     echo "帳號為".$row['account']."暱稱為".$row['name']."密碼為".$row['password']."<br>";
        //     if($acc==$row['account']&&$pwd==$row['password'])
        //     {
        //         setcookie("acc",$row['account'],time()+60*24); //60s*24m
        //         setcookie("name",$row['name'],time()+60*24);
        //         $login=$acc."_login";
        //         $_SESSION[$acc]=$acc;
        //         $_SESSION[$login]=true;
        //     }
        //     echo $login."<br>";
        //     $logintest=$_SESSION[$acc]."_login";
        //     echo $logintest."<br>";
        //     echo "Cookie:".$_COOKIE["acc"]."<br>";
        //     echo "Cookie:".$_COOKIE["name"]."<br>";
        // }     
    }
    else
    {
        if($pwd!=$pwd2)
        {
            echo "<script>alert('密碼不一致，請重新註冊');</script>";
        }
        else 
        {
            $sql = "INSERT user VALUES('$acc','$pwd','$name','')";
            mysqli_query($conn,$sql);
            echo "<script>alert('帳號創立成功');";
            echo "window.location = ('index.php');</script>";
        }
    }
    
?>