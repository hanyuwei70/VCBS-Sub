<!DOCTYPE html>
<html lang="zh" style="height:100%;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo "$ICO";?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $PAGE_TITLE;?>
    </title>
    <link rel="stylesheet" href="<?php echo "$CSS_ANIME";?>">
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
            <input type="text" id="name" name="search" placeholder="<?php echo $TEXT_NEWS;?>" autofocus="autofocus" autocapitalize="off" autocorrect="off" spellcheck="false">
        </div>
    </form>
<div id="columns"></div>
    <div id="footer">
        感谢抖M后端大力容忍。
        <p id="footer-least">© 2015 <a href="test.av">test.av</a> All rights reserved.</p>
    </div>
    <script>
    var arr_subtitle = <?php echo json_encode($ARR_SUBTITLE);?>;
    // var arr_subtitle = <?php echo "$ARR_SUBTITLE";?>;
    </script>
    <script src="<?php echo "$JS_JQ" ?>"></script>
    <script type="text/javascript" charset="utf8" src="<?php echo "$JS_SORT" ?>" ></script>
</body>

</html>
