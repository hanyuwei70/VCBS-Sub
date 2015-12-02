<?php
$PAGE_TITLE        = "主页";
// $CSS_MAIN_POSITION = "css/mainpage.css";
$CSS_MAIN_COLOR    = "css/main.css";
$USER_ID           = "1";
$USER_NAME         = "Inori";
$TETX_NEWS         = "最新上传";
$ICO               = "img/favicon.ico";
?>

<!DOCTYPE html>
<html lang="zh" style="height:100%;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo "$ICO";?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $CSS_MAIN_POSITION;?>">
    <link rel="stylesheet" href="<?php echo $CSS_MAIN_COLOR;?>">
    <title>
        <?php echo $PAGE_TITLE;?>
    </title>
</head>

<body>
    <div id="navbar">
        <div id="logo">
            23333
        </div>
        <div id="userinfo">
        <?php if (isset($USER_ID)): ?>
            欢迎，<?php echo $USER_NAME;?>
        <?php else: ?>未登录 请<a href="index.php?action=login">登录</a>
        <?php endif;?>
        </div>
    </div>
    <form action="index.php?action=search" method="GET" id="form">
        <div id="search_box">
            <input type="text" id="name" name="search" placeholder="<?php echo $TETX_NEWS;?>" autocapitalize="off" autocorrect="off" spellcheck="false">
        </div>
    </form>
    <div id="footer">
        感谢抖M后端大力容忍。
        <p id="footer-least">© 2015 <a href="test.av">test.av</a> All rights reserved.</p>
    </div>
</body>

</html>
