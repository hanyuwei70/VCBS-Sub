<?php
/*
 * 登录POST表单
 * username:用户名 password:密码 captcha:验证码 vaildtime:允许SESSION有效的最后期限
 * */
class Login_Controller extends Base_Controller
{
	public function run()
	{
        $m_user=new User_Model();
		//TODO:反注入
        //TODO:验证码
        try {
            if (isset($_POST['username'])) {
                $userid = $m_user->getuserid($_POST['username']);
                switch ($m_user->checkpassword($userid, $_POST['password'])) {
                    case $m_user::CHECKPWD_ACCEPTED:
                        session_start();
                        $_SESSION['userid'] = $userid;
                        $_SESSION['expiretime'] = time() + $SESSION_ADD_TIME;
                        $_SESSION['absexpiretime'] = time() + $_POST['vaildtime'];
                        break;
                    case $m_user::CHECKPWD_DENIED:
                        throw new AuthFailed($TXT_PASSWORD_ERROR);
                        break;
                    case $m_user::CHECKPWD_RESTRICTED:
                        throw new AuthFailed($TXT_USER_RESTRICTED);
                }
            }
        }
        catch(AuthFailed $e){

        }
	}
}
?>
