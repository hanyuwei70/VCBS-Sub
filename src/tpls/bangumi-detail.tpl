<!DOCTYPE html>
<html lang="zh" style="height:100%;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo $ICO; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $CSS_BS; ?>">
    <link rel="stylesheet" href="<?php echo $CSS_BANGUMI_D; ?>">

    <title>
        <?php echo $PAGE_TITLE; ?>
    </title>
    <!-- component template -->
    <script type="text/x-template" id="sub-list-template">
  <table>
    <thead>
      <tr>
        <th v-for="key in columns"
          @click="sortBy(key)"
          :class="{active: sortKey == key}">
          {{key | capitalize}}
          <span class="arrow"
            :class="sortOrders[key] > 0 ? 'asc' : 'dsc'">
          </span>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="
        entry in data
        | filterBy filterKey
        | orderBy sortKey sortOrders[sortKey]">
        <td v-for="key in columns">
          {{entry[key]}}
        </td>
      </tr>
    </tbody>
  </table>
</script>
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
            <input type="text" id="name" name="search" placeholder="<?php echo $TEXT_NEWS; ?>" autocapitalize="off" autocorrect="off" spellcheck="false">
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
            <div id="summary" class="col-xs-12 col-sm-8 col-md-8">
                <div><?php echo $ARR_BANGUMI['summary']; ?>
                </div>
            </div>
            <div id="sub">
  <form id="search">
    Search <input name="query" v-model="searchQuery">
  </form>
  <sub-list
    :data="gridData"
    :columns="gridColumns"
    :filter-key="searchQuery">
  </sub-list>
</div>
        </div>
    </div>
    <div id="footer">
        感谢抖M后端大力容忍。
        <p id="footer-least">© 2015 <a href="test.av">test.av</a> All rights reserved.</p>
    </div>
    <script>
        var arr_subtitle = <?php echo json_encode($ARR_SUBTITLE_LIST); ?>;
    </script>
    <script src="<?php echo $JS_JQ; ?>"></script>
    <script src="<?php echo $JS_VUE; ?>"></script>
    <script src="<?php echo $JS_DETAIL; ?>"></script>
</body>

</html>