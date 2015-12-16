<?php
/*
 * 登录POST表单
 * username:用户名 password:密码 captcha:验证码 vaildtime:允许SESSION有效的最后期限
 * */
class Login_Controller extends Base_Controller
{
    public function run()
    {
        if (isset($_SESSION)) //用户已登陆，跳转到主页
        {
            if ($_SESSION['expiretime'] >= time() && $_SESSION['absexpiretime'] >= time()) //SESSION未超有效期
            {
                $_SESSION['expiretime'] = time() + $GLOBALS['SESSION_ADD_TIME']; //续期5min
                header("Location: " . $GLOBALS['MAIN_PAGE_URL']);
                exit;
            }
        }
        try {
            $m_user = new User_Model();
            $view = new Login_View();
            $view->setparm('pagetitle',$GLOBALS['TITLE_USER_LOGIN']);
            //TODO:反注入
            //TODO:验证码
            try {
                if (isset($_POST['username'])) {
                    $userid = $m_user->getuserid($_POST['username']);
                    switch ($m_user->checkpassword($userid, $_POST['password'])) {
                        case $m_user::CHECKPWD_ACCEPTED:
                            session_start();
                            $_SESSION['userid'] = $userid;
                            $_SESSION['expiretime'] = time() + $GLOBALS['SESSION_ADD_TIME'];
                            $_SESSION['absexpiretime'] = time() + $_POST['vaildtime'];
                            header("Location: " . $GLOBALS['MAIN_PAGE_URL']);
                            break;
                        case $m_user::CHECKPWD_DENIED:
                            throw new AuthFailed($GLOBALS['TXT_PASSWORD_ERROR']);
                            break;
                        case $m_user::CHECKPWD_RESTRICTED:
                            throw new AuthFailed($TXT_USER_RESTRICTED);
                    }
                }
            } catch (AuthFailed $e) {
                $view->setparm('errormsg', $e->getMessage());
            }
        }
        catch(ResourceFailed $e){
            $view->setparm('errormsg',$e->getMessage());
        }
        $view->render();
    }
}
?>
