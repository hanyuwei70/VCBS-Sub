<!DOCTYPE html>
<html lang="zh" style="height:100%;">

<head>
    <meta lang="zh_CN">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo "$ICO";?>">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <!-- <link rel="stylesheet" href="<?php echo $CSS_LOGIN_THEME_COLOR;?>"> -->
    <link rel="stylesheet" href="<?php echo $CSS_LOGIN_THEME_POSITION;?>">
    <title>
        <?php echo $PAGE_TITLE?>
    </title>
</head>

<body>
    <?php echo $ERROR_MSG;?>
        <form id="login-form" action="index.php?action=login" method="POST" autocomplete="off">
            <div id="passbox" style="height:100%;">
                <input type="text" id="name" placeholder="<?php echo $TEXT_NAME;?>" name="username" autofocus="">
                <!-- <hr style="color:#000;"> -->
                <input type="password" id="password" placeholder="<?php echo $TEXT_PW;?>" name="password">
                <input type="submit" id="submit" name="submit" value="<?php echo $TETX_SUBMIT;?>">
            </div>
        </form>  
        <div id="footer">
            感谢抖M后端大力容忍。
            <p id="footer-least">© 2015 <a href="test.av">test.av</a> All rights reserved.</p>
        </div>
</body>

</html>
