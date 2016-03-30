<!DOCTYPE html>
<html lang="zh" style="height:100%;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo $ICO; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $CSS_BS; ?>">
    <link rel="stylesheet" href="<?php echo $CSS_SUBTITLE_A; ?>">

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
            <?php if (isset($USER_ID)): ?> 欢迎， <?php echo $USER_NAME; ?> <?php else : ?>未登录 请<a href="index.php?action=login">登录</a> <?php endif; ?>
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
                <div id="detail">
                    <img src=" <?php echo $ARR_BANGUMI['cover']; ?> " alt="GC" width="100%" />
                    <div class="hover">
                        <span id="title"><?php echo $ARR_BANGUMI['title']; ?></span>
                        <ul>
                            <li id="time">播放时间：<span><?php echo $ARR_BANGUMI['time']; ?></span></li>
                            <li id="number">集数：<span><?php echo $ARR_BANGUMI['number']; ?></span></li>
                            <li id="tag">tag：<span><?php echo $ARR_BANGUMI['tag']; ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="s-form" class="col-xs-12 col-sm-8 col-md-8">
                <form class="subtitle" action="test.php" method="post" enctype="multipart/form-data">
                        <div>
                            
                        <input type="file" value="字幕" name="subFile" multiple="true" onchange="analyze(this)"/>
                        
                        字幕ID<input type="text" name = "subId" id = "subId" value="12345" readonly><br />  
                        
                        <label for="sName">字幕标题</label><input type="text" id = "subName" name = "subName"><br />
                        
                        上传者ID<input type="text" value="<?php echo $USER_ID; ?>" id = "uploader" name = "uploader" readonly><br />
                        
                        所属番剧<input type="text" value="<?php echo $ARR_BANGUMI['title']; ?>" id = "bangumiTitle" name ="bangumiTitle" readonly><br />
                        
                        所属番剧ID<input type="text" value="<?php echo $ARR_BANGUMI['title']; ?>" id = "bangumiID" name = "bangumiID" readonly><br />
                         
                         <!--时间由后端自行解决，不上传-->
                        
                        字幕文件名称<input type="text" value="" id = "fileName" name = "fileName" readonly><br /> 
                        
                        语种(可多选)
                            <label for="jp"><input type="checkbox" name = "lang" id = "jp">jp</label>
                            <label for="en"><input type="checkbox" name = "lang" id = "en">en</label>
                            <label for="ch"><input type="checkbox" name = "lang" id = "ch">ch(简)</label>
                            <label for="zh"><input type="checkbox" name = "lang" id = "zh">zh(繁)</label><br />
                            
                        <label for="des">字幕描述</label>
                        <textarea name="description" id="des" cols="80" rows="5">　　</textarea><br />
                        
                        <input type="reset" value = "reset">
                        <input type="submit" value = "上传">
                        </div>
                  </form>
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