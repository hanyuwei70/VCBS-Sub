<?php
require_once 'phpunit.xml';
require_once 'base.php';

require_once '../src/base.php';
require_once '../src/models/bangumi.php';

class Bangumi_ModelTest extends ModelTest
{
    public function testcreate()
    {
        $bangumi = new Bangumi_Model();
        $queryCount = $this->getConnection()->getRowCount('sub_bangumis');
        $id = $bangumi->create(3, 'test description');
        $queryCountAfter = $this->getConnection()->getRowCount('sub_bangumis');
        $this->assertEquals(1, $queryCountAfter-$queryCount);
        $query = $this->getConnection()->createQueryTable('sub_bangumis', 'SELECT * FROM sub_bangumis ORDER BY id DESC LIMIT 1');
        $expect = new DbUnit_ArrayDataSet(array(
                                            'sub_bangumis' => array(
                                                array('id' => $id, 'creator' => 2, 'createtime' => date('Y-m-d H:i:s', TIMENOW), 'owner' => 2, 'description' => 'test description'),
                                            )
                                          ));
        $this->assertTablesEqual($expect->getTable('sub_bangumis'), $query);
        // return $id;
    }

    public function testdel()
    {
        $bangumi = new Bangumi_Model();
        $queryCount = $this->getConnection()->getRowCount('sub_bangumis');
        $rtn = $bangumi->del(2);
        $queryCountAfter = $this->getConnection()->getRowCount('sub_bangumis');
        $this->assertEquals(-1, $queryCountAfter-$queryCount);
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
        $this->assertEquals($expect, $query);
    }
    /**
     * Test for Add name method
     * @depends testcreate
     */
    // public function testaddname($id)
    // {
    //     $bangumi->addname($id, 'Fate Zero', 'eng');
    //     $query = $this->getConnection()->createQueryTable('sub_bangumis_name', 'SELECT bangumi_id, name, lang FROM sub_bangumis_name');
    //     $expect = new DbUnit_ArrayDataSet(array(
    //                                             'sub_bangumis_name' => array(
    //                                                 array('bangumi_id' => $id, 'name' => 'Fate Zero', 'lang' => 'eng'),
    //                                             )
    //                                         ));
    //     $this->assertTablesEqual($query, $expect);
    // }
}
