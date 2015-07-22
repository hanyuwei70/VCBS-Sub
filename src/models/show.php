<?php
class show_Model
{
	private $subs=array
	(
		array(
			'id'=>1,
			'title'=>'Test Title 1',
			'content'=>'Test Content 1',
			'download'=>1
		),
		array(
			'id'=>2,
			'title'=>'Test Title2',
			'content'=>'Test Content 2',
			'download'=>2
		)
	);
	public function __construct()
	{
	
	}
	public function get_sub_by_id($id)
	{
		if(!is_int($id)) return null;
		foreach ($this->subs as $nowsub)
		{
			if ($nowsub['id']===$id)
				return $nowsub;
		}
	}
}
?>
