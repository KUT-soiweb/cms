<?php
require dirname(__FILE__, 2) . '/BaseDBTest.php';

use App\Models\Users;
use App\Models\Roles;
use Config\Connection;

class UsersTest extends BaseDBTest
{
    protected $userObj;

    protected function setUp()
    {
        // 接続
        $conn = new Connection();
        $conn->connect();
        // ユーザオブジェクトの作成
        $this->userObj = new Users();
        $this->setFixture(require(dirname(__FILE__, 2) . '/DataSet/usersFixture.php'));
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
    * @dataProvider addValidProvider
    */
    public function testValid($expected, $params)
    {
        $entry = $this->userObj->getTable()->create();
        $this->assertEquals($expected, $this->userObj->setParams($entry, $params));
    }

    public function addValidProvider()
    {
        return [
            '正常値'                        => [true,  array('user_id' => 'userid1234', 'password' => 'pass1234', 'name' => 'user_name')],
            'user_idの長さが7文字以下'      => [false, array('user_id' => 'user',       'password' => 'pass1234', 'name' => 'user_name')],
            'user_idが空文字'               => [false, array('user_id' => '',           'password' => 'pass1234', 'name' => 'user_name')],
            'user_idに半角英数以外'         => [false, array('user_id' => 'ああああ',   'password' => 'pass1234', 'name' => 'user_name')],
            'passwordの長さが7文字以下'     => [false, array('user_id' => 'userid1234', 'password' => 'pass',     'name' => 'user_name')],
            'passwordが空文字'              => [false, array('user_id' => 'userid1234', 'password' => '',         'name' => 'user_name')],
            'passwordに半角英数以外'        => [false, array('user_id' => 'userid1234', 'password' => 'pass123$', 'name' => 'user_name')],
            'nameが空文字'                  => [false, array('user_id' => 'userid1234', 'password' => 'pass1234', 'name' => ''         )],
        ];
    }

    /**
    * @dataProvider addInsertProvider
    */
    public function testInsert($expected, $params)
    {
        $entry = $this->userObj->getTable()->create();
        $this->userObj->setParams($entry, $params);
        try {
            $entry->save();
            $result = true;
        } catch (Exception $e) {
            $result = false;
        }
        $this->assertEquals($expected, $result);
    }

    public function addInsertProvider()
    {
        return [
            '正常値'    =>  [true,  array('user_id' => 'user1234', 'password' => 'pass1234', 'name' => 'user_name', 'roles_id' => '1')],
            '異常値'    =>  [false, array('user_id' => 'aaaa',     'password' => 'pass',     'name' => '',          'roles_id' => '' )],
        ];
    }
}
