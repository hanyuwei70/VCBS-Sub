<?php
/*
 * 用户模型
 */
class User_Model
{
	/*
	 * 添加用户
	 * @param string $username 用户名
	 * @param string $password  密码
	 * @return int 结果代码
	 * */

	public function adduser($username,$password)
	{
	}
	/*
	 * 删除用户
	 * @param int $id 用户ID
	 * @return int 结果代码
	 * */
	public function deluser($id)
	{
	}
	/*
	 * 查询到用户id
	 * @param string $username 用户名
	 * @return int 用户ID，-1代表未找到
	 * 
	 * */
	public function getuserid($username)
	{

	}
	/*
	 * 查询用户权限
	 * @param int $id 用户ID
	 * @return array 用户权限代码 array[0]为数组长度
	 */
	public function getuserperm($id)
	{
	
	}
	/*
	 * 增加用户权限
	 * @param int $id 被设置的用户ID
	 * @param int $permid 权限ID
	 * @return int 结果代码
	 */
	public function adduserperm($id,$permid)
	{
	
	}
	/*
	 * 删除用户权限
	 * @param int $id 被设置的用户ID
	 * @param int $permid 权限ID
	 * @return int 结果代码
	 */
	public function deluserperm($id,$permid)
}
?>
