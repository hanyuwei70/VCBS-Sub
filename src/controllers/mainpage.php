<?php
class Mainpage_Controller extends Base_Controller
{
	function run()
	{
		$view=new Mainpage_View();
		$view->loadtpl('./tpl/mainpage.tpl');

	}
}
?>
