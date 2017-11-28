<?php

use Core\Controller;
use App\Models\Users;

class UsersController extends Controller
{
    public function index()
    {
        $userObj = new Users();
        $userEntry = $userObj->getTable()->create();
        $params = array('user_id' => 'aaaaaaaa', 'password' => 'aaaaaaaa', 'name' => 'aaaa');
        $userObj->setParams($userEntry, $params);
        return $this->render();
    }
}
