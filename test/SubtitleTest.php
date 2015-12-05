<?php
require_once 'phpunit.xml';
require_once 'base.php';

require_once '../src/base.php';
require_once '../src/models/subtitle.php';

class Subtitle_ModelTest extends ModelTest
{
    //ADD_FAILED 返回未测试
    public function testaddsub()
    {
        $subtitle = new Subtitle_Model();
        $queryCount = $this->getConnection()->getRowCount('sub_subtitles');
        $name = '[科学的超电磁炮][Toaru Kagaku no Railgun][とある科学の超電磁砲][BDrip][TV 01-24+OVA Fin][ASS][SumiSora简][文件名对应VCB-S]';
        $filename = '[VCB-S]Toaru Kagaku no Railgun[1080p][ASS][SumiSora].rar';
        $subid = $subtitle->addsub($name, 2, $filename, 'chs');
        $queryCountAfter = $this->getConnection()->getRowCount('sub_subtitles');
        $this->assertEquals(1, $queryCountAfter-$queryCount, 'Failed to create a new record:');
        $query = $this->getConnection()->createQueryTable('sub_subtitles', 'SELECT id, name, filename, lang FROM sub_subtitles ORDER BY id DESC LIMIT 1');
        $expect = new DbUnit_ArrayDataSet(array(
                                                'sub_subtitles' => array(
                                                    array('id' => $subid, 'name' => $name, 'filename' => $filename, 'lang' => 'chs'),
                                                )
                                          ));
        $this->assertTablesEqual($expect->getTable('sub_subtitles'), $query, 'Content after add do not match expection:');
        $this->setExpectedException('PDOException'); // Duplicate Name Test
        $subid = $subtitle->addsub($name, 1, $filename, 'chs');
    }
}
