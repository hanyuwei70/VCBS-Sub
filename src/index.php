<?php
/*
入口文件
*/
require dirname(__FILE__).'/system/app.php';
require dirname(__FILE__).'/config/config.php';
Application::run($CONFIG);
?>
