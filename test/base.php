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
        global $baseUser, $baseBangumi, $baseSub, $basePerm, $baseBangumiName;
        return new DbUnit_ArrayDataSet(array(
                                       'sub_users' => $baseUser,
                                       'sub_bangumis' => $baseBangumi,
                                       'sub_bangumis_name' => $baseBangumiName,
                                       'sub_subtitles' => $baseSub,
                                       'sub_privileges' => $basePerm,
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
// global var
$baseSub = array(
                array('id' => 1, 'name' => '[Fate/Zero][フェイト/ゼロ][BDrip][1920x1080][TV 01-25 Fin+Remix+SP][x264 FLAC MKV][ASS][四魂&異域字幕組/繁&簡體]', 'uploader' => 1, 'bangumi_id' => 1, 'uploadtime' => strtotime('2015-12-3 05:00:00'), 'filename' => '[异域-11番小队][Fate_Zero][BDRIP][四魂&异域字幕].rar', 'status' => 1, 'lang' => 'mix', 'description' => '四魂&异域字幕组'),
                array('id' => 2, 'name' => '[Fate/Zero][フェイト/ゼロ][BDrip][TV 01-25][ass][澄空学园&魔术师工房&华盟字幕社]', 'uploader' => 3, 'bangumi_id' => 1, 'uploadtime' => strtotime('2015-12-3 07:00:00'), 'filename' => 'Fate0TV.rar', 'status' => 0, 'lang' => 'chs', 'description' => '澄空学园&魔术师工房&华盟字幕社'),
                array('id' => 3, 'name' => '[科学的超电磁炮][Toaru Kagaku no Railgun][とある科学の超電磁砲][BDrip][TV 01-24+OVA Fin][ASS][SumiSora简][文件名对应VCB-S]', 'uploader' => 1, 'bangumi_id' => 0, 'uploadtime' => strtotime('2015-12-3 09:00:00'), 'filename' => '[VCB-S]Toaru Kagaku no Railgun[1080p][ASS][SumiSora].rar', 'status' => 0, 'lang' => 'chs', 'description' => '[SumiSora][文件名对应VCB-S]'),
            );
$baseBangumi = array(
                    array('id' => 1, 'creator' => 1, 'createtime' => strtotime('2015-12-3 03:00:00'), 'owner' => 1, 'description' => 'test  bangumi 1', 'hit' => '5', 'cover' => 'covers/001.jpg'),
                    array('id' => 2, 'creator' => 3, 'createtime' => strtotime('2015-12-3 04:00:00'), 'owner' => 3, 'description' => 'test  bangumi 2', 'hit' => '0', 'cover' => NULL),
                    array('id' => 3, 'creator' => 2, 'createtime' => strtotime('2015-12-3 05:00:00'), 'owner' => 2, 'description' => 'test  bangumi 3', 'hit' => '3', 'cover' => 'http://static.mengniang.org/common/thumb/4/46/Toaru_Kagaku_no_Railgun_2.jpg/800px-Toaru_Kagaku_no_Railgun_2.jpg'),
                );
$baseUser = array(
                array('id' => 1, 'username' => 'ParadiseDS', 'nickname' => 'PDS', 'password' => 'passwd', 'restricted' => 'no'),
                array('id' => 2, 'username' => 'Inori', 'nickname' => '祈Inori', 'password' => 'passwd', 'restricted' => 'no'),
                array('id' => 3, 'username' => 'fulan', 'nickname' => '芙兰', 'password' => 'passwd', 'restricted' => 'yes'),
            );
$basePerm = array(
                array('user_id' => 1, 'priv_num' => 503),
                array('user_id' => 2, 'priv_num' => 501),
                array('user_id' => 3, 'priv_num' => 504),
            );
$baseBangumiName = array(
                        array('bangumi_id' => 1, 'name' => 'Fate Zero', 'lang' => 'eng', 'main' => 'no'),
                        array('bangumi_id' => 1, 'name' => 'Fate／Zero', 'lang' => 'eng', 'main' => 'yes'),
                        array('bangumi_id' => 2, 'name' => '数码兽大冒险', 'lang' => 'chs', 'main' => 'no'),
                        array('bangumi_id' => 1, 'name' => 'フェイト/ゼロ', 'lang' => 'jpn', 'main' => 'no'),
                        array('bangumi_id' => 2, 'name' => 'DIGIMON ADVENTURE', 'lang' => 'eng', 'main' => 'no'),
                        array('bangumi_id' => 2, 'name' => 'デジモンアドベンチャー', 'lang' => 'jpn', 'main' => 'no'),
                        array('bangumi_id' => 3, 'name' => '科学的超电磁炮', 'lang' => 'chs', 'main' => 'no'),
                        array('bangumi_id' => 3, 'name' => 'Toaru Kagaku no Railgun', 'lang' => 'eng', 'main' => 'no'),
                    );
