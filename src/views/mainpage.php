<?php
class Mainpage_View
{
	function __construct()
	{
	}
	public function render()
	{
		$PAGE_TITLE=$this->model->PAGE_TITLE;
		require_once('tpls/mainpage.tpl');
	}
	
}
?>
