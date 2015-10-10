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
			//TODO: 所有时间均使用 UNIX TIMESTAMP 此处需要修改
			$dt = date("Y-m-d H:i:s", TIMENOW);
			$sqlstr = "INSERT creator, createtime, owner, description INTO sub_bangumis VALUES (:crid, :owner, :crtime, :desc)";
			$sqlcmd = $this->dbc->prepare($sqlstr);
			$sqlcmd->execute(array(":crid" => $creatorid, ":crtime" => $dt, "owner" => $creatorid, ":desc" => $description));
			return self::CREATE_SUCCESS;
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
			$sqlstr = "DELETE FROM sub_bangumis_name WHERE bangumi_id=:id";
			$sqlcmd = $this->dbc->prepare($sqlstr);
			$sqlcmd->execute(array(':id' => $id));
			$sqlstr = "DELETE FROM sub_bangumis WHERE id=:id";
			$sqlcmd = $this->dbc->prepare($sqlstr);
			$sqlcmd->execute(array(':id' => $id));
			return self::DELBANGUMI_SUCCESS;
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
	 * @return array   名称数组 二维数组，高维为语种，低维为名称
	 */
	public function getbanguminame($id)
	{
		try {
			$sqlstr = "SELECT name, lang FROM sub_bangumis_name WHERE id = :id";
			$sqlcmd = $this->dbc->prepare($sqlstr);
			$sqlcmd->execute(array(':id' => $id));
			$name_arr = array();
			while ($row = $sqlcmd->fetch()) {
				$name_arr[$row['lang']][] = $row['name'];
			}
			return $name_arr;
		} catch (PDOException $e) {

		}
	}
	/**
	 *	addname
	 *
	 *	添加番剧名称
	 *
	 *	@param	int	$id	番剧ID
	*	@param	string	$name	要添加的番剧名
	*	@param  string  $lang  添加名称的语种
	*	@return int	操作结果
	 * */
	const ADDNAME_SUCCESS = 0;
	public function addname($id,$name,$lang)
	{
		try {
			$sqlstr = "INSERT bangumi_id, name, lang INTO sub_bangumis_name VALUES (:id, :name, :lang)";
			$sqlcmd = $this->dbc->prepare($sqlstr);
			$sqlcmd->execute(array(':id' => $id, ':name' => $name, ':lang' => $lang));
			return self::ADDNAME_SUCCESS;
		} catch (PDOException $e) {

		}
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
			$sqlstr = "SELECT name FROM sub_bangumis_name WHERE id=:id";
			$sqlcmd = $this->dbc->prepare($sqlstr);
			$sqlcmd->execute(array(':id' => $id));
			$res = $sqlcmd->fetchAll();
			if (count($res) == 1) {
				return self::DELNAME_LAST;
			}
			$sqlstr = "DELETE FROM sub_bangumis_name WHERE bangumi_id=:id AND name=:name";
			$sqlcmd = $this->dbc->prepare($sqlstr);
			$sqlcmd->execute(array(':id' => $id, ':name' => $name));
			return self::DELNAME_SUCCESS;
		} catch (PDOException $e) {

		}
	}
}
?>

