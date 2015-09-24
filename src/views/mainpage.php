<?php
class Mainpage_View
{
	private $controller;
	private $model;
	function __construct()
	{
		$model=new Mainpage_Model();
		$controller=new Mainpage_Controller($model);
	}
	public function render()
	{
		$PAGE_TITLE=$this->model->PAGE_TITLE;
		require_once('tpls/mainpage.tpl');
	}
	
}
?>
