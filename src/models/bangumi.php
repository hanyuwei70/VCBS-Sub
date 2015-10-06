<?php
/**
 * 番剧模型类
 * TODO:SQL里面更新了一个番剧所有者，重写函数  --owner已添加，请其他人确认后添加在此处后面
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
            //TODO: 所有时间均使用 UNIX TIMESTAMP 此处需要修改
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
    const DELBANGUMI_SUCCESS=0;
	public function del($id)
	{
		try {
			$this->validid($id);
			$sqlstr = "DELETE FROM sub_bangumis WHERE id=:id";
			$sqlcmd = $this->dbc->prepare($sqlstr);
			$sqlcmd->execute(array(':id' => $id));
			$sqlstr = "DELETE FROM sub_bangumis_name WHERE bangumi_id=:id";
			$sqlcmd = $this->dbc->prepare($sqlstr);
			$sqlcmd->execute(array(':id' => $id));
			return self::DELBANGUMI_SUCCESS;
		} catch (BangumiNotFound $e) {
			throw $e;
		} catch (PDOException $e) {
			
		}
	}
	/**
	 * validid
	 *
	 * 验证番剧 id 的有效性
	 *
	 * @param  int $id 番剧ID
	 * @return int     是否有效
	 */
	const BANGUMI_VALID = 0;
	public function validid($id)
	{
		$sqlstr = "SELECT creator FROM sub_bangumis WHERE id=:id";
		$sqlcmd = $this->dbc->prepare($sqlstr);
		$sqlcmd->execute(array(':id' => $id));
		$res = $sqlcmd->fetchAll();
        if (count($res)==0) throw new BangumiNotFound();
        else return self::BANGUMI_VALID;
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
	const DELNAME_SUCCESS = 0;
	const DELNAME_LAST = 1;
	public function delname($id,$name)
	{
		try {
			$this->validid($id);
			$sqlstr = "SELECT name FROM sub_bangumis_name WHERE id=:id";
			$sqlcmd = $this->dbc->prepare($sqlstr);
			$sqlcmd->execute(array(':id' => $id));
			$res = $sqlcmd->fetchAll();
			if (count($res) == 1) { //存疑，是否要判断语种信息
				return self::DELNAME_LAST;
			}
			$sqlstr = "DELETE FROM sub_bangumis_name WHERE bangumi_id=:id AND name=:name";
			$sqlcmd = $this->dbc->prepare($sqlstr);
			$sqlcmd->execute(array(':id' => $id, ':name' => $name));
			return self::DELNAME_SUCCESS;
		} catch (BangumiNotFound $e) {
			throw $e;
		} catch (PDOException $e) {

		}
	}
}
?>

