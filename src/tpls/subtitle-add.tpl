<!DOCTYPE html>
<html>

<head>
    <?php include 'headset.tpl';?>
    <link rel="stylesheet" href="<?php echo $CSS_BS; ?>">
    <link rel="stylesheet" href="<?php echo $CSS_SUBTITLE_A; ?>">
</head>

<body>
    <div id="container">
        <?php include 'navbar.tpl';?>
        <?php include 'searchbar.tpl';?>

        <div class="container">
            <div class="row">
                <!--
                xs 所有手机&1440屏幕半屏720 <768sm
                sm 1920屏幕半屏960 <992md
                bs分栏向上扩展
            -->
                <div class="hidden-xs col-sm-4 cover">
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
                <div id="s-form" class="col-xs-12 col-sm-8">
                    <form class="subtitle" action="test.php" method="post" enctype="multipart/form-data">
                        <div>

                            <label for="subFile">文件上传</label><input type="file" name="subFile" id="subFile" multiple="true"
                                onchange="analyze(this)" />

                            <label for="sName">字幕ID</label><input type="text" name="subId" id="subId" value="12345" readonly><br
                            />

                            <label for="subName">字幕标题</label><input type="text" id="subName" name="subName"><br />

                            <label for="uploader">上传者ID</label><input type="text" value="<?php echo $USER_ID; ?>" id="uploader"
                                name="uploader" readonly><br />

                            <label for="bangumiTitle">所属番剧</label><input type="text" value="<?php echo $ARR_BANGUMI['title']; ?>"
                                id="bangumiTitle" name="bangumiTitle" readonly><br />

                            <label for="bangumiID">所属番剧ID</label><input type="text" value="<?php echo $ARR_BANGUMI['title']; ?>"
                                id="bangumiID" name="bangumiID" readonly><br />

                            <!--时间由后端自行解决，不上传-->

                            字幕文件名称<input type="text" value="" id="fileName" name="fileName" readonly><br /> 语种(可多选)
                            <label for="jp"><input type="checkbox" name = "lang" id = "jp">jp</label>
                            <label for="en"><input type="checkbox" name = "lang" id = "en">en</label>
                            <label for="ch"><input type="checkbox" name = "lang" id = "ch">ch(简)</label>
                            <label for="zh"><input type="checkbox" name = "lang" id = "zh">zh(繁)</label><br />

                            <label for="des">字幕描述</label>
                            <textarea name="description" id="des" cols="80" rows="5">　　</textarea><br />

                            <input type="reset" value="reset">
                            <input type="submit" value="上传">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.tpl';?>
    <script>
        var arr_subtitle = <?php echo json_encode($ARR_SUBTITLE); ?>;
    </script>
    <script src="<?php echo $JS_JQ; ?>"></script>
    <script src="<?php echo $JS_VUE; ?>"></script>
    <script src="<?php echo $JS_SUBTITLE_A; ?>"></script>
</body>

</html>