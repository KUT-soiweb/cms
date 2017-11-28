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
}
