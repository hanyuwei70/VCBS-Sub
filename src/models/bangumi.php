<?php
/**
 * 番剧模型类
 * TODO:SQL里面更新了一个番剧所有者，重写函数
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
        	$dt = date("Y-m-d H:i:s", TIMENOW);
            $sqlstr = "INSERT creator, createtime, owner, description INTO sub_bangumis VALUES (:crid, :owner, :crtime, :desc)";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(":crid" => $creatorid, ":crtime" => $dt, "owner" => $creatorid, ":desc" => $description));
        }catch(PDOException $e){

        }
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
		try {
			//TODO; is_valid_id
			//是否需要一个BangumiNotFound异常
		} catch (Exception $e) {
			
		}
		try {
			$sqlstr = "DELETE FROM sub_bangumis WHERE id=:id";
			$sqlcmd = $this->dbc->prepare($sqlstr);
			$sqlcmd->execute(array(':id' => $id));
		} catch (PDOException $e) {
			
		}
		try {
			$sqlstr = "DELETE FROM sub_bangumis_name WHERE bangumi_id=:id";
			$sqlcmd = $this->dbc->prepare($sqlstr);
			$sqlcmd->execute(array(':id' => $id));
		} catch (PDOException $e) {
			
		}
	}
	/**
	 * getbanguminame
	 *
	 * 获取番剧名称
	 *
	 * @param  int $id 番剧
	 * @return array   名称数组
	 */
	public function getbanguminame($id)
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

