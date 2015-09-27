<?php
class Base_Model
{
    private $dbc;
    function __construct()
    {
        try {
            $dbc = new PDO("mysql:host=$MYSQL_SERVER;dbname=$MYSQL_DBNAME", $MYSQL_USERNAME, $MYSQL_USERPASS);
            $dbc->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            throw new ResourceFailed($e->getMessage());
        }
    }
}
class Base_Controller
{
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