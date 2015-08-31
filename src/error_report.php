<?php
function error_report(ErrorException $e)
{
	echo 'Message:'.$e->getMessage()."<br />";
	$trace=$e->getTrace();
}
?>

