<?php
$CSS_LOGIN_THEME_COLOR = "login_theme_color.css";
$CSS_LOGIN_THEME_POSITION = "login_theme_position.css";
$PAGE_TITLE = "LOGIN";
$ERROR_MSG = "";
$TEXT_NAME = "用户名";
$TEXT_PW = "密码";
$TETX_SUBMIT = "登录";
?>

<!DOCTYPE html>
<html style="height:100%;">

<head>
    <meta lang="zh_CN">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <!--这是响应式的基础-->
    <link rel="stylesheet" href="<?php echo $CSS_LOGIN_THEME_COLOR;?>">
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
