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
    /**
     * 测试 checkpassword
     * @depends testpwdhash
     */
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
     * @depends testcheckpassword
     * ADDUSER_FAILED 返回未测试
     */
    public function testadduser()
    {
        $User = new User_Model();
        $queryCount = $this->getConnection()->getRowCount('sub_users');
        $username = 'testUser';
        $nickname = '天黑吃小夜';
        $password = 'testPassWord';
        $id = $User->adduser($username, $password, $nickname);
        $queryCountAfter = $this->getConnection()->getRowCount('sub_users');
        $this->assertEquals(1, $queryCountAfter - $queryCount, 'Failed to add a new record to DB');
        $query = $this->getConnection()->createQueryTable('sub_users', 'SELECT id, username, nickname FROM sub_users ORDER BY id DESC LIMIT 1');
        $expect = new DbUnit_ArrayDataSet(array(
                                            'sub_users' => array(
                                                array('id' => $id, 'username' => $username, 'nickname' => $nickname),
                                            )
                                          ));
        $this->assertTablesEqual($expect->getTable('sub_users'), $query, 'Content after add do not match expection:');
        $this->assertEquals(User_Model::CHECKPWD_RESTRICTED, $User->checkpassword($id, $password), 'PW after add do not match:');
    }
    /**
     * 测试 deluser
     * @depends testadduser
     */
    public function testdeluser()
    {
        global $baseUser;
        $User = new User_Model();
        $result = $User->deluser(count($baseUser) + 1);
        $this->assertEquals(User_Model::DELUSER_FAILED, $result, 'failed return value error:');
        $id = $User->adduser('testUser', '天黑吃小夜', 'testPassWord');
        $queryCount = $this->getConnection()->getRowCount('sub_users'); // should be count($baseUser) + 1
        $result = $User->deluser($id);
        $this->assertEquals(User_Model::DELUSER_SUCCESS, $result, 'success return value error:');
        $this->setExpectedException('PDOException'); // Foreign Key Constraints
        $result = $User->deluser(count($baseUser));
        $queryCountAfter = $this->getConnection()->getRowCount('sub_users');
        $this->assertEquals(-1, $queryCountAfter - $queryCount, 'Failed to del the record in DB');
        $query = $this->getConnection()->createQueryTable('sub_users', 'SELECT id FROM sub_users ORDER BY id ASC');
        $expect = new DbUnit_ArrayDataSet(array(
                                          'sub_users' => array(
                                                               array('id' => 1),
                                                               array('id' => 2),
                                                               array('id' => 3),
                                                               )
                                          ));
        $this->assertTablesEqual($expect->getTable('sub_users'), $query, 'Content after del do not match expection:');
    }
    /**
     * 测试 changepw
     * @depends testcheckpassword
     * CHANGE_FAILED 未测试
     */
    public function testchangepw()
    {
      $User = new User_Model();
      $newpassword = 'newpasswd';
      $result = $User->changepw(2, $newpassword);
      $this->assertEquals(User_Model::CHANGEPW_SUCCESS, $result, 'Return value error');
      $this->assertEquals(User_Model::CHECKPWD_ACCEPTED, $User->checkpassword(2, $newpassword), 'PW after change do not match new password');
    }
    public function testgetuserid()
    {
      global $baseUser;
      $User = new User_Model();
      $id = $User->getuserid($baseUser[0]['username']);
      $this->assertEquals(1, $id);
      $this->setExpectedException('UserNotFound');
      $id = $User->getuserid($baseUser[0]['username'].'test');
    }
    public function testgetusername()
    {
      global $baseUser;
      $User = new User_Model();
      $username = $User->getusername(1);
      $this->assertEquals($baseUser[0]['username'], $username);
      $this->setExpectedException('UserNotFound');
      $username = $User->getusername(count($baseUser) + 1);
    }
    public function testgetusernickname()
    {
      global $baseUser;
      $User = new User_Model();
      $usernickname = $User->getusernickname(1);
      $this->assertEquals($baseUser[0]['nickname'], $usernickname);
      $this->setExpectedException('UserNotFound');
      $usernickname = $User->getusernickname(count($baseUser) + 1);
    }
}
