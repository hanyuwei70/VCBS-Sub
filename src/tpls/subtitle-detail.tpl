<!--字幕下载页面-->
<!DOCTYPE html>
<html lang="zh" style="height:100%;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo $ICO; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $CSS_BS; ?>">
    <link rel="stylesheet" href="<?php echo $CSS_SUBTITLE_D; ?>">

    <title>
        <?php echo $PAGE_TITLE; ?>
    </title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div id="navbar">
                    <div id="logo">
                        23333
                    </div>
                    <div id="userinfo">
                        <?php
            if (isset($USER_ID)) :
                echo "欢迎， $USER_NAME" ;
            else :
                echo "未登录 请<a href='index.php?action=login'>登录</a>";
            endif;
                ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <form action="index.php?action=search" method="GET" id="form">
                    <div id="search_box" title="输入番剧名称搜索字幕">
                        <input type="text" id="name" name="search" placeholder="<?php echo $TEXT_NEWS; ?>" autocapitalize="off" autocorrect="off"
                            spellcheck="false">
                    </div>
                </form>
            </div>
        </div>
        <div class="row content">
            <div class="col-xs-offset-1 fan-sub-icon"><img src="tpls/img/favicon.ico" class="img-circle" alt="字幕组头像" title="字幕组头像"></div>
            <div class="col-xs-10 col-xs-offset-1 fan-sub-g-name">
                <?php echo $ARR_SUBTITLE[fansub]; ?>
            </div>
            <row>
                <div class="col-xs-10 col-xs-offset-1 sub-bangumi-title">
                    <?php echo $ARR_SUBTITLE[title]; ?>
                </div>
            </row>
            <div class="col-xs-10 col-xs-offset-1 detail-card">

                <div class="hidden-xs col-sm-4 sub-bangumi-cover">
                    <img src="tpls/img/gc1.jpg" class="img-responsive" alt="番剧封面" title="番劇头像">
                </div>

                <row>
                    <div class="col-xs-12 col-sm-8 sub-detail">
                        <row>
                            <div class="col-xs-4 col-sm-2 col-xs-offset-2 col-sm-offset-3">语言</div>
                            <div class="col-xs-4">
                                <?php echo $ARR_SUBTITLE[lang]; ?>
                            </div>
                        </row>
                        <row>
                            <div class="col-xs-4 col-sm-2 col-xs-offset-2 col-sm-offset-3">字体</div>
                            <div class="col-xs-4">
                                <?php echo $ARR_SUBTITLE[lang]; ?>
                            </div>
                        </row>
                        <row>
                            <div class="col-xs-4 col-sm-2 col-xs-offset-2 col-sm-offset-3">特效</div>
                            <div class="col-xs-4">
                                <?php echo $ARR_SUBTITLE[lang]; ?>
                            </div>
                        </row>
                    </div>
                </row>
                <!--<row>-->
                <div class="dl-bn col-xs-4 col-xs-offset-5 col-sm-offset-5"><a><span>⇓</span></a></div>
                <div class="warming col-xs-12 col-sm-7 col-sm-offset-5">仅供学习用途，请勿用于非法行为。</div>
                <!--</row>-->
            </div>
        </div>

    </div>

    <div id="footer">
        感谢抖M后端大力容忍。
        <p id="footer-least">© 2015 <a href="test.av">test.av</a> All rights reserved.</p>
    </div>
    <script src="<?php echo $JS_VUE; ?>"></script>
    <!--<script src="<?php echo $JS_SUBTITLE_D; ?>"></script>-->
</body>

</html>