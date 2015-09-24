<?php
/*
入口文件
 */
define('DEBUG',true); //主调试开关
require_once('config.php');
require_once('error_report.php');
require_once('base.php');
function exception_error_transfer($severity,$msg,$file,$line)
{
	if (!(error_reporting() & $severity)) return;
	throw new ErrorException($msg,0,$severity,$file,$line);
}
//set_error_handler("exception_error_transfer");
function autoloader($class)
{
	$name=explode('_',$class);
	try{
	include_once './models/'.strtolower($name[0]).'.php';
	include_once './controllers/'.strtolower($name[0]).'.php';
	include_once './views/'.strtolower($name[0]).'.php';
	}
	catch (ErrorException $e)
	{
		error_report($e);
		die();
	}
}
spl_autoload_register('autoloader'); //自动加载
//TODO:获取URL做路由
$action="mainpage"; //没有指定action时调度至mainpage
if (isset($_GET['action'])) $action=$_GET['action'];

$con=new $action();
?>

