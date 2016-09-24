<!DOCTYPE html>
<html style="height:100%;">

<head>
    <?php include 'headset.tpl';?>
    <!-- <link rel="stylesheet" href="<?php echo $CSS_LOGIN_THEME_COLOR;?>"> -->
    <link rel="stylesheet" href="<?php echo $CSS_LOGIN_THEME_POSITION;?>">
</head>

<body>
    <div id="contain">
        <?php echo $ERROR_MSG;?>
        <form id="login-form" action="index.php?action=login" method="POST" autocomplete="off">
            <div id="passbox" style="height:100%;">
                <input type="text" id="name" placeholder="<?php echo $TEXT_NAME;?>" name="username" autofocus="">
                <!-- <hr style="color:#000;"> -->
                <input type="password" id="password" placeholder="<?php echo $TEXT_PW;?>" name="password">
                <input type="submit" id="submit" name="submit" value="<?php echo $TEXT_SUBMIT;?>">
            </div>
        </form>
        <?php include 'footer.tpl';?>
    </div>
</body>

</html>