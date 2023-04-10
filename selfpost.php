<?php   
    date_default_timezone_set('Asia/Taipei');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?=time()?>">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' >
    <title>Document</title>

    <!-- <meta http-equiv="refresh" content="1">  -->
</head>
<body>
<div class="nav">
        <div class="logo">
            <i class='bx bx-menu'></i>
                <img src="logo.png" alt="">
                <a href="index.php"><h3>旅人足跡</h3></a>              
        </div>
    </div>

    <div class="container">
        <div class="sidebar">
            <ul class="menubar">
                <a href="#">
                    <li class="side-icon">
                        <!-- <img class="avator" src="avator/unknow.png" alt=""> -->
                        <?php      
                            $login="";                   
                            if(isset($_COOKIE["acc"]))
                            {
                                $login=$_COOKIE["acc"]."_login";
                            }
                            if(isset($_SESSION[$login]))
                            {
                                echo "<img class='avator' src='avator/".$_COOKIE['acc'].".png?".rand()."' alt=''>
                                <div class='innertext'>
                                    <span class='textup'>"
                                		.$_COOKIE["acc"].
                                    "</br></span>
                                    <span class='textdown'>"
                                    	.$_COOKIE["name"].
                                    "</br></span>
                                    <span class='logout'><a class='hoverA' href='session_clear.php'>登出</a></span> 
                                </div>";
                            }
                            else
                            {
                                echo "<img class='avator' src='avator/unknow.png' alt=''>
                                <div class='innertext'>
									<span class='textup'><a class='hoverA' href='login_acc.php'>登入帳號</a></br></span>
									<span class='textdown'><a class='hoverA' href='create_acc.php'>註冊帳號</a></br></span> 
                                </div>";
                            }
                        ?>
                    </li>
                </a>
                <a href="index.php">
                    <li class="side-icon">                 
                            <i class='bx bx-home'></i>
                            <span class="text">主要頁面</span>             
                    </li>
                </a>
                <a href="selfpost.php">
                    <li class="side-icon">
                        <i class='bx bx-show'></i>
                        <span class="text">檢視貼文</span>
                    </li>
                </a>
                <a href="addpostpage.php">
                    <li class="side-icon">
                        <i class='bx bx-add-to-queue'></i>
                        <span class="text">發布貼文</span>
                    </li>
                </a>
                <a href="personalpage.php">
                    <li class="side-icon">
                        <i class='bx bxs-cog'></i>
                        <span class="text">
                            個人檔案
                        </span>
                    </li>
                </a>
            </ul>
        </div>
    </div>

    <div class="mainframe_post">
        <div class="box1">
            <!--mainpage-->
			<?php
                require "connectDB.php";
                $name = $_COOKIE["acc"];
		        $sql="select * from post where account='$name' order by upload_time desc;";
                $result=$conn->query($sql);
                while($row=$result->fetch_assoc())
	        	{   
                    $url="avator/".$row['account'].".png";
                    if(@fopen($url,'r'))
                    {
                        $imgurl=$row['account'];              
                    }
                    else
                    {
                        $imgurl="unknow";
                    }
                    echo 	"<div class='post'>
                        		<div class='post_upper'>
                                	<img class='avator' src='avator/".$imgurl.".png?".rand()."' alt=''>
                                	<div class='owner'>
                        				<span class='text'>&nbsp;" .$row['account']."</span> 
                        				<span class='date'>發布於:".$row['upload_time']."</span>
                            		</div>    
                                    <div class='spanlist'>";
                                        if($row['public']==1)
                                        {
                                            echo "<i class='bx bx-globe'></i>";
                                        }
                                        else
                                        {
                                            echo "<i class='bx bx-lock-alt'></i>";
                                        } 
                                        echo "<span class='listIcon'>
                                            <i class='bx bx-chevron-down'></i>
                                        </span>
                                        <div class='option-menu'>
                                            <ul class='options'>
                                                <li class='option'><span class='optiontext'><a href='editpostpage.php?post_id=".$row['post_id']."&title=".$row['title']."&article=".$row['article']."'>編輯文章</a></span></li>
                                                <li class='option'><span class='optiontext'><a href='deletepost.php?post_id=".$row['post_id']."'>刪除文章</a></span></li>
                                                <li class='option'><span class='optiontext'><a href='pub.php?public=1&post_id=".$row['post_id']."'>公開文章</a></span></li>
                                                <li class='option'><span class='optiontext'><a href='nopub.php?public=0&post_id=".$row['post_id']."'>不公開文章</a></span></li>
                                            </ul>
                                        </div>
                                    </div>";
                                                                  
                        		echo "</div>
                        		<div class='post_middle'>
                    				<div class='title'>"
                        				.$row['title']."
                    				</div>
                    				<div class='article'>"
                        				.$row['article']."
                   			 		</div>
                				</div>
                				<div class='post_under'>";
								if($row['img']==''){}
								else
								{
									echo "<img src=upload/".$row['img']." />";
								}
					echo		"</div>
            				</div>";
                }
            ?>
            <!--mainpage-->
        </div>     
    </div>
</body>   
    <script src="script.js?v=<?=time()?>"></script>
</html>

