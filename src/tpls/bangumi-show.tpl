    <!DOCTYPE html>
    <html>

    <head>
        <?php include 'headset.tpl';?>
        <link rel="stylesheet" href="<?php echo $CSS_BS;?>">
        <link rel="stylesheet" href="<?php echo $CSS_BANGUMI;?>">
    </head>

    <body>
        <div id="container">
        <?php include 'navbar.tpl';?>
        <?php include 'searchbar.tpl';?>

        <div class="container">
            <div class="row">
                <?php
                foreach ($ARR_BANGUMI_LIST as $BANGUMI) {
                    echo "<div class='post-masonry col-md-4 col-sm-6'>";
                    echo "<div class='post-bangumi'>";
                    echo "<img src='$BANGUMI[cover]' alt='$BANGUMI[title]' width='100%' />";
                    echo "<div class='title-over'>";
                    echo "<h3>$BANGUMI[title]</h3>";
                    echo '</div>';
                    echo "<div class='post-hover'>";
                    echo "<div class='summary'>";
                    echo "<h1><a href='$BANGUMI[url]'>$BANGUMI[title]</a></h1>";
                    echo "<p>$BANGUMI[summary]</p>";
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                 ?>
            </div>
        </div>
        </div>
        <?php include 'footer.tpl';?>
        <script src="<?php echo $JS_JQ;?>"></script>
        <script src="<?php echo $JS_MS;?>"></script>
        <script type="text/javascript">
            $('.row').masonry({
                isAnimated: true,
                itemSelector: '.post-masonry'
            });
        </script>
    </body>

    </html>
