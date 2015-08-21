<?php
class Mainpage_View
{
	private $controller;
	private $model;
	function __construct($con,$mo)
	{
		$this->controller=$con;
		$this->model=$mo;	
	}
	public function render()
	{
		require_once('tpls/mainpage.tpl');
	}
	
}
?>
