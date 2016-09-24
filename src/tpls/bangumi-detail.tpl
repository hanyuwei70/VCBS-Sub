<!DOCTYPE html>
<html>

<head>
    <?php include 'headset.tpl';?>
    <link rel="stylesheet" href="<?php echo $CSS_BS; ?>">
    <link rel="stylesheet" href="<?php echo $CSS_BANGUMI_D; ?>">
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
    <div id="container">
        <?php include 'navbar.tpl';?>
        <?php include 'searchbar.tpl';?>

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
                    <div>
                        <?php echo $ARR_BANGUMI['summary']; ?>
                    </div>
                </div>
                <div id="sub">
                    <form id="search">
                        Search <input name="query" v-model="searchQuery">
                    </form>
                    <sub-list :data="gridData" :columns="gridColumns" :filter-key="searchQuery">
                    </sub-list>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.tpl';?>
    <script>
        var arr_subtitle = <?php echo json_encode($ARR_SUBTITLE_LIST); ?>;
    </script>
    <script src="<?php echo $JS_JQ; ?>"></script>
    <script src="<?php echo $JS_VUE; ?>"></script>
    <script src="<?php echo $JS_DETAIL; ?>"></script>
</body>

</html>