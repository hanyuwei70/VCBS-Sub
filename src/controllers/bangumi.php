<?php
/*
 * 此Controller处理番剧页面相关，如查看，修改之类
 * 有不同意见请在下面接上 ――fulan
 *
 * TODO: add/modify 操作的表单如何输出，POST参数设计
 * */
class Bangumi_Controller extends Base_Controller
{
    const NUM_PER_PAGE = 20;
    private function show() //显示列表操作
    {
        $view->loadtpl('./tpls/bangumi-show.tpl');
        $view->setparm('pagetitle', $TITLE_BANGUMI_SHOW . $TITLE_SUFFIX);
        $start = 0;
        // TODO: GET 参数列表处理及安全处理
        if (isset($_GET['page'])) {
            $page = intval('0'.$_GET['page']); // 正整数转换
            $start = NUM_PER_PAGE * $page;
        }
        $banglist = $Bangumi->getlist($start, NUM_PER_PAGE);
        foreach ($banglist as $bang) {
            $name_arr = $Bangumi->getbanguminame($bang['id']);
            $user_lang = isset($_SESSION['userid']) ? $User->getlang($_SESSION['userid']) : DEFAULT_SITE_LANG;
            $bang['title'] = implode(' / ', $name_arr[$user_lang]);
        }
        $view->setparm('arr_bangumi', $banglist);

        $view->render();
    }
    private function detail() //显示单个番剧页面操作
    {
        $view->loadtpl('./tpls/bangumi-detail.tpl');
    }
    private function add() //添加操作
    {
        $view->loadtpl('./tpls/bangumi-add.tpl');
    }
    private function modify() //修改操作
    {
        $view->loadtpl('./tpls/bangumi-modify.tpl');
    }
    public function run()
    {
        try {
            $User = new User_Model();
            $Bangumi = new Bangumi_Model();
            $view = new Bangumi_View();
            if (isset($_SESSION)) //用户已登录
            {
                if ($_SESSION['expiretime'] >= time() && $_SESSION['absexpiretime'] >= time()) //SESSION未超有效期
                {
                    $_SESSION['expiretime'] = time() + $SESSION_ADD_TIME; //续期5min
                } else //SESSION 过期
                {
                    session_destroy();
                    throw new AuthFailed($TXT_SESSION_TIMED_OUT);
                }
                $view->setparm('userid', $_SESSION['userid']);
                $view->setparm('usernickname', $model->getusernickname($_SESSION['userid']));
            }
            
        } catch (AuthFailed $e) {
            
        } catch (Exception $e) {
            
        }
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
