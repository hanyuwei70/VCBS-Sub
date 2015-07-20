<?php
/*
 * 约定所有类名采用统一格式
 * */
function __autoload($classname)
{
	list($filename,$suffix)=split('_',$classname);
	$filepath=SERVER_ROOT.'/models/'.strtolower($filename).'.php';
	if (file_exists($filepath))
	{
		include_once($filepath);
	}
	else
	{
		die("AUTOLOAD: $filepath NOT FOUND");
	}
}
$request=$_SERVER['QUERY_STRING'];
$parsed=explode('&',$request);
$page=array_shift($parsed);
$getVars=array();
foreach ($parsed as $argument)
{
	list($var,$val)=split('=',$argument);
	$getVars[$var]=$val;
}
$target_ctrl=SERVER_ROOT.'/controllers/'.$page.'.php';
if (file_exists($target_ctrl))
{
	include_once($target_ctrl);
	$class=$page.'_Controller';
	if (class_exists($class))
	{
		$controller=new $class;
	}
	else
	{
		die('对应的类别操作不存在');
	}
}
else
{
	die('对应的文件不存在');
}
$controller->main($getVars);
?>
