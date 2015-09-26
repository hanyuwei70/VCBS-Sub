<?php
class Login_View extends Base_View
{
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
