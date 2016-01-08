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
     * @return int 用户 id
     * */
    const ADDUSER_FAILED = -1;
    public function adduser($username,$password,$nickname)
    {
        try {
            $sqlstr = 'INSERT INTO sub_users (username,nickname,password) VALUES (:username,:nickname,:password)';
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(":username" => $username, ":nickname" => $nickname, ":password" => $this->pwdhash($password)));
            $sqlstr = 'SELECT id FROM sub_users WHERE username = :username';
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(":username" => $username));
            $res = $sqlcmd->fetchAll();
            if (count($res) == 0) {
                return self::ADDUSER_FAILED;
            }
            // TODO: 是否在此处完成用户权限的添加
            return $res[0]['id'];
        } catch (PDOException $e) {
            throw $e;
        }
    }
    /*
     * 删除用户
     * @param int $id 用户ID
     * @return int 结果代码
     * */
    const DELUSER_SUCCESS=0;
    const DELUSER_FAILED = -1;
    public function deluser($id)
    {
        try{
            $sqlstr="DELETE FROM sub_users WHERE id=:id";
            $sqlcmd=$this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':id' => $id));
            if ($sqlcmd->rowCount() == 0) {
                return self::DELUSER_FAILED;
            }
            return self::DELUSER_SUCCESS;
        } catch (PDOException $e) {
            throw $e;
        }
    }
    /*
     * 更改用户密码
     * @param int $id 用户ID
     * @param string $newpassword 新密码
     * @return int 结果代码
     * */
    const CHANGEPW_SUCCESS=0;
    const CHANGEPW_FAILED=1;
    public function changepw($id,$newpassword)
    {
        try {
            $sqlstr="UPDATE sub_users SET password = :password WHERE id = :id";
            $sqlcmd=$this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':password'=>$this->pwdhash($newpassword), 'id' => $id));
            if ($sqlcmd->rowCount() == 0) {
                return self::CHANGEPW_FAILED;
            }
            return self::CHANGEPW_SUCCESS;
        } catch (PDOException $e) {
            throw $e;
        }
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
        try {
            $sqlstr="SELECT id FROM sub_users WHERE username=:username";
            $sqlcmd=$this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(":username"=>$username));
            $res=$sqlcmd->fetchAll();
            if (count($res)==0) throw new UserNotFound();
            return $res[0]['id'];
        } catch (PDOException $e) {
            throw $e;
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
        try {
            $sqlstr="SELECT restricted FROM sub_users WHERE id=:id AND password=:password";
            $sqlcmd=$this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(":id"=>$id,"password"=>$this->pwdhash($password)));
            $res = $sqlcmd->fetchAll();
            if (count($res) == 0) {
                return self::CHECKPWD_DENIED;
            }
            if ($res[0]['restricted'] == 'yes') {
                return self::CHECKPWD_RESTRICTED;
            }
            return self::CHECKPWD_ACCEPTED;
        } catch (PDOException $e) {
            throw $e;
        }
    }
    /*
     * 查询用户名
     * @param int $id 用户ID
     * @return string 用户名
     * */
    public function getusername($id)
    {
        try {
            $sqlstr="SELECT username FROM sub_users WHERE id=:id";
            $sqlcmd=$this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(":id"=>$id));
            $res=$sqlcmd->fetchAll();
            if (count($res)==0) throw new UserNotFound();
            return $res[0]['username'];
        } catch (PDOException $e) {
            throw $e;
        }
    }
    /*
     * 查询用户昵称
     * @param int $id 用户ID
     * @return string 用户昵称
     * */
    public function getusernickname($id)
    {
        try {
            $sqlstr="SELECT nickname FROM sub_users WHERE id=:id";
            $sqlcmd=$this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(":id"=>$id));
            $res=$sqlcmd->fetchAll();
            if (count($res)==0) throw new UserNotFound();
            return $res[0]['nickname'];
        } catch (PDOException $e) {
            throw $e;
        }
    }
    /*
     * 权限/对象列表:
     * */
    const OBJECT_USER=1,OBJECT_USERLIST=2,OBJECT_SUB=3,OBJECT_SUBLIST=4,OBJECT_BANGUMI=5,OBJECT_BANGUMILIST=6;  //对象类型
    /*
     * 检查权限
     * @param int $id 用户ID
     * @param int $perm 待检查的权限
     * @param array $object 对象 [0]=>对象类型 [1]对象ID
     * @return int 结果
     * */
    const CHECKUSERPERM_SUCCESS=0;
    const CHECKUSERPERM_FAILED=1;
    public function checkuserperm($id,$perm,$object)
    {
        if ($id==0) return self::CHECKUSERPERM_SUCCESS;  //root用户允许任何操作

    }
    /*
     * 查询用户所拥有的权限
     * @param int $id 用户ID
     * @return array 用户拥有的权限列表
     * */
    public function getuserperm($id)
    {
        try {
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
        } catch (PDOException $e) {

        }
    }
    /**
     * 获取用户本地时间
     * @param int $id 用户ID
     * @param  TIMESTAMP $time 需要转换的UNIX时间戳
     * @param string $format 输出时间格式
     * @return string       格式化时间字符串
     */
    public function getuserlocaltime($id, $time = "now", $format = 'Y-m-d H:i:s')
    {
        try {
            $sqlstr = "SELECT timezone from sub_users WHERE user_id=:id";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(":id"=>$id));
            $res = $sqlcmd->fetchAll();
            if (count($res) == 0) throw new UserNotFound();
            $datetime = new Datetime('@'.$time);
            $datetime->setTimezone(new DateTimeZone($res[0]['timezone']));
            return $datetime->format($format);
        } catch (PDOException $e) {
            throw $e;
        } catch (UserNotFound $e) { //返回站点默认时区
            $datetime = new Datetime('@'.$time);
            $datetime->setTimezone(new DateTimeZone(DEFAULT_TIME_ZONE));
            return $datetime->format($format);
        }
    }
    /**
     * 获取用户信息
     * @param  int $id 用户ID
     * @param array $infoname 信息名称数组
     * @return array     用户信息数组，索引为设置名称
     */
    public function getuserinfo($id, $infoname)
    {
        try {
            $sqlstr = "SELECT ".implode(",", $infoname)." from sub_users WHERE user_id=:id";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(":id"=>$id));
            $res = $sqlcmd->fetchAll();
            if (count($res) == 0) throw new UserNotFound();
            return $res[0];
        } catch (PDOException $e) {
            
        } catch (UserNotFound $e) {
            
        }
    }
    /**
     * 更新用户设置选项
     * @param  int $id      用户ID
     * @param  array $updates 以信息列名为索引的数据数组
     * @return int          操作结果
     */
    public function updateuserinfo($id, $updates)
    {
        try {
            $field = array();
            $data = array(":id"=>$id);
            foreach ($updates as $key => $value) {
                $field[] = "$key=:$key";
                $data[":$key"] = $value;
            }
            $sqlstr = "UPDATE sub_users SET ".implode(",", $field)." WHERE user_id=:id";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute($data);
        } catch (PDOException $e) {
            
        }
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
