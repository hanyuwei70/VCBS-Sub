<?php
class Subtitle_Model
{
    /*
     * 添加字幕
     * 默认添加字幕不添加字幕描述，完成后请调用modifysubdesc添加
     * @param string $name 字幕标题
     * @param int $uploaderid 上传者ID
     * @param string $filename 字幕保存文件名
     * @return int 操作结果
     * */
    public function addsub($name,$uploaderid,$filename)
    {
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
            $sqlstr = "UPDATE sub_subtitles SET bangumi=:banid WHERE id=:subid";
            $sqlcmd = $this->dbc->prepare($sqlstr);
            $sqlcmd->execute(array(':subid' => $subid, ':banid' => $banid));
            return self::ASSOCSUB_SUCCESS;
        } catch (PDOException $e) {
            
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
            if (count($res) == 0) throw new SubtitleNotFound();
            return $res[0]['name'];
        } catch (PDOException $e) {
            
        }
    }
    /**
     * 删除字幕
     * @param  int $id 字幕ID
     * @return int     操作结果
     */
    public function delsub($id)
    {
    }

}
?>
