<?php
/*
 * 用户模型
 */
class User_Model extends Base_Model
{
	/*
	 * 添加用户
	 * @param string $username 用户名
	 * @param string $password  密码
	 * @param string $nickname 用户昵称
	 * @return int 结果代码
	 * */
	const ADDUSER_SUCCESS=0;
	const ADDUSER_DUPLICATE=1;
	public function adduser($username,$password,$nickname)
	{
		$sqlstr='SELECT * FROM sub_users where username=:username';
		$sqlcmd=$dbc->prepare($sqlstr);
		$sqlcmd->execute(array(':username'=>$username));
		if ($sqlcmd->columnCount()!=0)
			return self::ADDUSER_DUPLICATE;
		$sqlstr='INSERT username,nickname,password INTO sub_users VALUES (:username,:nickname,:password)';
		$sqlcmd=$dbc->prepare($sqlstr);
		$sqlcmd->execute(array(":username"=>$username,":nickname"=>$nickname,":password"=>$this->pwdhash($password)));
        return self::ADDUSER_SUCCESS;
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
	 * 更改用户密码
	 * @param int $id 用户ID
	 * @param string $newpassword 新密码
	 * @return int 结果代码
	 * */
	public function changepw($id,$newpassword)
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
        if (defined('DEBUG'))  //开发后台用户名直接返回 id=0
        {
            if (strcmp($username,"test")==0)
                return 0;
        }
	}
	/*
	 * 检查用户ID/密码组合是否正确
	 * @param int $id 用户ID
	 * @param string $password 密码
	 * @return int 检查结果
	 * */
    const CHECKPWD_ACCEPTED=0;
    const CHECKPWD_DENIED=1;
    const CHECKPWD_RESTRICTED=2;
	public function checkpassword($id,$password)
	{
		if (defined('DEBUG'))
		{
			if ($id===0 && strcmp($password,"test")==0) //开发后台用户，发布时关闭DEBUG
				return self::CHECKPWD_ACCEPTED;
		}
	}
	/*
	 * 查询用户名
	 * @param int $id 用户ID
	 * @return string 用户名
	 * */
	public function getusername($id)
	{
	}
	/*
	 * 查询用户昵称
	 * @param int $id 用户ID
	 * @return string 用户昵称
	 * */
	public function getusernickname($id)
	{
	}
	/*
	 * 查询用户所拥有的权限
	 * @param int $id 用户ID
	 * @return array 用户拥有的权限列表
	 * */
	public function getuserperm($id)
	{
	}
	/*
	 * 更改用户所拥有的权限
	 * @param int $id 用户ID
	 * @param array $perm 用户拥有的权限列表
	 * */
	public function modifyuserperm($id,$perm)
	{
	}

	private function pwdhash($password) //密码hash函数
	{
        return $password;
	}
}
?>
