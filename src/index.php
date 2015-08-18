<?php
/*
入口文件
 */
define('DEBUG',true); //主调试开关
require('config.php');
function autoloader($class)
{
	$name=explode('_',$class);
	vardump(explode('_',$class));
	include 'models/'.strtolower($name).'.php';
	include 'controllers/'.strtolower($name).'.php';
	include 'views/'.strtolower($name).'.php';
}
spl_autoload_register('autoloader'); //自动加载
//TODO:获取URL做路由
if (!isset($_GET['action'])) //没有任何参数时调度到mainpage.php视图上
{
	
}
else
	switch ($_GET['action'])
	{
		case "user":
		default:
			echo "action error";
	}
?>
