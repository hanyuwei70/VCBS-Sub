<?php
/*
入口文件
 */
define('DEBUG',true); //主调试开关
require('config.php');
function autoloader($class)
{
	$name,$type=explode('_',$class);
	include 'Models/'.strtolower($name).'.php';
	include 'Controllers/'.strtolower($name).'.php';
	include 'Views/'.strtolower($name).'.php';
}
spl_autoload_register('autoloader'); //自动加载
//TODO:获取URL做路由

foreach()
?>
