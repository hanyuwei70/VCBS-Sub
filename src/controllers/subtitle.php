<?php
class Subtitle_Controller extends Base_Controller
{
    const NUM_PER_PAGE = 50; //每页显示的数量
    function run(){
        try {
            $user = new User_Model();
            $subtitle = new Subtitle_Model();
            $view = new Subtitle_View();
            $view->loadtpl('./tpls/subtitle.tpl');
            $view->setparm('pagetitle', $TITLE_SUBTITLE . $TITLE_SUFFIX);
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
        $valid_orderkey = array('id', 'name', 'uploader', 'bangumi_id', 'uploadtime', 'status', 'lang', 'description'); // 只允许以这几个字段排序
        $valid_order = array('ASC', 'DESC');
        $start = 0;
        // TODO: $_GET 防注入，$_GET 参数转化为字幕获取条件参数
        if (isset($_GET['page'])) {
            $page = intval('0'.$_GET['page']); // 正整数转换
            $start = NUM_PER_PAGE * $page;
        }
        $sublist = $subtitle->getlist($start, NUM_PER_PAGE, $orderkey, $order);
        $view->setparm('sublist', $sublist);
        $view->render();
    }
}
?>
