<?php
namespace App\Models;

class Users extends \Model
{
    protected $table;

    public function __construct()
    {
        $this->table = \ORM::for_table('users');
    }

    public function getTable()
    {
        return $this->table;
    }

    public function setParams($entry, $params)
    {
        if ($this->checkValid($params)) {
            foreach ($params as $key => $value) {
                $entry->$key = $value;
            }
            return true;
        } else {
            return false;
        }
    }

    public function insert($params)
    {
        $entry = $this->table->create();
        if ($this->setParams($entry, $params)) {
            $entry->save();
            return true;
        } else {
            return false;
        }
    }

    public function getUser($id)
    {
        $user = $this->table->where('user_id', $id)->find_one();
        if ($user) {
            return $user->as_array();
        }
        return false;
    }
    /**
    * バリデーションチェック
    * user_id: 半角英数字8文字以上, 重複不可, not null
    * password: 半角英数字8文字以上, not null
    * name: not null
    */
    private function checkValid($params)
    {
        if (!$this->checkFormat($params['user_id'])) return false;
        if (!$this->checkDouble('user_id', $params['user_id'])) return false;
        if (!$this->checkFormat($params['password'])) return false;
        if (!$this->checkBlank($params['name'])) return false;
        return true;
    }

    private function checkFormat($param)
    {
        $pattern = '/\A[a-z\d]{8,254}+\z/i';
        if (preg_match($pattern, $param)) return true;
        return false;
    }

    private function checkBlank($param)
    {
        $pattern = '/[^\s　]/';
        if (preg_match($pattern, $param)) return true;
        return false;
    }

    private function checkDouble($column, $param)
    {
        if (!$this->table->where($column, $param)->find_one()) return true;
        return false;
    }
}
