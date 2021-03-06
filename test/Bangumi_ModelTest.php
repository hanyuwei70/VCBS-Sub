<?php
require_once 'phpunit.xml';
require_once 'base.php';

require_once '../src/base.php';
require_once '../src/models/bangumi.php';

class Bangumi_ModelTest extends ModelTest
{
    // CREATE_FAILED 返回未测试
    public function testcreate()
    {
        $bangumi = new Bangumi_Model();
        $queryCount = $this->getConnection()->getRowCount('sub_bangumis');
        $id = $bangumi->create(2, 'test description');
        $queryCountAfter = $this->getConnection()->getRowCount('sub_bangumis');
        $this->assertEquals(1, $queryCountAfter-$queryCount, 'Failed to create new record:');
        $query = $this->getConnection()->createQueryTable('sub_bangumis', 'SELECT * FROM sub_bangumis ORDER BY id DESC LIMIT 1');
        $expect = new DbUnit_ArrayDataSet(array(
                                            'sub_bangumis' => array(
                                                array('id' => $id, 'creator' => 2, 'createtime' => TIMENOW, 'owner' => 2, 'description' => 'test description', 'hit' => 0, 'cover' => NULL),
                                            )
                                          ));
        $this->assertTablesEqual($expect->getTable('sub_bangumis'), $query, 'Content after create do not match expection:');
    }

    public function testdel()
    {
        $bangumi = new Bangumi_Model();
        $queryCount = $this->getConnection()->getRowCount('sub_bangumis');
        $rtn = $bangumi->del(2);
        $queryCountAfter = $this->getConnection()->getRowCount('sub_bangumis');
        $this->assertEquals(-1, $queryCountAfter-$queryCount, 'Failed to del a exist record:');
        $query = $this->getConnection()->createQueryTable('sub_bangumis', 'SELECT id FROM sub_bangumis ORDER BY id');
        $expect = new DbUnit_ArrayDataSet(array(
                                            'sub_bangumis' => array(
                                                array('id' => 1),
                                                array('id' => 3),
                                            ),
                                          ));
        $this->assertTablesEqual($expect->getTable('sub_bangumis'), $query);
    }

    public function testgetbanguminame()
    {
        $bangumi = new Bangumi_Model();
        $query = $bangumi->getbanguminame(1);
        $expect = array('eng' => array('Fate Zero', 'Fate／Zero'), 'jpn' => array('フェイト/ゼロ'), 'main' => array('Fate／Zero'));
        $this->assertEquals($expect, $query, 'Bangumi name result error:');
    }

    public function testvalidid()
    {
        $bangumi = new Bangumi_Model();
        $result = $bangumi->validid(2);
        $this->assertEquals(Bangumi_Model::BANGUMI_VALID, $result, 'Returned value error:');
        $this->setExpectedException('BangumiNotFound');
        $result = $bangumi->validid(0);
    }
    /**
     * Test for Add name method
     * @depends testgetbanguminame
     */
    public function testaddname()
    {
        $bangumi = new Bangumi_Model();
        $result = $bangumi->addname(2, '数码宝贝', 'chs');
        $this->assertEquals(Bangumi_Model::ADDNAME_SUCCESS, $result, 'Returned value error:');
        $name_arr = $bangumi->getbanguminame(2);
        $expect = array('chs' => array('数码兽大冒险', '数码宝贝'),
                        'eng' => array('DIGIMON ADVENTURE'),
                        'jpn' => array('デジモンアドベンチャー'),
                        );
        $this->assertEquals($expect, $name_arr, 'Content after add do not match expection:');
        $result = $bangumi->addname(1, 'Fate Zero', 'eng');
        $this->assertEquals(Bangumi_Model::ADDNAME_DUPE, $result, 'Returned value error when add dupe name:');
        $result = $bangumi->addname(3, 'とある科学の超電磁砲', 'jpn', true);
        $name_arr = $bangumi->getbanguminame(3);
        $expect = array('chs' => array('科学的超电磁炮'),
                        'eng' => array('Toaru Kagaku no Railgun'),
                        'jpn' => array('とある科学の超電磁砲'),
                        'main' => array('とある科学の超電磁砲'),
                        );
        $this->assertEquals($expect, $name_arr, 'Content after add main title do not match expection:');
    }
    /**
     * Test for Del name method
     * @depends testgetbanguminame
     */
    public function testdelname()
    {
        $bangumi = new Bangumi_Model();
        $result = $bangumi->delname(2, '数码兽大冒险');
        $this->assertEquals(Bangumi_Model::DELNAME_SUCCESS, $result, 'Returned value error:');
        $name_err = $bangumi->getbanguminame(2);
        $expect = array('eng' => array('DIGIMON ADVENTURE'),
                        'jpn' => array('デジモンアドベンチャー'),
                        );
        $this->assertEquals($expect, $name_err, 'Content after del do not match expection:');
        $result = $bangumi->delname(2, '数码兽大冒险');
        $this->assertEquals(Bangumi_Model::DELNAME_NOT_EXIST, $result, 'Returned value error when del nonexist name:');
        $result = $bangumi->delname(2, 'DIGIMON ADVENTURE');
        $result = $bangumi->delname(2, 'デジモンアドベンチャー');
        $this->assertEquals(Bangumi_Model::DELNAME_LAST, $result, 'Returned value error when del last name:');
        $result = $bangumi->delname(1, 'Fate／Zero');
        $this->assertEquals(Bangumi_Model::DELNAME_LAST_MAIN, $result, 'Returned value error when del last main name');
    }
    public function testgetlist()
    {
        global $baseBangumi;
        $bangumi = new Bangumi_Model();
        $banglist = $bangumi->getlist();
        $expect = array($baseBangumi[0], $baseBangumi[2], $baseBangumi[1]);
        $this->assertEquals($expect, $banglist, 'get bangumi list with default param error:');
        $banglist = $bangumi->getlist(1); // test start param
        $expect = array($baseBangumi[2], $baseBangumi[1]);
        $this->assertEquals($expect, $banglist, 'start param test error:');
        $banglist = $bangumi->getlist(1, 1); // test num param
        $expect = array($baseBangumi[2]);
        $this->assertEquals($expect, $banglist, 'num param test error:');;
        $banglist = $bangumi->getlist(0, 20, 'createtime'); // test orderkey param
        $expect = array($baseBangumi[2], $baseBangumi[1], $baseBangumi[0]);
        $this->assertEquals($expect, $banglist, 'orderkey param test error');
        $banglist = $bangumi->getlist(0, 20, 'hit', 'ASC'); // test order param
        $expect = array($baseBangumi[1], $baseBangumi[2], $baseBangumi[0]);
        $this->assertEquals($expect, $banglist, 'order param test error');
    }
    public function testmodifycover()
    {
        $bangumi = new Bangumi_Model();
        $cover = 'http://static.mengniang.org/common/1/1e/%E6%95%B0%E7%A0%81%E5%AE%9D%E8%B4%9D.jpg';
        $result = $bangumi->modifycover(2, $cover);
        $this->assertEquals(Bangumi_Model::MODIFYCOVER_SUCCESS, $result, 'return value error:');
        $query = $this->getConnection()->createQueryTable('sub_bangumis', 'SELECT cover FROM sub_bangumis WHERE id=2');
        $expect = new DbUnit_ArrayDataSet(array('sub_bangumis' => array(
                                                array('cover' => $cover),
                                                )
                                          ));
        $this->assertTablesEqual($expect->getTable('sub_bangumis'), $query, 'failed to modify cover:');
    }
    public function testgetbangumiinfo()
    {
        global $baseBangumi;
        $bangumi = new Bangumi_Model();
        $result = $bangumi->getbangumiinfo(2);
        $expect = $baseBangumi[1];
        $this->assertEquals($expect, $result, 'get bangumi info error:');
        $result = $bangumi->getbangumiinfo(4); // test non-exist bangumi
        $this->assertFalse($result, 'test non-exist bangumi error:');
    }
}
