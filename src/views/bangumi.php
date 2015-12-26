<?php
/**
 * Created by PhpStorm.
 * User: Yuwei
 * Date: 2015/9/30
 * Time: 0:00
 */
class Bangumi_View extends Base_View
{
    public function render()
    {
        foreach ($this->varlist as $key => $value) {
            $KEY = strtoupper($key);
            $$KEY = $value;
        }
        $PAGE_TITLE=$this->varlist['pagetitle'].$GLOBALS['TITLE_SUFFIX'];
        if (isset($this->varlist['errormsg'])) $ERROR_MSG=$this->varlist['errormsg'];
        include_once $this->tplpath;
    }
}
?>
