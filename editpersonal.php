<?php
    error_reporting(E_ALL^E_NOTICE^E_WARNING);
    //連結資料庫
    require "connectDB.php";
    $new_name = $_POST['new_name'];
    $new_introduce = $_POST['new_introduce'];
    //限制圖片型別格式，大小
    
    $name=$_COOKIE['acc'];
    if ((($_FILES["img"]["type"] == "image/png")
        ||($_FILES["img"]["type"] == "image/gif")
        ||($_FILES["img"]["type"] == "image/jpeg")
        ||($_FILES["img"]["type"] == "image/jpg"))
        &&($_FILES["img"]["size"] < 100000000))
    {
        if ($_FILES["img"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["img"]["error"] . "<br />";
        }
        else
        {
            echo "檔名: " . $_FILES["img"]["name"] . "<br />";
            echo "檔案型別: " . $_FILES["img"]["type"] . "<br />";
            echo "檔案大小: " . ($_FILES["img"]["size"] / 1024) . " Kb<br />";
            echo "快取檔案: " . $_FILES["img"]["tmp_name"] . "<br />";
            rename($_FILES["img"]["name"],$_FILES["img"]["tmp_name"]);
            //設定檔案上傳路徑，選擇指定資料夾
            
            $_FILES["img"]["name"] = $name.".png";
            //echo "".$_FILES["img"]["name"]."";
            if (file_exists("avator/" . $_FILES["img"]["name"])) 
            {
                //unlink("avator/picture.png"); 
                //echo $_FILES["img"]["name"] . " already exists. ";
                move_uploaded_file($_FILES["img"]["tmp_name"],iconv("UTF-8", "big5", "avator/" . $_FILES["img"]["name"] ));
            } 
            else
            {
                
                //move_uploaded_file($_FILES["img"]["tmp_name"],iconv("UTF-8", "big5", "avator/" . $_FILES["img"]["name"] ));
                move_uploaded_file($_FILES["img"]["tmp_name"],iconv("UTF-8", "big5", "avator/" . $_FILES["img"]["name"] ));
                echo "儲存於: " . "avator/" . $_FILES["img"]["name"];//上傳成功後提示上傳資訊
            }
        }
    }
        

    //定義變數，儲存檔案上傳路徑，之後將變數寫進資料庫相應欄位即可
    //$file = $_FILES["img"]["name"];
    
    //$password = $_COOKIE['password'];

    $sql = "SELECT * from user WHERE account='$name'";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {
            $alt = "UPDATE user SET name='$new_name' ,introduce='$new_introduce' WHERE account='$name'";
            mysqli_query($conn,$alt);
            setcookie("name",$new_name,time()+60*24);
        }
    }
    else
    {
        echo "ERROR!! </br>";
    }

    echo "<script>alert('修改成功');";
    echo "window.location = ('index.php');</script>";
?>