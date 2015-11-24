<?php
/*
入口文件
 */
date_default_timezone_set('UTC'); //默认时区为UTC
define('DEBUG',true); //主调试开关
define('TIMENOW', time()); //当前 UTC 时间戳
define('DEFAULT_TIME_ZONE', 'Asia/Shanghai'); //当前站点默认时区
define('DEFAULT_SITE_LANG', 'chs'); //当前站点默认界面语言
require_once('config.php');
require_once('error_report.php');
require_once('base.php');
require_once('system/lang.php');
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
    @include_once './models/'.strtolower($name[0]).'.php';
    @include_once './controllers/'.strtolower($name[0]).'.php';
    @include_once './views/'.strtolower($name[0]).'.php';
    }
    catch (ErrorException $e)
    {
        error_report($e);
        die();
    }
}
spl_autoload_register('autoloader'); //自动加载
//TODO:获取URL做路由
$action="Mainpage_Controller"; //没有指定action时调度至mainpage
if (isset($_GET['action'])) $action=$_GET['action']."_Controller"; //action指定操作调度

$con=new $action();
try{
    $con->run();
}catch(ResourceFailed $e){
}catch(Exception $e){
    if (defined('DEBUG'))
        var_dump($e->getTrace());
}
?>

