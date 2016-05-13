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
            <?php
            if (isset($USER_ID)) :
                echo "欢迎， $USER_NAME" ;
            else :
                echo "未登录 请<a href='index.php?action=login'>登录</a>";
            endif;
                ?>
        </div>
    </div>

    <form action="index.php?action=search" method="GET" id="form">
        <div id="search_box">
            <input type="text" id="name" name="search" placeholder="<?php echo $TEXT_NEWS; ?>" autocapitalize="off" autocorrect="off"
                spellcheck="false">
        </div>
    </form>

    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-4 cover">
                <div id="detail">
                    <img src=" <?php echo $ARR_BANGUMI['cover']; ?> " alt="GC" width="100%" />
                    <div class="hover">
                        <span id="title">{{ ititle }}</span>
                        <ul>
                            <li id="time">播放时间：<span>{{ itime }}</span></li>
                            <li id="number">集数：<span>{{ inumber }}</span></li>
                            <li id="tag">tag：<span>{{ itag }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 col-md-8">
                <form class="subtitle" action="test.php" method="post" enctype="multipart/form-data">
                    <label for="i_cover">选择封面</label><input type="file" value="番剧封面" name="subFile" id="i_cover">
                    <br/><label for="i_title">标题</label> <input type="text" v-model="ititle" name="title" id="i_title">
                    <br/><label for="i_time">播放时间</label> <input type="text" v-model="itime" name="title" id="i_time">
                    <br/><label for="i_number">播放集数</label> <input type="text" v-model="inumber" name="title" id="inumber">
                    <br/><label for="i_tag">tag</label> <input type="text" v-model="itag" name="title" id="i_tag">
                    <br/><label for="i_summary">梗概</label> <textarea type="text" name="title" id="i_summary"></textarea>
                </form>
            </div>
        </div>

    </div>
    </div>
    <div id="footer ">
        感谢抖M后端大力容忍。
        <p id="footer-least ">© 2015 <a href="test.av ">test.av</a> All rights reserved.</p>
    </div>
    <script>
        var arr_bangumi = <?php echo json_encode($ARR_BANGUMI); ?>;
    </script>
    <!--<script src="<?php echo $JS_JQ; ?>"></script>-->
    <script src="<?php echo $JS_VUE; ?>"></script>
    <script src="<?php echo $JS_ADD; ?>"></script>
</body>

</html>