<?php
class Mainpage_Controller extends Base_Controller
{
    function run()
    {
        $view = new Mainpage_View();
        $model = new User_Model();
        $view->loadtpl('./tpls/mainpage.tpl');
        $view->setparm('pagetitle', $GLOBALS['TITLE_MAIN_PAGE']);
        try {
            if (isset($_SESSION)) //用户已登录
            {
                if ($_SESSION['expiretime'] >= time() && $_SESSION['absexpiretime'] >= time()) //SESSION未超有效期
                {
                    $_SESSION['expiretime'] = time() + $GLOBALS['SESSION_ADD_TIME']; //续期5min
                } else //SESSION 过期
                {
                    session_destroy();
                    throw new AuthFailed($GLOBALS['TXT_SESSION_TIMED_OUT']);
                }
                $view->setparm('userid', $_SESSION['userid']);
                $view->setparm('usernickname', $model->getusernickname($_SESSION['userid']));
            }
        }catch(AuthFailed $e){
            ;
        }
        $view->render();
    }
}
?>
