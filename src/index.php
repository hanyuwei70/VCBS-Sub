<?php
/*
入口文件
 */
define('DEBUG',true); //主调试开关
require('config.php');
function autoloader($class)
{
	$name=explode('_',$class);
	include './models/'.strtolower($name[0]).'.php';
	include './controllers/'.strtolower($name[0]).'.php';
	include './views/'.strtolower($name[0]).'.php';
}
spl_autoload_register('autoloader'); //自动加载
//TODO:获取URL做路由
if (!isset($_GET['action'])) //没有任何参数时调度到mainpage.php视图上
{
	$mp_m=new Mainpage_Model();
	$mp_c=new Mainpage_Controller($mp_m);
	$mp_v=new Mainpage_View($mp_m,$mp_c);		
	$mp_v->render();
}
else
	switch ($_GET['action'])
	{
		case "user":
		default:
			echo "action error";
	}
?>

