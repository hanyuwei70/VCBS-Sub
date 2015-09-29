<?php
/**
 * 番剧模型类
 * */
class Bangumi_Model extends Base_Model
{
	/**
	 * create
	 *
	 * 创建一个番剧
	 *
	 * @param	string	$name	番剧名
	 * @param	int		$creatroid 创建者ID
     * @param   string  $description 番剧描述
	 * @return	int	返回结果	 
	 * */
    const CREATE_SUCCESS=0;
	public function create($name,$creatorid,$description)
	{
        try {
            $sqlstr = "INSERT creator,description INTO sub_bangumis VALUES (:crid,:desc)";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(":crid" => $creatorid, ":desc" => $description));
        }catch(PDOException $e){

        }
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
}
?>

