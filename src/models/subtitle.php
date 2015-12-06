<?php
class Subtitle_Model extends Base_Model
{
    /*
     * 添加字幕
     * 调用时需检查 name 和 filename 长度，数据类型为 VARCHAR(100)
     * 默认添加字幕不添加字幕描述，完成后请调用 modifydesc 添加
     * 默认不关联番剧，完成后请调用 assocsub 关联
     * @param string $name 字幕标题
     * @param int $uploaderid 上传者ID
     * @param string $filename 字幕保存文件名
     * @return int 字幕id / 操作结果
     * */
    const ADD_FAILED = -1;
    public function addsub($name,$uploaderid,$filename,$lang)
    {
        //TODO: 文件操作
        try {
            $sqlstr = "INSERT INTO sub_subtitles (name, uploader, uploadtime, filename, lang) VALUES (:name, :uploader, :uploadtime, :filename, :lang)";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':name' => $name, ':uploader' => $uploaderid, ':uploadtime' => TIMENOW, ':filename' => $filename, ':lang' => $lang));
            $sqlstr = "SELECT id FROM sub_subtitles WHERE name = :name and uploadtime = :uploadtime";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':name' => $name, ':uploadtime' => TIMENOW));
            $res = $sqlcmd->fetchAll();
            if (count($res) == 0) {
                return self::ADD_FAILED;
            }
            return $res[0]['id'];
        } catch (PDOException $e) {
            throw $e;
        }
    }
    const SUBTITLE_VALID = 0;
    /**
     * 验证字幕 id 是否存在
     * @param  int $id 待验证字幕ID
     * @return int     有效性结果
     */
    public function validid($id)
    {
        try {
            $sqlstr = "SELECT name FROM sub_subtitles WHERE id=:id";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':id' => $id));
        } catch (PDOException $e) {
            throw $e;
        }
        $res = $sqlcmd->fetchAll();
        if (count($res)==0) {
            throw new SubtitleNotFound();
        } else {
            return self::SUBTITLE_VALID;
        }
    }
    /*
     * 关联字幕和番剧
     * @param int $subid 字幕ID
     * @param int $banid 番剧ID
     * @return int 操作结果
     * */
    const ASSOCSUB_SUCCESS = 0;
    public function assocsub($subid,$banid)
    {
        try {
            $sqlstr = "UPDATE sub_subtitles SET bangumi_id=:banid WHERE id=:subid";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':subid' => $subid, ':banid' => $banid));
            return self::ASSOCSUB_SUCCESS;
        } catch (PDOException $e) {
            throw $e;
        }
    }
    /*
     * 更改字幕描述
     * @param int $id 字幕ID
     * @param string $desc 字幕描述
     * @return int  操作结果
     * */
    const MODIFYDESC_SUCCESS = 0;
    public function modifydesc($id,$desc)
    {
        try {
            $sqlstr = "UPDATE sub_subtitles SET description=:desc WHERE id=:id";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':desc' => $desc, ':id' => $id));
            return self::MODIFYDESC_SUCCESS;
        } catch (PDOException $e) {
            throw $e;
        }
    }
    /*
     * 查询字幕名称
     * @param int $id 字幕ID
     * @return string 字幕名称
     * */
    public function getsubname($id)
    {
        try {
            $sqlstr = "SELECT name FROM sub_subtitles WHERE id=:id";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':id' => $id));
            $res = $sqlcmd->fetchAll();
            return $res[0]['name'];
        } catch (PDOException $e) {
            throw $e;
        }
    }
    /**
     * 按照条件获取字幕记录
     * @param  array $cond 条件参数组成的索引数组
     * @param string $and_or cond 连接条件
     * @param  string $orderkey 排序使用的列名
     * @param  int $order  升序=1，降序=0，默认降序
     * @param int $start   获取记录的起始偏移
     * @param  int $num    获取记录的数量限制
     * @return array       字幕记录索引数组，每条记录由一条索引数组表示
     */
    public function getlist($start = 0, $num = 50, $orderkey = 'uploadtime', $order = 'DESC')
    {
        try {
            $sqlstr = "SELECT * FROM sub_subtitles ORDER BY $orderkey $order LIMIT $start, $num";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute();
            $res = $sqlcmd->fetchAll();
            return $res;
        } catch (PDOException $e) {
            throw $e;
        }
    }
    /**
     * 获取某番剧的字幕列表
     * @param  int $id 番剧 ID
     * @return array     字幕记录索引数组
     */
    public function getbangumisub($banid)
    {
        try {
            $sqlstr = "SELECT * FROM sub_subtitles WHERE bangumi_id = :bangumi_id";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':bangumi_id' => $banid));
            return $sqlcmd->fetchAll();
        } catch (PDOException $e) {
            throw $e;
        }
    }
    /**
     * 获取某用户上传的所有字幕列表
     * @param  int $userid 用户 id
     * @return array         字幕记录索引数组
     */
    public function getuploadersub($userid)
    {
        try {
            $sqlstr = "SELECT * FROM sub_subtitles WHERE uploaderid = :uploaderid";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':uploaderid' => $userid));
            return $sqlcmd->fetchAll();
        } catch (PDOException $e) {
            throw $e;
        }
    }
    /**
     * 获取字幕状态
     * @param  int $id 字幕 ID
     * @return int     字幕状态码
     */
    public function getsubstatus($id)
    {
        try {
            $sqlstr = "SELECT status FROM sub_subtitles WHERE id=:id";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':id' => $id));
            $res = $sqlcmd->fetchAll();
            return $res[0]['name'];
        } catch (PDOException $e) {
            throw $e;
        }
    }
    /**
     * 删除字幕
     * @param  int $id 字幕ID
     * @return int     操作结果
     */
    const DEL_SUCCESS = 0;
    const DEL_FAILED = 1;
    public function delsub($id)
    {
        //TODO:文件操作
        try {
            $sqlstr = "DELETE FROM sub_subtitles WHERE id = :id";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':id' => $id));
            if ($sqlcmd->rowCount() == 0) {
                return self::DEL_FAILED;
            }
            return self::DEL_SUCCESS;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
?>
