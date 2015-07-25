<?php
/**
 * 番剧模型类
 * */
class Bangumi_Model
{
	/**
	 * create
	 *
	 * 创建一个番剧
	 *
	 * @param	string	$name	番剧名
	 * @param	int		$creatroid	创建者ID
	 * @return	int	返回结果	 
	 * */
	public function create($name,$creatorid)
	{
		
	}
	/**
	 * getid
	 *
	 * 根据番剧名找番剧ID
	 *
	 * @param	string $name	番剧名
	 * @return 	int	番剧ID,-1为未找到
	 * */
	public function getid($name)
	{
	}
	/**
	 * del
	 *
	 * 删除番剧
	 *
	 * @param	int	$id	番剧ID
	 * @return	int	操作结果
	 * */
	public function del($id)
	{

	}
	/**
	 *	addname
	 *
	 *	添加番剧名称
	 *
	 *	@param	int	$id	番剧ID
	*	@param	string	$name	要添加的番剧名
	*	@return int	操作结果
	 * */
	public function addname($id,$name)
	{
	}
	/**
	 *	delname
	 *
	 *	删除番剧名称，当只有最后一个名称时不允许删除
	 *
	 * @param	int	$id	番剧ID
	 * @param	string	$name	要删除的番剧名
	 * @return	int	操作结果
	 * */
	public function delname($id,$name)
	{
	}
	/**
	 *	changename
	 *
	 *	更改番剧名称
	 *
	 *	@param	int	$id	番剧ID
	 *	@param	string	$oldname	老番剧名
	 *	@param	string	$newname	新番剧名
	 *	@return	int	操作结果
	 * */
	public function changename($id,$oldname,$newname)
	{
	}
}
?>

