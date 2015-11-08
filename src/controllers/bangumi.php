<?php
/*
 * 此Controller处理番剧页面相关，如查看，修改之类
 * 有不同意见请在下面接上 ――fulan
 *
 * TODO: add/modify 操作的表单如何输出，POST参数设计
 * */
class Bangumi_Controller extends Base_Controller
{
    private function show() //显示列表操作
    {
        $model = new Bangumi_Model;
        $view = new Bangumi_View();
        $view->loadtpl('./tpls/bangumi-show.tpl');
    }
    private function detail() //显示单个番剧页面操作
    {
        $model = new Bangumi_Model;
        $view = new Bangumi_View();
        $view->loadtpl('./tpls/bangumi-detail.tpl');
    }
    private function add() //添加操作
    {
        $model = new Bangumi_Model;
        $view = new Bangumi_View();
        $view->loadtpl('./tpls/bangumi-add.tpl');
    }
    private function modify() //修改操作
    {
        $model = new Bangumi_Model;
        $view = new Bangumi_View();
        $view->loadtpl('./tpls/bangumi-modify.tpl');
    }
    public function run()
    {
        /*
         * POST表单设计：
         * do:执行的具体操作 show:显示番剧列表 add:添加番剧 modify:修改番剧
         * 不同操作的具体表单在各自的函数注释里面定义
         * */
        switch($_POST['do'])
        {
            case 'show':
                $this->show();
                break;
            case 'detail':
                $this->detail();
                break;
            case 'add':
                $this->add();
                break;
            case 'modify':
                $this->modify();
                break;
        }
    }
}
?>
