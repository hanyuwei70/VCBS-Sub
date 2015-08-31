<?php
class Mainpage_View
{
	private $controller;
	private $model;
	function __construct($mo,$con)
	{
		$this->controller=$con;
		$this->model=$mo;	
	}
	public function render()
	{
		$PAGE_TITLE=$this->model->PAGE_TITLE;
		require_once('tpls/mainpage.tpl');
	}
	
}
?>
