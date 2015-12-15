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
     * 创建番剧时不添加番剧名，创建完成后根据返回的 bangumi id 使用 addname 添加
     *
     * @param   int     $creatroid 创建者ID
     * @param   string  $description 番剧描述
     * @return  int 番剧ID
     * */
    const CREATE_FAILED = -1;
    public function create($creatorid, $description)
    {
        try {
            $sqlstr = "INSERT INTO sub_bangumis (creator, createtime, owner, description) VALUES (:crid, :crtime, :owner, :descp)";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(":crid" => $creatorid, ":crtime" => TIMENOW, "owner" => $creatorid, ":descp" => $description));
            $sqlstr = "SELECT id FROM sub_bangumis WHERE creator = :crid and createtime = :crtime";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(":crid" => $creatorid, ":crtime" => TIMENOW));
            $res = $sqlcmd->fetchAll();
            if (count($res) == 0) {
                return self::CREATE_FAILED;
            }
            return $res[0]['id'];
        } catch (PDOException $e) {
            throw $e;
        }
    }
    /**
     * del
     *
     * 删除番剧
     *
     * @param   int $id 番剧ID
     * @return  int 操作结果
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
            throw $e;
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
        try {
            $sqlstr = "SELECT creator FROM sub_bangumis WHERE id=:id";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':id' => $id));
        } catch (PDOException $e) {
            throw $e;
        }
        $res = $sqlcmd->fetchAll();
        if (count($res)==0) {
            throw new BangumiNotFound();
        } else {
            return self::BANGUMI_VALID;
        }
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
            $sqlstr = "SELECT name, lang FROM sub_bangumis_name WHERE bangumi_id = :id";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':id' => $id));
            $name_arr = array();
            while ($row = $sqlcmd->fetch()) {
                $name_arr[$row['lang']][] = $row['name'];
            }
            return $name_arr;
        } catch (PDOException $e) {
            throw $e;
        }
    }
    /**
     *  addname
     *
     *  添加番剧名称
     *
     *  @param  int $id 番剧ID
    *   @param  string  $name   要添加的番剧名
    *   @param  string  $lang  添加名称的语种
    *   @return int 操作结果
     * */
    const ADDNAME_SUCCESS = 0;
    const ADDNAME_DUPE = 1;
    public function addname($id, $name, $lang)
    {
        try {
            $sqlstr = "SELECT COUNT(*) FROM sub_bangumis_name WHERE bangumi_id = :id AND name = :name AND lang = :lang";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':id' => $id, ':name' => $name, 'lang' => $lang));
            if ($sqlcmd->fetchColumn() > 0) {
                return self::ADDNAME_DUPE;
            }
            $sqlstr = "INSERT INTO sub_bangumis_name (bangumi_id, name, lang) VALUES (:id, :name, :lang)";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':id' => $id, ':name' => $name, ':lang' => $lang));
            return self::ADDNAME_SUCCESS;
        } catch (PDOException $e) {
            throw $e;
        }
    }
    /**
     *  delname
     *
     *  删除番剧名称，当只有最后一个名称时不允许删除
     *
     * @param   int $id 番剧ID
     * @param   string  $name   要删除的番剧名
     * @return  int 操作结果
     * */
    const DELNAME_SUCCESS = 0;
    const DELNAME_LAST = 1;
    const DELNAME_NOT_EXIST = 2;
    public function delname($id, $name)
    {
        try {
            $sqlstr = "SELECT COUNT(*) FROM sub_bangumis_name WHERE bangumi_id=:id";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':id' => $id));
            if ($sqlcmd->fetchColumn() == 1) {
                return self::DELNAME_LAST;
            }
            $sqlstr = "DELETE FROM sub_bangumis_name WHERE bangumi_id=:id AND name=:name";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':id' => $id, ':name' => $name));
            if ($sqlcmd->rowCount() == 0) {
                return self::DELNAME_NOT_EXIST;
            }
            return self::DELNAME_SUCCESS;
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function getlist($start = 0, $num = 20, $orderkey = 'hit', $order = 'DESC')
    {
        try {
            $sqlstr = "SELECT * FROM sub_bangumis ORDER BY $orderkey $order LIMIT $start, $num";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute();
            $res = $sqlcmd->fetchAll();
            return $res;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
