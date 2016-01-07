<?php
require_once 'phpunit.xml';
require_once 'base.php';

require_once '../src/base.php';
require_once '../src/models/user.php';

class User_ModelTest extends ModelTest
{
    public function testpwdhash()
    {
        global $baseUser;
        $User = new User_Model();
        $publicpwdhash = new ReflectionMethod('User_Model', 'pwdhash');
        $publicpwdhash->setAccessible(true);
        $password = 'passwd';
        $hash = $publicpwdhash->invoke($User, $password);
        $this->assertEquals($baseUser[0]['password'], $hash);
    }
    public function testcheckpassword()
    {
        $User = new User_Model();
        $password = 'passwd';
        $this->assertEquals(User_Model::CHECKPWD_ACCEPTED, $User->checkpassword(1, $password), 'ACCEPTED FAILED');
        $this->assertEquals(User_Model::CHECKPWD_RESTRICTED, $User->checkpassword(3, $password), 'RESTRICTED FAILED');
        $this->assertEquals(User_Model::CHECKPWD_DENIED, $User->checkpassword(2, $password.'a'), 'DENIED FAILED');
    }
    /**
     * 测试 adduser
     * @depends testpwdhash
     * @depends testcheckpassword
     * ADDUSER_FAILED 返回未测试
     */
    public function testadduser()
    {
        $User = new User_Model();
        $queryCount = $this->getConnection()->getRowCount('sub_users');
        $username = 'testUser';
        $usernickname = '天黑吃小夜';
        $password = 'testPassWord';
        $id = $User->create($username, $password, $usernickname);
        $queryCountAfter = $this->getConnection()->getRowCount('sub_users');
        $this->assertEquals(1, $queryCountAfter - $queryCount, 'Failed to add a new record to DB');
        $query = $this->getConnection()->createQueryTable('sub_users', 'SELECT id, username, usernickname FROM sub_users ORDER BY id DESC LIMIT 1');
        $expect = new DbUnit_ArrayDataSet(array(
                                            'sub_users' => array(
                                                array('id' => $id, 'username' => $username, 'usernickname' => $usernickname),
                                            )
                                          ));
        $this->assertTablesEqual($expect->getTable('sub_users'), $query, 'Content after create do not match expection:');
        $this->assertEquals(User_Model::CHECKPWD_ACCEPTED, $User->checkpassword($id, $password), 'PW after create do not match:');
    }
}
