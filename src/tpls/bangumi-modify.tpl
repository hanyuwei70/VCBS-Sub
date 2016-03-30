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

                        <!-- 上传图片 or 图片链接 -->
                        <div id = "upload" style="height:300px;border:1px solid gray;">
                            <div id="left" style="float:left;">
                                <input type="file" value="cover" multiple="true" accept="application/x-zip-compressed,.ass,.sub,.ssa,smi,.srt"/>
                                    <span>创建人：</span><input type="text" name="" id="" placeholder="<?php echo $ARR_SUB_BANGUMIS['creator'];?>">
                                <br><span>负责人：</span><input type="text" name="" id="" placeholder="<?php echo $ARR_SUB_BANGUMIS['owner'];?>">
                                <br>番剧id<input type="text" name="" id="" disabled="" placeholder="<?php echo $ARR_SUB_BANGUMIS['id'];?>">
                            </div>
                            <div id="right" style="float:right;">
                                    描述<textarea name="" id=""><?php echo $ARR_SUB_BANGUMIS['description'];?></textarea>
                                <br>番剧状态<input type="text" name="" id="" disabled="" placeholder="此处预留番剧status" >
                                <br>围观次数<input type="text" name="" id="" disabled="" placeholder="<?php echo $ARR_SUB_BANGUMIS['hit'];?>">
                            </div>
                        </div>
                        <!-- 番剧名称信息 -->
                        <!-- 
                        <div id="title">
                            番剧名称id<input type="text" name="" id="" disabled="" placeholder="<?php echo $ARR_SUB_BANGUMIS_NAME['id'];?>">
                            <br>番剧名称<input type="text" name="" id="" placeholder="<?php echo $ARR_SUB_BANGUMIS_NAME['name'];?>">
                            名称语种<select name="" >
                                <option value="jp">jp</option>
                                <option value="en">en</option>
                                <option value="cn">cn</option>
                                <option value="tw">tw</option>
                            </select>
                            主标题？<input type="radio" name="main" id="" >
                        </div>
                        <div id="title">
                            番剧名称id<input type="text" name="" id="" disabled="" placeholder="<?php echo $ARR_SUB_BANGUMIS_NAME['id'];?>">
                            <br>番剧名称<input type="text" name="" id="" placeholder="<?php echo $ARR_SUB_BANGUMIS_NAME['name'];?>">
                            名称语种<select name="" >
                                <option value="jp">jp</option>
                                <option value="en">en</option>
                                <option value="cn">cn</option>
                                <option value="tw">tw</option>
                            </select>
                            主标题？<input type="radio" name="main" id="" >
                        </div>
                        -->
                        <!--new 番剧表单 vue-->
                        <div></div>
                        <!-- 番剧区 end -->
                       <div><input type="buttom"></div>
                        <!--番剧添加按钮-->
                        <input type="reset">
                    </form>
                </div>

            </div>
        </div>
        <div id="footer">
            感谢抖M后端大力容忍。
            <p id="footer-least">© 2015 <a href="test.av">test.av</a> All rights reserved.</p>
        </div>
        <script src="<?php echo $JS_VUE;?>"></script>
        <script src="<?php echo $JS_BANGUMI;?>"></script>
    </body>

    </html>
