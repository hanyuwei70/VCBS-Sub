<?php
class Usermanage_Controller extends Base_Controller
{
    private function show()
    {
        $model=new User_Model();
        
    }
    /*
     * POST表单
     * do:执行的具体操作 add:添加用户 show:显示用户信息 edit:修改用户信息及权限
     * */
    public function run()
    {
        $action=$_POST['do'];
        //TODO:对action做反注入过滤
        switch ($action)
        {
            case "show":
                $this->show();
                break;
        }
    }
}
?>
