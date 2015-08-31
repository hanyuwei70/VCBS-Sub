<html>
<head>
<meta charset="UTF-8">
<title><?php echo $PAGE_TITLE;?></title>
</head>
<body>
<div id="navbar">
	<div id="logo">
		23333
	</div>
	<div id="userinfo">
	<?php
	if (isset($USER_ID)): ?>
	欢迎，<?php echo $USER_NAME;?>	
	<?php else:?>
	未登录 请<a href="index.php?action=login">登录</a>
	<?php endif;?>
	</div>
</div>
</body>
</html>
