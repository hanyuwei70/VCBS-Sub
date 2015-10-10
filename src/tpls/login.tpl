<!DOCTYPE html>
<html>

<head>
  <meta lang="zh_CN">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--这是响应式的基础-->
  <link rel="stylesheet" href="login.css">
  <title>
    <?php echo $PAGE_TITLE?>
  </title>
</head>

<body style="background-image: url($BG_LOGIN);">
  <?php echo $ERROR_MSG;?>
    <div id="passbox">
      <form id="login-form" action="../index.php?action=login" method="POST" autocomplete="off">
          <input type="text" id="name" placeholder="$TETX_NAME" name="username" autofocus="">
          <input type="password" id="password" placeholder="$TEXT_PW" name="password">
        <input type="submit" id="submit" name="submit" value="G O">
      </form>
    </div>
</body>

</html>
