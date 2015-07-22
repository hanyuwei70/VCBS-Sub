<?php
class show_Model
{
	public function __construct()
	{
	
	}
	private $subs=array
	(
		array(
			'id'=1,
			'title'=>'Test Title 1',
			'content'=>'Test Content 1',
			'download'=>1
		),
		array(
			'id'=2,
			'title'=>'Test Title2',
			'content'=>'Test Content 2',
			'download'=>2
		)
	)
	public function get_article_by_id($id)
	{
		if(!is_int($id)) return null;
		foreach ($subs as $nowsub)
		{
			if ($nowsub['id']===$id)
				return nowsub['id'];
		}
	}
}
?>
