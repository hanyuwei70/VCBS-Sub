<?php
class Usermanage_Controller extends Base_Controller
{
    /*
     * POST表单:
     * showuserid:要查看的用户id 注：寻找用户由另外一个controller实现
     * */
    private function show()
    {
        $model=new User_Model();
        //TODO:校验用户权限
        $showuserid=$_POST['showuserid'];
        $view=new Usermanage_View();
        $view->setparm("username",$model->getusername($showuserid));
        $view->setparm("usernickname",$model->getusernickname($showuserid));
        $view->setparm("userperm",$model->getuserperm($showuserid));
        //TODO:不想写了，先放在这里
    }
    /*
     * POST表单
     * do:执行的具体操作 add:添加用户 show:显示用户信息 edit:修改用户信息及权限
     * */
    public function run()
    {
        $action=$_POST['do'];
        //TODO:对$_POST做反注入过滤
        switch ($action)
        {
            case "show":
                $this->show();
                break;
        }
    }
}
?>
