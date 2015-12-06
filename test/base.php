<?php
class DbUnit_ArrayDataSet extends PHPUnit_Extensions_Database_DataSet_AbstractDataSet
{
    /**
     * @var array
     */
    protected $tables = array();

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data AS $tableName => $rows) {
            $columns = array();
            if (isset($rows[0])) {
                $columns = array_keys($rows[0]);
            }

            $metaData = new PHPUnit_Extensions_Database_DataSet_DefaultTableMetaData($tableName, $columns);
            $table = new PHPUnit_Extensions_Database_DataSet_DefaultTable($metaData);

            foreach ($rows AS $row) {
                $table->addRow($row);
            }
            $this->tables[$tableName] = $table;
        }
    }

    protected function createIterator($reverse = FALSE)
    {
        return new PHPUnit_Extensions_Database_DataSet_DefaultTableIterator($this->tables, $reverse);
    }

    public function getTable($tableName)
    {
        if (!isset($this->tables[$tableName])) {
            throw new InvalidArgumentException("$tableName is not a table in the current database.");
        }

        return $this->tables[$tableName];
    }
}
class ModelTest extends PHPUnit_Extensions_Database_TestCase
{
    static protected $pdo = null;

    protected $conn = null;
    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
        }

        return $this->conn;
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return new DbUnit_ArrayDataSet(array(
                                       'sub_users' => array(
                                            array('id' => 1, 'username' => 'ParadiseDS', 'nickname' => 'PDS', 'password' => 'passwd'),
                                            array('id' => 2, 'username' => 'Inori', 'nickname' => '祈Inori', 'password' => 'passwd'),
                                            array('id' => 3, 'username' => 'fulan', 'nickname' => '芙兰', 'password' => 'passwd'),
                                        ),
                                       'sub_bangumis' => array(
                                            array('id' => 1, 'creator' => 1, 'createtime' => strtotime('2015-12-3 03:00:00'), 'owner' => 1, 'description' => 'test bangumi 1'),
                                            array('id' => 2, 'creator' => 3, 'createtime' => strtotime('2015-12-3 04:00:00'), 'owner' => 3, 'description' => 'test bangumi 2'),
                                            array('id' => 3, 'creator' => 2, 'createtime' => strtotime('2015-12-3 05:00:00'), 'owner' => 2, 'description' => 'test bangumi 3'),
                                        ),
                                       'sub_bangumis_name' => array(
                                            array('bangumi_id' => 1, 'name' => 'Fate Zero', 'lang' => 'eng'),
                                            array('bangumi_id' => 1, 'name' => 'Fate／Zero', 'lang' => 'eng'),
                                            array('bangumi_id' => 2, 'name' => '数码兽大冒险', 'lang' => 'chs'),
                                            array('bangumi_id' => 1, 'name' => 'フェイト/ゼロ', 'lang' => 'jpn'),
                                            array('bangumi_id' => 2, 'name' => 'DIGIMON ADVENTURE', 'lang' => 'eng'),
                                            array('bangumi_id' => 2, 'name' => 'デジモンアドベンチャー', 'lang' => 'jpn'),
                                            array('bangumi_id' => 3, 'name' => '科学的超电磁炮', 'lang' => 'chs'),
                                            array('bangumi_id' => 3, 'name' => 'とある科学の超電磁砲', 'lang' => 'jpn'),
                                            array('bangumi_id' => 3, 'name' => 'Toaru Kagaku no Railgun', 'lang' => 'eng'),
                                        ),
                                       'sub_subtitles' => array(
                                            array('id' => 1, 'name' => '[Fate/Zero][フェイト/ゼロ][BDrip][1920x1080][TV 01-25 Fin+Remix+SP][x264 FLAC MKV][ASS][四魂&異域字幕組/繁&簡體]', 'uploader' => 1, 'bangumi_id' => 1, 'uploadtime' => strtotime('2015-12-3 05:00:00'), 'filename' => '[异域-11番小队][Fate_Zero][BDRIP][四魂&异域字幕].rar', 'status' => 1, 'lang' => 'mix', 'description' => '四魂&异域字幕组'),
                                            array('id' => 2, 'name' => '[Fate/Zero][フェイト/ゼロ][BDrip][TV 01-25][ass][澄空学园&魔术师工房&华盟字幕社]', 'uploader' => 3, 'bangumi_id' => 1, 'uploadtime' => strtotime('2015-12-3 07:00:00'), 'filename' => 'Fate0TV.rar', 'status' => 0, 'lang' => 'chs', 'description' => '澄空学园&魔术师工房&华盟字幕社'),
                                        ),
                                       'sub_privileges' => array(
                                            array('user_id' => 1, 'priv_num' => 503),
                                            array('user_id' => 2, 'priv_num' => 501),
                                            array('user_id' => 3, 'priv_num' => 504),
                                        ),
                                       ));
    }
}
// index.php
date_default_timezone_set('UTC'); //默认时区为UTC
define('DEBUG',true); //主调试开关
define('TIMENOW', time()); //当前 UTC 时间戳
define('DEFAULT_TIME_ZONE', 'Asia/Shanghai'); //当前站点默认时区
define('DEFAULT_SITE_LANG', 'chs'); //当前站点默认界面语言
require_once '../src/config.php';
require_once('../src/error_report.php');
require_once('../src/base.php');
require_once('../src/system/lang.php');
require_once('../src/system/exceptions.php');
