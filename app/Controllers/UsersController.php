<?php

use Core\Controller;
use App\Models\Users;
use App\Models\Roles;

class UsersController extends Controller
{
    public function index()
    {
        return $this->render();
    }

    public function add()
    {
        $rolesObj = new Roles();
        $roles = $rolesObj->getRolesList();

        $usersObj = new Users();
        $user = $usersObj->getTable()->create();

        return $this->render(array('roles' => $roles, 'user' => $user, 'alert' => false));
    }

    public function create()
    {
        $userParams = $this->request->getParams('user');
        $usersObj = new Users();
        if ($usersObj->insert($userParams)) {

            return $this->redirect('/users/show/' . $userParams['user_id']);
        } else {
            $rolesObj = new Roles();
            $roles = $rolesObj->getRolesList();
            array_unshift($roles, $rolesObj->getSelectRole($userParams['roles_id']));

            return $this->render(array('user' => $userParams, 'roles' => $roles, 'alert' => true), 'add');
        }
    }

    public function show($params)
    {
        $usersObj = new Users();
        $user = $usersObj->getUser($params['id']);
        return $this->render(array('user' => $user));
    }
}
