<html>
<head>
<meta charset="UTF-8" />
<title><?php echo $PAGE_TITLE?></title>
</head>
<body>
<?php echo $ERROR_MSG;?>
<form id="login-form" action="index.php?action=login" method="POST">
Username:<input type="text" name="username" /><br />
Password:<input type="password" name="password"><br />
<input type="submit" name="submit" value="登录" />
</form>
</body>
</html>
