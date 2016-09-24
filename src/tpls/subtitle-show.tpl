<!DOCTYPE html>
<html>

<head>
    <?php include 'headset.tpl';?>
    <link rel="stylesheet" href="<?php echo "$CSS_ANIME";?>">
</head>

<body>
    <div id="container">
        <?php include 'navbar.tpl';?>
        <?php include 'searchbar.tpl';?>

        <div id="columns"></div>
    </div>
    <?php include 'footer.tpl';?>
    <script>
    var arr_subtitle = <?php echo json_encode($ARR_SUBTITLE);?>;
    // var arr_subtitle = <?php echo "$ARR_SUBTITLE";?>;
    </script>
    <script src="<?php echo " $JS_JQ " ?>"></script>
    <script type="text/javascript" charset="utf8" src="<?php echo " $JS_SORT " ?>"></script>
</body>

</html>