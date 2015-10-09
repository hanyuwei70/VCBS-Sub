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
        try {
            $this->getuserid($username);
        }catch (UserNotFound $e) {
            $sqlstr = 'INSERT username,nickname,password INTO sub_users VALUES (:username,:nickname,:password)';
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(":username" => $username, ":nickname" => $nickname, ":password" => $this->pwdhash($password)));
            return self::ADDUSER_SUCCESS;
        }
        return self::ADDUSER_DUPLICATE;
    }
	/*
	 * 删除用户
	 * @param int $id 用户ID
	 * @return int 结果代码
	 * */
    const DELUSER_SUCCESS=0;
	public function deluser($id)
	{
        try{
            $this->getusername($id);
        }catch(UserNotFound $e){
            throw $e;
        }
        $sqlstr="DELETE FROM sub_users WHERE id=:id";
        $sqlcmd=$this->dbc->prepare($sqlstr);
        $sqlcmd->execute(array(':id' => $id));
        return self::DELUSER_SUCCESS;
	}
	/*
	 * 更改用户密码
	 * @param int $id 用户ID
	 * @param string $newpassword 新密码
	 * @return int 结果代码
	 * */
    const CHANGEPW_SUCCESS=0;
	public function changepw($id,$newpassword)
	{
        //TODO:修改密码
	}
	/*
	 * 查询到用户id
	 * @param string $username 用户名
	 * @return int 用户ID
	 * 
	 * */
	public function getuserid($username)
	{
        if (defined('DEBUG'))  //开发后台用户名直接返回 id=0
        {
            if (strcmp($username,"test")==0)
                return 0;
        }
        $sqlstr="SELECT id FROM sub_users WHERE username=:username";
        $sqlcmd=$this->dbc->prepare($sqlstr);
        $sqlcmd->execute(array(":username"=>$username));
        $res=$sqlcmd->fetchAll();
        if (count($res)==0) throw new UserNotFound();
        return $res[0]['id'];
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
        $sqlstr="SELECT COUNT(*) FROM sub_users WHERE id=:id AND password=:password";
        $sqlcmd=$this->dbc->prepare($sqlstr);
        $sqlcmd->execute(array(":id"=>$id,"password"=>$this->pwdhash($password)));
        if (count($sqlcmd->fetchAll())==0) return self::CHECKPWD_DENIED;
        //TODO:被限制用户
        return self::CHECKPWD_ACCEPTED;
	}
	/*
	 * 查询用户名
	 * @param int $id 用户ID
	 * @return string 用户名
	 * */
	public function getusername($id)
	{
        $sqlstr="SELECT username FROM sub_users WHERE id=:id";
        $sqlcmd=$this->dbc->prepare($sqlstr);
        $sqlcmd->execute(array(":id"=>$id));
        $res=$sqlcmd->fetchAll();
        if (count($res)==0) throw new UserNotFound();
        return $res[0]['username'];
	}
	/*
	 * 查询用户昵称
	 * @param int $id 用户ID
	 * @return string 用户昵称
	 * */
	public function getusernickname($id)
	{
        $sqlstr="SELECT usernickname FROM sub_users WHERE id=:id";
        $sqlcmd=$this->dbc->prepare($sqlstr);
        $sqlcmd->execute(array(":id"=>$id));
        $res=$sqlcmd->fetchAll();
        if (count($res)==0) throw new UserNotFound();
        return $res[0]['usernickname'];
	}
    /*
     * 权限列表:
     * */

    /*
     * 检查权限
     * @param int $id 用户ID
     * @param int $perm 待检查的权限
     * @return int 结果
     * */
    const CHECKUSERPERM_SUCCESS=0;
    const CHECKUSERPERM_FAILED=1;
    public function checkuserperm($id,$perm)
    {
        $userperm=$this->getuserperm($id);
        foreach ($userperm as $tperm)
        {
            if ($tperm===$perm)
                return self::CHECKUSERPERM_SUCCESS;
        }
        return self::CHECKUSERPERM_FAILED;
    }
	/*
	 * 查询用户所拥有的权限
	 * @param int $id 用户ID
	 * @return array 用户拥有的权限列表
	 * */
	public function getuserperm($id)
	{
        $sqlstr="SELECT * from sub_priviledges WHERE user_id=:id";
        $sqlcmd=$this->dbc->prepare($sqlstr);
        $sqlcmd->execute(array(":id"=>$id));
        $sqlres=$sqlcmd->fetchAll();
        $result=array();
        foreach ($sqlres as $priv)
        {
            $result[]=$priv;
        }
        return $result;
	}
	/*
	 * 更改用户所拥有的权限
	 * @param int $id 用户ID
	 * @param array $perm 用户拥有的权限列表
	 * @return int 操作结果
	 * */
	public function modifyuserperm($id,$perm)
	{
        //TODO:修改用户所拥有的权限
	}

	private function pwdhash($password) //密码hash函数
	{
        //TODO:密码hash
        return $password;
	}
}
?>
