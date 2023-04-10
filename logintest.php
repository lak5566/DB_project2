<?php
    session_start();
    require "connectDB.php";
    require "login_acc.php";
    $acc=$_POST['acc'];
    $pwd=$_POST['password'];
    //$admin=$_POST['admin'];
    $sql = "SELECT * from user WHERE account='$acc'";
    if(isset($_POST['admin'])){
        $sql = "select * from administrator where account='$acc'";
    }
    $result=$conn->query($sql);
    
    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc()){
            echo "帳號為".$row['account']."暱稱為".$row['name']."密碼為".$row['password']."<br>";
            if($acc==$row['account']&&$pwd==$row['password'])
            {
                setcookie("acc",$row['account'],time()+60*24); //60s*24m
                setcookie("name",$row['name'],time()+60*24);
                $login=$acc."_login";
                $_SESSION[$acc]=$acc;
                $_SESSION[$login]=true;
            }
            echo $login."<br>";
            $logintest=$_SESSION[$acc]."_login";
            echo $logintest."<br>";
            echo "Cookie:".$_COOKIE["acc"]."<br>";
            echo "Cookie:".$_COOKIE["name"]."<br>";
            if(isset($_POST['admin'])){
                $_SESSION['adminvarefy']=true;
                echo "<script>alert('管理員登入成功');";
                echo "window.location = ('postmanage.php');</script>";
            }
            else{
                echo "<script>alert('登入成功');";
                echo "window.location = ('index.php');</script>";
              }
            
        }
    }
    
    else
    {
        if(isset($_POST['admin'])){
            echo "<script>alert('管理員帳號密碼輸入錯誤，請重新登入')</script>;";
        }
        else
        echo "<script>alert('帳號密碼輸入錯誤，請重新登入')</script>;";
        
    }
?>