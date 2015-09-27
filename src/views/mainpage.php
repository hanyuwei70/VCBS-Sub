<?php
/*
Mainpage
*/
class Mainpage_View extends Base_View
{
	function __construct()
	{
	}
	/*
	render
	执行页面渲染输出
	*/
	public function render()
	{
        $PAGE_TITLE=$this->varlist['pagetitle'];
        if (isset($this->varlist['userid']))
        {
            $USER_NAME=$this->varlist['usernickname'];
        }
        include $this->tplpath;
	}
	
}
?>
