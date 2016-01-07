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
    /**
     * 显示热门番剧
     * 接受的 GET 参数
     * page: 页数
     */
    private function show() //显示列表操作
    {
        try {
            $User = new User_Model();
            $Bangumi = new Bangumi_Model();
            $view = new Bangumi_View();
            if (isset($_SESSION)) { //用户已登录
                if ($_SESSION['expiretime'] >= time() && $_SESSION['absexpiretime'] >= time()) { //SESSION未超有效期
                    $_SESSION['expiretime'] = time() + $GLOBALS['SESSION_ADD_TIME']; //续期5min
                } else //SESSION 过期
                {
                    session_destroy();
                    throw new AuthFailed($GLOBALS['TXT_SESSION_TIMED_OUT']);
                }
                $view->setparm('userid', $_SESSION['userid']);
                $view->setparm('usernickname', $model->getusernickname($_SESSION['userid']));
            }
        } catch (AuthFailed $e) {
            
        } catch (Exception $e) {
            
        }
        $view->loadtpl('./tpls/bangumi-show.tpl');
        $view->setparm('pagetitle', $GLOBALS['TITLE_BANGUMI_SHOW']);
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
            if (isset($name_arr[$user_lang])) {
                $bang['title'] = implode(' / ', $name_arr[$user_lang]); // 只输出当前界面语言的标题
            } else {
                $bang['title'] = implode(' / ', $name_arr['main']); // 不存在匹配语种的标题时输出主标题
            }
            $bang['creatorname'] = $User->getusernickname($bang['creator']);
            $bang['ownername'] = $User->getusernickname($bang['owner']);
            $bang['createtime'] = isset($_SESSION['userid']) ? $User->getuserlocaltime($_SESSION['userid'], $bang['createtime'], 'Y-m-d') : $User->getuserlocaltime(0, $bang['createtime'], 'Y-m-d');
        }
        $view->setparm('arr_bangumi', $banglist);

        $view->render();
    }
    /**
     * 番剧详情，对应的字幕也在此页面显示
     *
     * 接受的 GET 参数
     * id: 番剧 ID
     */
    private function detail() //显示单个番剧页面操作
    {
        try {
            $User = new User_Model();
            $Bangumi = new Bangumi_Model();
            $Subtitle = new Subtitle_Model();
            $view = new Bangumi_View();
            if (isset($_SESSION)) { //用户已登录
                if ($_SESSION['expiretime'] >= time() && $_SESSION['absexpiretime'] >= time()) { //SESSION未超有效期
                    $_SESSION['expiretime'] = time() + $GLOBALS['SESSION_ADD_TIME']; //续期5min
                } else //SESSION 过期
                {
                    session_destroy();
                    throw new AuthFailed($GLOBALS['TXT_SESSION_TIMED_OUT']);
                }
                $view->setparm('userid', $_SESSION['userid']);
                $view->setparm('usernickname', $model->getusernickname($_SESSION['userid']));
            }
        } catch (AuthFailed $e) {
            
        } catch (Exception $e) {
            throw $e;
        }
        $view->loadtpl('./tpls/bangumi-detail.tpl');
        $id = intval('0'.$_GET['id']);
        try {
            $Bangumi->validid($id);
            $name_arr = $Bangumi->getbanguminame($id);
            $sublist = $Subtitle->getbangumisub($id);
            $user_lang = isset($_SESSION['userid']) ? $User->getlang($_SESSION['userid']) : DEFAULT_SITE_LANG;
            // 番剧参数设置
            $bangumi = $Bangumi->getbangumiinfo($id);
            if (isset($name_arr[$user_lang])) {
                $bangumi['title'] = implode(' / ', $name_arr[$user_lang]); // 只输出当前界面语言的标题
            } else {
                $bangumi['title'] = implode(' / ', $name_arr['main']); // 不存在匹配语种的标题时输出主标题
            }
            $bangumi['creatorname'] = $User->getusernickname($bangumi['creator']);
            $bangumi['ownername'] = $User->getusernickname($bangumi['owner']);
            $bangumi['createtime'] = isset($_SESSION['userid']) ? $User->getuserlocaltime($_SESSION['userid'], $bangumi['createtime'], 'Y-m-d') : $User->getuserlocaltime(0, $bangumi['createtime'], 'Y-m-d');
            // 字幕参数设置
            foreach ($sublist as $sub) {
                $sub['uploadtime'] = isset($_SESSION['userid']) ? $User->getuserlocaltime($_SESSION['userid'], $sub['uploadtime'], 'Y-m-d') : $User->getuserlocaltime(0, $sub['uploadtime'], 'Y-m-d');
                $sub['uploadername'] = $User->getusernickname($sub['uploader']);
            }
            $view->setparm('pagetitle', $bangumi['title']."::".$GLOBALS['TITLE_BANGUMI_DETAIL']);
            $view->setparm('arr_bangumi', $bangumi);
            $view->setparm('arr_subtitle', $sublist);
        } catch (BangumiNotFound $e) {
            $view->setparm('errormsg', $GLOBALS['ERROR_BANGUMI_NOT_FOUND']);
        } catch (Exception $e) {
            throw $e;
        }
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
        /*
         * POST表单设计：
         * do:执行的具体操作 show:显示番剧列表 add:添加番剧 modify:修改番剧 delete:删除番剧
         * 不同操作的具体表单在各自的函数注释里面定义
         * */
        switch ($_POST['do']) {
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
            case 'delete':
                $this->delete();
                break;
        }
    }
}
