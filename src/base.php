<?php
class Base_Model
{
    protected $dbc;
    function __construct()
    {
        global $MYSQL_SERVER, $MYSQL_DBNAME, $MYSQL_USERNAME, $MYSQL_USERPASS;
        try {
            $this->dbc = new PDO("mysql:host=$MYSQL_SERVER;dbname=$MYSQL_DBNAME", $MYSQL_USERNAME, $MYSQL_USERPASS, array(PDO::MYSQL_ATTR_FOUND_ROWS => true)); // 对于 rowCount() 返回实际匹配的行数而不是改变的行数
            $this->dbc->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->dbc->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // 结果只以关联数组的形式表示，没有索引数组
        }
        catch(PDOException $e){
            throw new ResourceFailed($e->getMessage());
        }
    }
}
class Base_Controller
{
    //TODO:$_POST $_GET $_COOKIE全面过滤
}
class Base_View
{
    protected $varlist=array();
    protected $tplpath;
    /*
    setparm
    设定输出参数
    @param $name string 变量名
    @param $val N/A 值
    @return int 执行结果
    */
    public function setparm($name,$val)
    {
        $this->varlist[$name]=$val;
    }
    /*
     * loadtpl
     * 指定模板文件路径
     * @param $path $string 模板文件路径
     */
    public function loadtpl($path)
    {
        $this->tplpath=$path;
    }
}
?>
