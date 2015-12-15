<?php
// 全部番剧列表，可以点击标题进入番剧 detail 页面，该页面包括添加，删除，修改番剧操作的入口
$PAGE_TITLE = '番剧详情';//具体上线这里应该为xx番剧等……
$USER_ID = '1';
$USER_NAME = 'Inori';
$TETX_NEWS = '最新上传';
$ICO = 'img/favicon.ico';
$CSS_BANGUMI_D = 'css/bangumi-detail.css';
$JS_JQ = 'bower_components/jquery/dist/jquery.min.js';
$CSS_BS = 'bower_components/bootstrap/dist/css/bootstrap.min.css';
//$ARR_BANGUMI中的tag标签只是为了以后升级，后端不必先跟上，返回空字符串就好
$ARR_BANGUMI = array(
    'cover' => 'img/gc1.jpg',
    'number' => '24',
    'time' => '2011.2',
    'tag' => '原创，超能力，战斗，袭胸',
    'title' => 'My いのり 不可能这么可爱',
    'summary' => '2029年，日本因突然爆發的」Apocalypse Virus(天啟病毒）「的蔓延而陷入了混亂之中。處於無政府狀態的日本，受到了由超國家之間所組織成的名為「GHQ」的組織的武力介入並接受其統治，東京的六本木更成為被封鎖的地區。之後又以名為「lost christmas（失落的聖誕）」的事件為契機，日本失去了獨立國家的實質權力，並被賦予了表面上的自治權，由此人們開始享受短暫的和平。時光流逝，10年後的2039年。少年櫻滿集——懷抱著抑鬱的心境，並對世間冷眼相待——在天王州第一高校就讀的高中二年生，與同學們保持著一定距離的同時，度過著閒散而又平靜的日子。然而集安穩的日常在某一天突然宣告結束。那天放學後，在自己中意的老地方和一名少女不期而遇。少女名為楪祈。她正是集所憧憬，並在網上有著巨大影響力的歌手。而她也有不為人知的一面。祈正是由17歲青少年恙神涯所率領的「葬儀社」——一個在被封鎖的城市中歌頌著從」GHQ「手中得到」日本的解放「而賭上性命不斷孤獨地戰鬥著的抵抗組織——的成員之一。集在祈與涯引導之下，與葬儀社而發生了關聯。爾後因為關係緊迫獲被女主使用了虛空基因棒，他的右手上出現了「王之刻印」。通過刻印，集可以自在地從人的身體里抽取出名為「void（虛空）」的物質，並以藉此為武器得到戰鬥的力量。然而這也僅僅是，他所背負的「罪之王冠」的物語的開幕罷了……',
    'url' => '#',
);
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
        'title' => '[华盟字幕]Fate/Zero x.264 1280x720',
        'lang' => '0001',
        'time' => 20101010,
        'ID' => 'Inori',
    ),
    array('title' => '[华盟字幕]Fate/Zero x.264 1280x720',
        'lang' => '0010',
        'time' => 20101010,
        'ID' => 'PDS',
    ),
    array(
        'title' => '[华盟字幕]Fate/Zero x.264 1280x720',
        'lang' => '1100',
        'time' => 20101011,
        'ID' => '中文测试',
    ),
    array(
        'title' => '[魔术工房]Fate/Zero x.265 1920x1080',
        'lang' => '1010',
        'time' => 20101011,
        'ID' => 'シャナ ',
    ),
);
$CSS_ANIME = 'css/subtitle.css';
$JS_SORT = 'js/jquery.columns.min.js';
$JS_DETAIL = 'js/bangumi-detail.js';

?>

    <!DOCTYPE html>
    <html lang="zh" style="height:100%;">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="<?php echo $ICO;?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo $CSS_BS;?>">
        <link rel="stylesheet" href="<?php echo $CSS_BANGUMI_D;?>">

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
                    欢迎，
                    <?php echo $USER_NAME;?>
                        <?php else: ?>未登录 请<a href="index.php?action=login">登录</a>
                            <?php endif;?>
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
                    <div id = "detail">
                        <img src=" <?php echo $ARR_BANGUMI['cover'];?> " alt="GC" width="100%"/>
                        <div class= "hover">
                          <span id = "title"><?php echo $ARR_BANGUMI['title'];?></span>
                          <ul>
                               <li id = "time">播放时间：<span><?php echo $ARR_BANGUMI['time'];?></span></li>
                                <li id = "number">集数：<span><?php echo $ARR_BANGUMI['number'];?></span></li>
                                <li id = "tag">tag：<span><?php echo $ARR_BANGUMI['tag'];?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id = "summary" class="col-xs-12 col-sm-8 col-md-8">
                    <div><?php echo $ARR_BANGUMI['summary'];?>
                </div>
            </div>

                <!--字幕列表-->
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div id="columns"></div>
                </div>
                <!--字幕列表 end-->

            </div>
        </div>
        <div id="footer">
            感谢抖M后端大力容忍。
            <p id="footer-least">© 2015 <a href="test.av">test.av</a> All rights reserved.</p>
        </div>
        <script>
        var arr_subtitle = <?php echo json_encode($ARR_SUBTITLE);?>;
        </script>
        <script src="<?php echo $JS_JQ;?>"></script>
        <script src="<?php echo $JS_SORT;?>"></script>
        <script src="<?php echo $JS_DETAIL;?>"></script>
    </body>

    </html>
