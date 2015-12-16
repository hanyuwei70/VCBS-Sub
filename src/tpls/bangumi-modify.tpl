<?php
// 修改番剧页面
$PAGE_TITLE = '番剧修改';//具体上线这里应该为xx番剧等……
$USER_ID = '1';
$USER_NAME = 'Inori';
$TETX_NEWS = '最新上传';
$ICO = 'img/favicon.ico';
$CSS_BANGUMI_M = 'css/bangumi-modify.css';
$JS_JQ = 'bower_components/jquery/dist/jquery.min.js';
$CSS_BS = 'bower_components/bootstrap/dist/css/bootstrap.min.css';
//$ARR_BANGUMI中的tag标签只是为了以后升级，后端不必先跟上，返回空字符串就好
$ARR_BANGUMI = array(
    'cover' => 'img/gc1.jpg',
    'number' => '24',
    'time' => '2011.2',
    'tag' => '原创，超能力，战斗，袭胸',
    'title' => 'My いのり 不可能这么可爱',
    'summary' => '2029年，日本因突然爆發的」Apocalypse Virus(天啟病毒）「的蔓延而陷入了混亂之中。處於無政府狀態的日本，受到了由超國家之間所組織成的名為「GHQ」的組織的武力介入並接受其統治，東京的六本木更成為被封鎖的地區。之後又以名為「lost christmas（失落的聖誕）」的事件為契機，日本失去了獨立國家的實質權力，並被賦予了表面上的自治權，由此人們開始享受短暫的和平。',
);

?>

    <!DOCTYPE html>
    <html lang="zh" style="height:100%;">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="<?php echo $ICO;?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo $CSS_BS;?>">
        <link rel="stylesheet" href="<?php echo $CSS_BANGUMI_M;?>">

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
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <form class="detail" action="test.php" method="post" enctype="multipart/form-data">

                        <!-- 字幕信息区 -->
                        <input type="file" value="多选文件 or 单选" multiple="true" accept="application/x-zip-compressed,.ass,.sub,.ssa,smi,.srt"/>
                        <!-- 番剧区 -->
                        <input type="text" name="" id="" placeholder="此处放番剧名">
                        <!-- <input type="hidden" name="" id="" placeholder="此处预留番剧status"> -->
                        <input type="hidden" name="" id="" placeholder="此处放预定义番剧id 不可见 或 不可修改">
                        <input type="text" name="" id="" placeholder="此处放番剧描述">
                        <!-- 番剧区 end -->
                        <hr>
                        <input type="text" name="" id="" placeholder="此处放字幕标题">
                        <input type="text" name="" id="" placeholder="此处放上传字幕保存的文件名">
                        <input type="text" name="" id="" placeholder="此处放字幕状态">
                        <input type="text" name="" id="" placeholder="此处放字幕描述">
                        <input type="text" name="" id="" placeholder="此处放字幕语种"><br /><span>or</span><br />
                        <input type="checkbox" name="lang" value="CHS">CHS
                        <input type="checkbox" name="lang" value="JP">JP
                        <input type="checkbox" name="lang" value="CHT">CHT
                        <input type="checkbox" name="lang" value="EN">EN
                        <br >
                        <input type="submit">
                        <!-- 字幕信息区 end -->
                    </form>
                </div>

            </div>
        </div>
        <div id="footer">
            感谢抖M后端大力容忍。
            <p id="footer-least">© 2015 <a href="test.av">test.av</a> All rights reserved.</p>
        </div>
    </body>

    </html>
