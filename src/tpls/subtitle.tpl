<?php
$items = array(
    '标题',
    //'外挂字体',
    '语言', // 简繁日英
    '上传日期',
    '上传者',
    '评分',
);
$arr_subtitle = array(
    array(
        "title" => "[华盟字幕]Fate/Zero x.264 1280x720",
        "font"  => 0,
        "lang"  => 0001,
        "time"  => "20101010",
        "ID"    => "Inori",
    ),
    array(
        "title" => "[华盟字幕]Fate/Zero x.264 1280x720",
        "font"  => 0,
        "lang"  => 0010,
        "time"  => "20101010",
        "ID"    => "PDS",
    ),
    array(
        "title" => "[华盟字幕]Fate/Zero x.264 1280x720",
        "font"  => 1,
        "lang"  => 1100,
        "time"  => "20101011",
        "ID"    => "中文测试",
    ),
    array(
        "title" => "[魔术工房]Fate/Zero x.265 1920x1080",
        "font"  => 1,
        "lang"  => 1010,
        "time"  => "20101011",
        "ID"    => "シャナ ",
    ),
);
$CSS_ANIME = "anime.css";
?>
<!DOCTYPE html>
<html>

<head>
<title>test</title>
    <link rel = "stylesheet" href = "<?php echo "$CSS_ANIME";?>">
<style>
body {
    width: 100%;
}

.flow-h {
    overflow: hidden;
}

.fl-l {
    float: left;
    border: 1px solid blue;
    width: 10%;
    height: 2em;
}
</style>
</head>

<body>

<?php

/**
 * 默认顺序按照时间序，新的在上面，显示名字/语言（国旗，繁体用字显示，不显示民国旗），不放下载链接。
 * 显示项目有 标题 （字幕）语种 上传时间 上传者name
 * 排序要限定条件，比如对比同一个番的评分，发布顺序，字幕组等。
 */

echo "<div id=\"anime\">\n";
$i = 0;
echo "<div class=\"flow-h\">\n";
foreach ($items as $value) {
    echo "<div class=\"fl-l\">", $value, "</div>\n"; // 首行
    $i++;
}
echo "</div>\n\n";

foreach ($arr_subtitle as $anime) {
    echo "<div class=\"flow-h\">\n";
    foreach ($anime as $item => $key) {
        switch ($item) {
            // array("上传时定义的名称", 是否有外挂字体, "语种","上传日期", "上传者昵称"),
            case 'title':{
                    echo "<div class=\"fl-l title\"><a><span>", $key, "</span></a></div>\n";
                    break;
                }
            /*case 'font': {
            echo "<div class=\"fl-l font\">";
            if ($key == 1) {
            echo "Yes";
            } else {
            echo "No";
            }
            echo "</div>\n";
            break;
            }*/
            case 'lang':{
                    echo "<div class=\"fl-l lang\"><span>";
                    switch ($key) {
                    case 0001:        // 英
                            {
                                echo "E";
                                break;
                            }
                    case 0010:        // 日
                            {
                                echo "J";
                                break;
                            }
                    case 1010:        // 简日
                            {
                                echo "CJ";
                                break;
                            }
                    case 0110:        // 繁日
                            {
                                echo "HJ";
                                break;
                            }
                    case 1110:        // 简繁日
                            {
                                echo "CHJ";
                                break;
                            }
                    case 1101:        // 简繁英
                            {
                                echo "CHE";
                                break;
                            }
                    case 1100:        // 简繁
                            {
                                echo "CH";
                                break;
                            }
                    }
                    echo "</span></div>\n";
                    break;
                }
            case 'time':{
                    echo "<div class=\"fl-l time\"><span>", $key, "</span></div>\n";
                    break;
                }
            case 'ID':{
                    echo "<div class=\"fl-l name\"><a><span>", $key, "</span></a></div>\n";
                    break;
                }
        }
    }
    echo "</div>\n";
}
echo "</div>\n\n";
?>
    </body>

</html>
