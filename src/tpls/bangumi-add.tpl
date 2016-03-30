<?php
$TETX_NEWS = '最新上传';
$ICO = 'img/favicon.ico';
$CSS_BANGUMI_A = 'css/bangumi-add.css';
$JS_JQ = 'bower_components/jquery/dist/jquery.min.js';
$CSS_BS = 'bower_components/bootstrap/dist/css/bootstrap.min.css';
$JS_ADD = 'js/bangumi-add.js';
$JS_VUE = 'bower_components/vue/dist/vue.min.js';
?>

<!DOCTYPE html>
<html lang="zh" style="height:100%;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo $ICO; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $CSS_BS; ?>">
    <link rel="stylesheet" href="<?php echo $CSS_BANGUMI_A; ?>">

    <title>
        <?php echo $PAGE_TITLE; ?>
    </title>
  
</head>

<body>
    <div id="navbar">
        <div id="logo">
            23333
        </div>
        <div id="userinfo">
            <?php if (isset($USER_ID)) :
            ?> 欢迎， <?php echo $USER_NAME; ?> <?php else : ?>未登录 请<a href="index.php?action=login">登录</a> <?php endif; ?>
        </div>
    </div>
    
    <form action="index.php?action=search" method="GET" id="form">
        <div id="search_box">
            <input type="text" id="name" name="search" placeholder="<?php echo $TETX_NEWS; ?>" autocapitalize="off" autocorrect="off" spellcheck="false">
        </div>
    </form>
    
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 cover">
                    <form class="subtitle" action="test.php" method="post" enctype="multipart/form-data">
                        <img src="http://www.atool.org/placeholder.png?size=300x400" alt="占位">
                        <input type="file" value=番剧封面" name="subFile" multiple="true" onchange="showImg(this)" accept="application/x-zip-compressed" style="position: absolute;">
                    <div class="hover">
                        <div id = "hover">
                        <span id="title">名称：<input type="text"></span>
                    </div>
                        </form>
                </div>
            </div>

        </div>
    </div>
    <div id="footer">
        感谢抖M后端大力容忍。
        <p id="footer-least">© 2015 <a href="test.av">test.av</a> All rights reserved.</p>
    </div>
    <script src="<?php echo $JS_JQ; ?>"></script>
    <script src="<?php echo $JS_VUE; ?>"></script>
    <script src="<?php echo $JS_ADD; ?>"></script>
</body>

</html>