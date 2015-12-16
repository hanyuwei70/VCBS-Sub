<?php
class Subtitle_Controller extends Base_Controller
{
    const NUM_PER_PAGE = 50; //每页显示的数量
    /**
     * 全部字幕列表
     * 接受的GET参数
     * page: 页数
     * orderkey: 排序方式，允许的值参考 $valid_orderkey
     * order: 升降序，取值 ASC / DESC
     * 默认按照上传时间降序排列
     */
    private function show()
    {
        $valid_orderkey = array('name', 'uploader', 'bangumi_id', 'uploadtime', 'status', 'lang', 'description'); // 只允许以这几个字段排序
        $valid_order = array('ASC', 'DESC');
        // 默认值
        $start = 0;
        $orderkey = 'uploadtime';
        $order = 'DESC';
        // TODO: $_GET 防注入，$_GET 参数转化为字幕获取条件参数
        if (isset($_GET['page'])) {
            $page = intval('0'.$_GET['page']); // 正整数转换
            $start = NUM_PER_PAGE * $page;
        }
        if (isset($_GET['orderkey'])) {
            if (in_array($_GET['orderkey'], $valid_orderkey)) {
                $orderkey = $_GET['orderkey'];
            }
        }
        if (isset($_GET['order'])) {
            if (in_array($_GET['order'], $valid_order)) {
                $order = $_GET['order'];
            }
        }
        $sublist = $subtitle->getlist($start, NUM_PER_PAGE, $orderkey, $order);
        $view->setparm('sublist', $sublist);
        $view->render();
    }
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
        // 用 do 来区分对于字幕的不同操作
        // show: 显示所有字幕列表
        // add: 上传字幕
        // modify: 修改字幕
        // delete: 删除字幕
        switch($_GET['do'])
        {
            case 'show':
                $this->show();
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
?>
