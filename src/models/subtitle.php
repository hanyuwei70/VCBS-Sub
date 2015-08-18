<?php
class Subtitle_Model
{
	/*
	 * 添加字幕
	 * 默认添加字幕不添加字幕描述，完成后请调用
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
	public function assocsub($subid,$banid)
	{
	}
	/*
	 * 更改字幕描述
	 * @param int $id 字幕ID
	 * @param string $desc 字幕描述 
	 * */
	public function modifydesc($id,$desc)
	{
	}
	/*
	 * 查询字幕ID
	 * @param string $name 字幕名称
	 * @return int 字幕ID
	 * */
	public function getsubid($name)
	{
	}
	/*
	 * 查询字幕名称
	 * @param int $id 字幕ID
	 * @return string 字幕名称
	 * */
	public function getsubname($id)
	{
	}

}
?>
