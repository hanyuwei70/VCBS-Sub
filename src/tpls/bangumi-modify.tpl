<!DOCTYPE html>
<html>

<head>
    <?php include 'headset.tpl';?>
    <link rel="stylesheet" href="<?php echo $CSS_BS; ?>">
    <link rel="stylesheet" href="<?php echo $CSS_BANGUMI_M; ?>">
</head>

<body>
    <div id="container">
        <?php include 'navbar.tpl';?>
        <?php include 'searchbar.tpl';?>

        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-4 cover">
                    <div id="detail">
                        <img src=" <?php echo $ARR_BANGUMI['cover']; ?> " alt="GC" width="100%" />
                        <div class="hover" v-el:hover @hover="xia">
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
    <?php include 'footer.tpl';?>
    <script>
        var arr_subtitle = <?php echo json_encode($ARR_BANGUMI); ?>;
    </script>
    <!--<script src="<?php echo $JS_JQ; ?>"></script>-->
    <script src="<?php echo $JS_VUE; ?>"></script>
    <script src="<?php echo $JS_BANGUMI_M; ?>"></script>
</body>

</html>