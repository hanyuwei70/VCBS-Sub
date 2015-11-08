<?php
$PAGE_TITLE = "番剧";
$USER_ID = "1";
$USER_NAME = "Inori";
$ICO = "img/favicon.ico";
$TETX_NEWS = "new";
//目前$ITEMS仅作注释用
$ITEMS = array(
    '标题',
    '语言', // 简繁日英
    '上传日期',
    '上传者',
    '评分',
);
$ARR_SUBTITLE = array(
    array(
        "title" => "[华盟字幕]Fate/Zero x.264 1280x720",
        "lang" => "0001",
        "time" => 20101010,
        "ID" => "Inori",
    ),
    array("title" => "[华盟字幕]Fate/Zero x.264 1280x720",
        "lang" => "0010",
        "time" => 20101010,
        "ID" => "PDS",
    ),
    array(
        "title" => "[华盟字幕]Fate/Zero x.264 1280x720",
        "lang" => "1100",
        "time" => 20101011,
        "ID" => "中文测试",
    ),
    array(
        "title" => "[魔术工房]Fate/Zero x.265 1920x1080",
        "lang" => "1010",
        "time" => 20101011,
        "ID" => "シャナ ",
    ),
);
$CSS_ANIME = "css/anime.css";
$JS_SORT = "js/jquery.columns.min.js";
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo "$ICO";?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $PAGE_TITLE;?>
    </title>
    <link rel="stylesheet" href="<?php echo "$CSS_ANIME";?>">
    <script>
    var arr_subtitle = <?php echo json_encode($ARR_SUBTITLE);?>;
    </script>
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="<?php echo "$JS_SORT" ?>" ></script>
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
<div id="columns"></div>
    <div id="footer">
        感谢抖M后端大力容忍。
        <p id="footer-least">© 2015 <a href="test.av">test.av</a> All rights reserved.</p>
    </div>
</body>

</html>
