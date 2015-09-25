<?php
class Mainpage_Controller extends Base_Controller
{
	function run()
	{
		$view=new Mainpage_View();
		$view->loadtpl('./tpl/mainpage.tpl');
		if (isset($_SESSION)) //用户已登录
		{
			if ($_SESSION['expiretime'] >= time() && $_SESSION['absexpiretime'] >= time()) //SESSION未超有效期
			{
				$_SESSION['expiretime'] = time()+$SESSION_ADD_TIME; //续期5min
			}
			else //SESSION 过期
			{
				//TODO:处理SESSION过期，并且跳出处理
			}
			$view->setparm('userid',$_SESSION['userid']);
		}
	}
}
?>
