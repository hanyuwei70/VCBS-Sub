<?php
class Login_View extends Mainpage_View
{
	private $controller,$model;
	function __construct($mo,$con)
	{
		$this->model=$mo;
		$this->controller=$con;
	}
	public function render()
	{
		$PAGE_TITLE=$this->model->page_title;
		require('tpls/login.tpl');
	}	
}
?>
