<?php
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
                                echo "<img class='avator' src='avator/unknow.png' alt=''>
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
                <a href="index.php">
                    <li class="side-icon">                 
                            <i class='bx bx-home'></i>
                            <span class="text">主要頁面</span>             
                    </li>
                </a>
                <?php
					if(isset($_SESSION[$login]))
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
			<form action="create_acc_do.php" method="post">
                <div class="keyinbox">
                    <div class="adddata">
                        <label for="">暱稱:</label>
                        <input type="text" name="nickname" id="nickname">
                    </div>
                    <div class="adddata">
                        <label for="">帳號:</label>
                        <input type="text" name="acc" id="acc">
                    </div>
                    <div class="adddata">
                        <label for="">密碼:</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="adddata">
                        <label for="">重複密碼:</label>
                        <input type="password" name="password2" id="password2">
                    </div>
                    <button type="submit" class="btn">送出</button>
                </div>
            </form>
            <!--mainpage-->
        </div>     
    </div>
    <script src="script.js"></script>
</body>
</html>