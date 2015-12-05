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
    public function testvalidid()
    {
        $subtitle = new Subtitle_Model();
        $result = $subtitle->validid(1);
        $this->assertEquals(Subtitle_Model::SUBTITLE_VALID, $result, 'Returned value error:');
        $this->setExpectedException('SubtitleNotFound');
        $result = $subtitle->validid(2);
    }
    /**
     * @depends testaddsub
     */
    public function testassocsub()
    {
        $subtitle = new Subtitle_Model();
        $name = '[科学的超电磁炮][Toaru Kagaku no Railgun][とある科学の超電磁砲][BDrip][TV 01-24+OVA Fin][ASS][SumiSora简][文件名对应VCB-S]';
        $filename = '[VCB-S]Toaru Kagaku no Railgun[1080p][ASS][SumiSora].rar';
        $subid = $subtitle->addsub($name, 2, $filename, 'chs');
        $result = $subtitle->assocsub($subid, 3);
        $this->assertEquals(Subtitle_Model::ASSOCSUB_SUCCESS, $result, 'Return value error:');
        $query = $this->getConnection()->createQueryTable('sub_subtitles', "SELECT bangumi FROM sub_subtitles WHERE id = $subid");
        $expect = new DbUnit_ArrayDataSet(array('sub_subtitles' =>array(
                                                    array('bangumi' => 3)
                                                )
                                          ));
        $this->assertTablesEqual($expect->getTable('sub_subtitles'), $query, 'Associate sub to bangumi error:');
    }
    public function testmodifydesc()
    {
        $subtitle = new Subtitle_Model();
        $descp = "四魂&异域字幕组 - After Modification";
        $result = $subtitle->modifydesc(1, $descp);
        $this->assertEquals(Subtitle_Model::MODIFYDESC_SUCCESS, $result, 'Return value error:');
        $query = $this->getConnection()->createQueryTable('sub_subtitles', "SELECT description FROM sub_subtitles WHERE id = 1");
        $expect = new DbUnit_ArrayDataSet(array('sub_subtitles' =>array(
                                                    array('description' => $descp)
                                                )
                                          ));
        $this->assertTablesEqual($expect->getTable('sub_subtitles'), $query, 'Modify description error:');
    }
    public function testgetsubname()
    {
        $subtitle = new Subtitle_Model();
        $result = $subtitle->getsubname(1);
        $expect = '[Fate/Zero][フェイト/ゼロ][BDrip][1920x1080][TV 01-25 Fin+Remix+SP][x264 FLAC MKV][ASS][四魂&異域字幕組/繁&簡體]';
        $this->assertEquals($expect, $result);
    }
}
