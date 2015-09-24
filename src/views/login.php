<?php
class Login_View extends Mainpage_View
{
	private $controller,$model;
	function __construct()
	{
		$this->model=new User_Model();
		$this->controller=new Login_Controller($this->model);
	}
	public function render()
	{
		if (isset($_POST["submit"]))
		{
			$this->controller->login();
		}
		$PAGE_TITLE=$this->model->page_title;
		require('tpls/login.tpl');
	}	
}
?>
