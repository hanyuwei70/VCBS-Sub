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
        $name = '[我们仍未知道那天所看见的花的名字。][AnoHana][あの日見た花の名前を僕達はまだ知らない。][1-11Fin][诸神简日[BDRip][1080p]][ASS]';
        $filename = '[我们仍未知道那天所看见的花的名字。][AnoHana][あの日見た花の名前を僕達はまだ知らない。][1-11Fin][诸神简日[BDRip][1080p]][ASS].rar';
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
        $result = $subtitle->validid(5);
    }
    public function testassocsub()
    {
        $subtitle = new Subtitle_Model();
        $result = $subtitle->assocsub(3, 3);
        $this->assertEquals(Subtitle_Model::ASSOCSUB_SUCCESS, $result, 'Return value error:');
        $query = $this->getConnection()->createQueryTable('sub_subtitles', "SELECT bangumi_id FROM sub_subtitles WHERE id = 3");
        $expect = new DbUnit_ArrayDataSet(array('sub_subtitles' =>array(
                                                    array('bangumi_id' => 3)
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
        global $baseSub;
        $subtitle = new Subtitle_Model();
        $result = $subtitle->getsubname(1);
        $expect = $baseSub[0]['name'];
        $this->assertEquals($expect, $result);
    }
    public function testgetlist()
    {
        global $baseSub;
        $subtitle = new Subtitle_Model();
        $sublist = $subtitle->getlist();
        $expect = array('0' => $baseSub[2],
                        '1' => $baseSub[1],
                        '2' => $baseSub[0],
                        );
        $this->assertEquals($expect, $sublist, 'get sub list with default param error:');
        $sublist = $subtitle->getlist(1); //test start param
        $expect = array('0' => $baseSub[1],
                        '1' => $baseSub[0],
                        );
        $this->assertEquals($expect, $sublist, 'start param test error:');
        $sublist = $subtitle->getlist(0, 1); // test num param
        $expect = array('0' => $baseSub[2]
                        );
        $this->assertEquals($expect, $sublist, 'num param test error:');
        $sublist = $subtitle->getlist(1, 2, 'bangumi_id'); // test orderkey param
        $expect = array('0' => $baseSub[1],
                        '1' => $baseSub[2],
                        );
        $this->assertEquals($expect, $sublist, 'orderkey param test error:');
        $sublist = $subtitle->getlist(0, 50, 'uploadtime', 'ASC'); //test order param
        $expect = array('0' => $baseSub[0],
                        '1' => $baseSub[1],
                        '2' => $baseSub[2],
                        );
        $this->assertEquals($expect, $sublist, 'order param test error:');
    }
    public function testgetbangumisub()
    {
        global $baseSub;
        $subtitle = new Subtitle_Model();
        $query = $subtitle->getbangumisub(1);
        $expect = array('0' => $baseSub[0],
                        '1' => $baseSub[1],
                        );
        $this->assertEquals($expect, $query, 'get sub for bangumi 1 (2 exist) failed:');
        $query = $subtitle->getbangumisub(3);
        $this->assertEmpty($query, 'get sub for bangumi 3 (sub not exist) failed:');
    }
    public function testgetuploadersub()
    {
        global $baseSub;
        $subtitle = new Subtitle_Model();
        $query = $subtitle->getuploadersub(2);
        $this->assertEmpty($query);
        $query = $subtitle->getuploadersub(1);
        $expect = array(
                    '0' => $baseSub[0],
                    '1' => $baseSub[2],
                    );
        $this->assertEquals($expect, $query);
    }
    public function testgetsubstatus()
    {
        global $baseSub;
        $subtitle = new Subtitle_Model();
        $query = $subtitle->getsubstatus(1);
        $this->assertEquals($baseSub[0]['status'], $query);
        $query = $subtitle->getsubstatus(2);
        $this->assertEquals($baseSub[1]['status'], $query);
    }
}
