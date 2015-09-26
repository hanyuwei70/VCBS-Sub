<?php
/*
Mainpage
*/
class Mainpage_View extends Base_View
{
	private $varlist=array();
    private $tplpath;
	function __construct()
	{
	}
	/*
	 * loadtpl
	 * 指定模板文件路径
	 * @param $path $string 模板文件路径
	 */
	public function loadtpl($path)
	{
        $this->tplpath=$path;
	}
	/*
	setparm
	设定输出参数
	@param $name $string 变量名
	@param $val N/A 值
	@return $int 执行结果
	*/
	public function setparm($name,$val)
	{
		$this->varlist[$name]=$val;
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
