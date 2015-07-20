<?php
/*
入口文件
 */
define('DEBUG',true); //主调试开关
require('config.php');
define("SERVER_ROOT",dirname(__FILE__));
//TODO:填入域名
define("SITE_ROOT",( isset($_SERVER['HTTPS'])===true ? 'https' : 'http')."://".(defined('DEBUG')===true?'vcbssub.dev':''));

require_once(SERVER_ROOT.'/controllers/'.'router.php');
?>
