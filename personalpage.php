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
									<span class='textup'><a class='hoverA' href='login_acc.php'>&nbsp;登入帳號</a></br></span>
									<span class='textdown'><a class='hoverA' href='create_acc.php'>&nbsp;註冊帳號</a></br></span> 
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
                <?php
					if (isset($_SESSION['adminvarefy']))
					{
						echo "
							<a href='selfpost.php'>
								<li class='side-icon'>
									<i class='bx bx-show'></i>
									<span class='text'>檢視貼文</span>
								</li>
							</a>
							<a href='postmanage.php'>
								<li class='side-icon'>
									<i class='bx bx-wrench'></i>
									<span class='text'>管理貼文</span>
								</li>
							</a>
							<a href='addpostpage.php'>
								<li class='side-icon'>
									<i class='bx bx-add-to-queue'></i>
									<span class='text'>發布貼文</span>
								</li>
							</a>
							<a href='#'>
								<li class='side-icon'>
									<i class='bx bxs-cog'></i>
									<span class='text'>
										個人檔案
									</span>
								</li>
							</a>";
					}
					else if(isset($_SESSION[$login]))
					{
						echo "
							<a href='selfpost.php'>
								<li class='side-icon'>
									<i class='bx bx-show'></i>
									<span class='text'>檢視貼文</span>
								</li>
							</a>
							<a href='addpostpage.php'>
								<li class='side-icon'>
									<i class='bx bx-add-to-queue'></i>
									<span class='text'>發布貼文</span>
								</li>
							</a>
							<a href='personalpage.php'>
								<li class='side-icon'>
									<i class='bx bxs-cog'></i>
									<span class='text'>
										個人檔案
									</span>
								</li>
							</a>";
					}
                    
                ?>
            </ul>
        </div>
    </div>

    <div class="mainframe">
        <div class="box1">
            <!--mainpage-->
			<?php
                require "connectDB.php";
                $acc = $_COOKIE['acc'];
		        $sql="select * from user where account='$acc';";
                $result=$conn->query($sql);
                while($row=$result->fetch_assoc())
	        	{   
                    echo 	"<div class='keyinbox'>
                            <center><font size='5'>個人檔案</font></center>
                            </br>
                            <label>個人頭像：</label>
                            </br>
                            <span class='text'>
                            <img class='avator' src='avator/".$_COOKIE['acc'].".png?".rand()."' alt=''>
                            </span>
                            </br></br>
                            <label>暱稱：</label>
                            <span class='text'>
                            ".$row['name']."    
                            </span>
                            </br></br>
                            <label>自我介紹：</label>
                            <span class='text'>
                            ".$row['introduce']." 
                            </span>
                            </br></br>
                            <span class='hovertext'>
                            <a href='editpersonalpage.php?name=".$row['name']."&introduce=".$row['introduce']."'>編輯</a>
                            </span>
                            </div>";
                 }
                
            ?>
            <!--mainpage-->
        </div>     
    </div>
</body>
	<script src="script.js"></script>
</html>