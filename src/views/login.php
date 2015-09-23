<?php
class Login_View extends Mainpage_View
{
	function __construct()
	{
	}
	public function render()
	{
		$PAGE_TITLE=$this->model->page_title;
		require('tpls/login.tpl');
	}	
}
?>
