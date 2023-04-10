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
                                    "</span>
                                    <span class='textdown'>"
                                        .$_COOKIE["name"].
                                    "</span>
                                    <span class='logout'><a href='session_clear.php'>登出</a></span> 
                                </div>";
                            }
                            else
                            {
                                echo "<img class='avator' src='avator/unknow.png' alt=''>
                                <div class='innertext'>
                                <span class='textup'><a href='login_acc.php'>&nbsp;登入帳號&nbsp;&nbsp;</a></span>
                                <span class='textdown'><a href='create_acc.php'>&nbsp;註冊帳號</a></span> 
                                </div>";
                            }
                        ?>
                    </li>   
                </a>
                <?php
                    if (isset($_SESSION['adminvarefy']))
                    {
                        echo "
                            <a href='postmanage.php'>
								<li class='side-icon'>
                                    <i class='bx bx-wrench'></i>
									<span class='text'>管理貼文</span>
								</li>
							</a>";
                    }
                ?>
            </ul>
        </div>
    </div>

    <div class="mainframe_post">
        <div class="box1">
            <!--mainpage-->
            <form class="serching" action="search_admin.php" method="post">
                <font size="5"><label for="">文章搜尋：</label></font>
				<i class='bx bx-search-alt-2 front'></i>
                <input type="text" name="article_search" id="article_search">
				<button class="btn" type="submit" >送出</button>
            </form>
			<?php
                require "connectDB.php";

                $keyword = $_POST["article_search"];
                $sql="SELECT * from post where title like '%$keyword%' ";
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
                    echo 	"
                                    <div class='post'>
                                        <div class='post_upper'>
                                            <img class='avator' src='avator/".$imgurl.".png?".rand()."' alt=''>
                                            <div class='owner'>
                                                <span class='text'>&nbsp;" .$row['account']."</span> 
                                                <span class='date'>發布於:".$row['upload_time']."</span>
                                            </div>
                                        </div>
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
                    echo		        "</div>
                                    </div>";
                }
            ?>
            <!--mainpage-->
        </div>     
    </div>
</body>   
    <script src="script.js?v=<?=time()?>"></script>
</html>

