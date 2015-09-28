<?php
class Login_View extends Base_View
{
	public function render()
	{
		$PAGE_TITLE=$this->varlist['pagetitle'].$TITLE_SUFFIX;
		if (isset($this->varlist['errormsg'])) $ERROR_MSG=$this->varlist['errormsg'];
		include 'tpls/login.tpl';
	}
}
?>
