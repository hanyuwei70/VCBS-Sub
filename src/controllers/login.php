<?php
class Login_Controller
{
	private $model;
	function __construct($mo)
	{
		$this->model=$mo;
	}
	public function login()
	{
		//TODO:反注入
		if ($_POST[username])
	}
}
?>
