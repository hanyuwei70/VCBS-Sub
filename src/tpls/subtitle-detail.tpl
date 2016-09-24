<!--字幕下载页面-->
<!DOCTYPE html>
<html>

<head>
    <?php include 'headset.tpl';?>
    <link rel="stylesheet" href="<?php echo $CSS_BS; ?>">
    <link rel="stylesheet" href="<?php echo $CSS_SUBTITLE_D; ?>">
</head>

<body>
    <div id="container">
        <?php include 'navbar.tpl';?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <?php include 'searchbar.tpl';?>
                </div>
            </div>
            <div class="row content">
                <div class="col-xs-offset-1 fan-sub-icon"><img src="tpls/img/favicon.ico" class="img-circle" alt="字幕组头像" title="字幕组头像"></div>
                <div class="col-xs-10 col-xs-offset-1 fan-sub-g-name">
                    <?php echo $ARR_SUBTITLE['fansub']; ?>
                </div>
                <row>
                    <div class="col-xs-10 col-xs-offset-1 sub-bangumi-title">
                        <?php echo $ARR_SUBTITLE['title']; ?>
                    </div>
                </row>
                <div class="col-xs-10 col-xs-offset-1 detail-card">

                    <div class="hidden-xs col-sm-4 sub-bangumi-cover">
                        <img src="tpls/img/gc1.jpg" class="img-responsive" alt="番剧封面" title="番劇头像">
                    </div>

                    <row>
                        <div class="col-xs-12 col-sm-8 sub-detail" id="subDetail">
                            <row>
                                <div class="col-xs-4 col-sm-2 col-xs-offset-1 col-sm-offset-3 sub-item">语言</div>
                                <div class="col-xs-5 sub-val">
                                    <span v-text="arrSubtitle | langTrans"></span>
                                </div>
                            </row>
                            <row>
                                <div class="col-xs-4 col-sm-2 col-xs-offset-1 col-sm-offset-3 sub-item">字体</div>
                                <div class="col-xs-5 sub-val">
                                    <span v-text="arrSubtitle.lang | fontTrans"></span>
                                </div>
                            </row>
                            <row>
                                <div class="col-xs-4 col-sm-2 col-xs-offset-1 col-sm-offset-3 sub-item">特效</div>
                                <div class="col-xs-5 sub-val">
                                    <span v-text="arrSubtitle.lang | effTrans"></span>
                                </div>
                            </row>
                        </div>
                    </row>
                    <!--<row>-->
                    <div class="dl-bn col-xs-4 col-xs-offset-5 col-sm-offset-5"><span>⇓</span></div>
                    <div class="warming col-xs-12 col-sm-7 col-sm-offset-5">
                        <span>请配合正版片源食用&gt;_&lt;</span><a href="test.com">download</a>
                    </div>
                    <!--</row>-->
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.tpl';?>
    <script>
        var arrSubtitle = <?php echo json_encode($ARR_SUBTITLE); ?>;
    </script>
    <script src="<?php echo $JS_VUE; ?>"></script>
    <script src="<?php echo $JS_SUBTITLE_D; ?>"></script>
</body>

</html>