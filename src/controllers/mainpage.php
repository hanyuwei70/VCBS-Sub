<?php
class Mainpage_Controller extends Base_Controller
{
	function run()
	{
		$view=new Mainpage_View();
		$view->loadtpl('./tpl/mainpage.tpl');
		if (isset($_SESSION)) //用户已登录
		{
			$view->setparm('userid',$_SESSION['userid']);
		}
	}
}
?>
