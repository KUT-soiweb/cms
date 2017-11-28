<?php
namespace App\Models;

use Core\Model;

class Roles extends \Model
{
    protected $table;

    public function __construct()
    {
        $this->table = \ORM::for_table('roles');
    }

    public function getTable()
    {
        return $this->table;
    }

    /**
    * getRoleList()
    * RolesTableから全要素を取得する
    * return rolesテーブルの全要素の配列
    */
    public function getRolesList()
    {
        $roles = $this->table->find_many();
        $roleArray = array();
        foreach ($roles as $role) {
            $roleArray[] = $role->as_array();
        }
        return $roleArray;
    }

    /**
    * getSelectRole
    * @param role_id
    * return 引数のidと一致するrolesの配列
    */
    public function getSelectRole($id)
    {
        $selectRole = $this->table->find_one($id)->as_array();
        return $selectRole;
    }
}
