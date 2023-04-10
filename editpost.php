<?php
    date_default_timezone_set('Asia/Taipei');
    error_reporting(E_ALL^E_NOTICE^E_WARNING);

    require "connectDB.php";

    $pid = $_POST['post_id'];
    $title = $_POST['title'];
    $article = $_POST['article'];
    $time=date("Y-m-d H:i:s");

    if ((($_FILES["img"]["type"] == "image/png")||($_FILES["img"]["type"] == "image/gif")||($_FILES["img"]["type"] == "image/jpeg")||($_FILES["img"]["type"] == "image/jpg"))&&($_FILES["img"]["size"] < 100000000))
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

            if (file_exists("upload/" . $_FILES["img"]["name"])) 
            {
                echo $_FILES["img"]["name"] . " already exists. ";
            } 
            else
            {
                move_uploaded_file($_FILES["img"]["tmp_name"],iconv("UTF-8", "big5", "upload/" . $_FILES["img"]["name"] ));
                echo "儲存於: " . "upload/" . $_FILES["img"]["name"];//上傳成功後提示上傳資訊
            }
        }
    }

    $file = $_FILES["img"]["name"];
    $name=$_COOKIE['acc'];
    $sql = "update post
            set title = '$title' , article = '$article' ,img = '$file' , upload_time = '$time'
            where post_id = '$pid';";

    mysqli_query($conn,$sql);


    echo "<script>alert('貼文修改成功');";
    echo "window.location = ('selfpost.php');</script>";

    

?>