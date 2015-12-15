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
                                                array('id' => $id, 'creator' => 2, 'createtime' => TIMENOW, 'owner' => 2, 'description' => 'test description'),
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
        $expect = array('eng' => array('Fate Zero', 'Fate／Zero'), 'jpn' => array('フェイト/ゼロ'));
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
    }
}