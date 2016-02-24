<?php
// 修改番剧页面
$PAGE_TITLE = '番剧修改';//具体上线这里应该为xx番剧等……
$USER_ID = '1';
$USER_NAME = 'Inori';
$TETX_NEWS = '最新上传';
$ICO = 'img/favicon.ico';
$CSS_BANGUMI_M = 'css/bangumi-modify.css';
// $JS_JQ = 'bower_components/jquery/dist/jquery.min.js';
$JS_VUE = 'bower_components/vue/dist/vue.min.js';
$JS_BANGUMI = 'js/bangumi-modify.js';
$CSS_BS = 'bower_components/bootstrap/dist/css/bootstrap.min.css';
$ARR_SUB_BANGUMIS = array(
// 番剧id    id 
// 创建者id creator 
// 创建时间 createtime 
// 番剧负责人 owner 
// 番剧描述 description
// 番剧热度 hit 
// 番剧封面 cover 
    'id' => '111111111',
    'creator' => 'inori-l',
    'createtime' => '2000.10.10',
    'owner' => 'inori',
    'description' => '2029年，日本因突然爆發的」Apocalypse Virus(天啟病毒）「的蔓延而陷入了混亂之中。處於無政府狀態的日本，受到了由超國家之間所組織成的名為「GHQ」的組織的武力介入並接受其統治，東京的六本木更成為被封鎖的地區。之後又以名為「lost christmas（失落的聖誕）」的事件為契機，日本失去了獨立國家的實質權力，並被賦予了表面上的自治權，由此人們開始享受短暫的和平。',
    'hit' => '000',
    'cover' => 'img/gc1.jpg',
    'tag' => '原创，超能力，战斗，袭胸',//待添加
);
$ARR_SUB_BANGUMIS_NAME = array(
// id  --番剧名称ID
// bangumi_id  --对应番剧ID
// name --名称
// lang --语种信息 TODO: 确定标准定义字符
// main --是否为番剧原始标题 yes or no
    'id' => '111111110',
    'bangumi_id' => '111111111',
    'name' => 'GC',
    'lang' => 'jp',
    'main' => 'no'
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
