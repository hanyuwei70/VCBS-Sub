    <!DOCTYPE html>
    <html lang="zh" style="height:100%;">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="<?php echo $ICO;?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo $CSS_BS;?>">
        <link rel="stylesheet" href="<?php echo $CSS_BANGUMI;?>">

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
    <form action="index.php?action=search" method="GET" id="form">
            <div id="search_box">
                <input type="text" id="name" name="search" placeholder="<?php echo $TETX_NEWS;?>" autocapitalize="off" autocorrect="off" spellcheck="false">
            </div>
        </form>
        <div class="container">
            <div class="row">
                <?php
                foreach ($ARR_BANGUMI as $BANGUMI) {
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
        <div id="footer">
            感谢抖M后端大力容忍。
            <p id="footer-least">© 2015 <a href="test.av">test.av</a> All rights reserved.</p>
        </div>
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
