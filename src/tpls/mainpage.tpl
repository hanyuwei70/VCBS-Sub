<html style="height:100%;">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php echo $PAGE_TITLE;?>
	</title>
	<link rel="stylesheet" href="main_theme_position.css">
	<!--<link rel="stylesheet" href="<?php echo $CSS_MAIN_THEME_POSITION;?>">-->
	<!--<link rel="stylesheet" href="<?php echo $CSS_MAIN_THEME_COLOR;?>">	-->
	<link rel="stylesheet" href="main_theme_color.css">
</head>

<body>
	<div id="navbar">
		<div id="logo">
			23333
		</div>
		<div id="userinfo">
			<?php if (isset($USER_ID)): ?>
				欢迎，<?php echo $USER_NAME;?>
			<?php else:?>
                未登录 请<a href="index.php?action=login">登录</a>
            <?php endif;?>
		</div>
	</div>
    <form action="index.php?action=search" method="GET" id="form" >
        <div id="search_box">
            <input type="text" id="name" name="search" placeholder="<?php echo $TETX_NEWS;?>" autocapitalize="off" autocorrect="off" spellcheck="false" >
            <!--<input type="text" id="name" name="search" placeholder="hotsearch" autocapitalize="off" autocorrect="off" spellcheck="false" >-->
            <input type="submit" id="sublime" name="submit" value="<?php echo $TETX_SUBMIT;?>" >
            <!--<input type="submit" id="sublime" name="submit" value="一发" >-->
        </div>
    </form>
    <div id="footer">
        感谢抖M后端大力容忍。
        <p id="footer-least">© 2015 <a href="test.av">test.av</a> All rights reserved.</p>
    </div>
</body>

</html>