<?php
/*
主驱动类
 */
define('DEBUG',true) //调试信息输出开关
define('SYSTEM_PATH',dirname(__FILE__))
define('ROOT_PATH',substr(SYSTEM_PATH,0,-7))
define('CONTROLLER_PATH',ROOT_PATH.'/controller')i
define('MODEL_PATH',ROOT_PATH.'/model')
define('VIEW_PATH',ROOT_PATH.'/view')
class Application {
	public static function init()
	{
		require SYSTEM_PATH.'/model.php';
		require SYSTEM_PATH.'/controller.php';
	}
	public static function run($config)
	{
		self::$_config=$config['system'];
		self::init();
		
	}
}
?>
