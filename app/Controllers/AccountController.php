<?php

use Core\Controller;
use App\Models\Users;

class accountController extends Controller
{
    public function index()
    {
        if (!$this->isLogin()) {
            return $this->render(array('alert' => false));
        }
    }

    public function login()
    {
        $params = $this->request->getParams('login');
        $userObj = new Users();
        $user = $userObj->getUser($params['user_id']);
        if ($user) {
            if ($user['password'] == $params['password']) {
                $this->session->setAuthenticated(true);
                $this->session->set('user_id', $user['user_id']);
                $url = '/users/show/' . $user['user_id'];
                return $this->redirect($url);
            }
        }
        return $this->render(array('alert' => true), 'index');
    }

    public function logout()
    {
        $this->session->clear();
        $this->session->setAuthenticated(false);
        return $this->redirect('/login');
    }

    public function isLogin()
    {
        if ($this->session->isAuthenticated()) {
            $url = '/users/show/' . $this->session->get('user_id');
            return $this->redirect($url);
        }
        return false;
    }
}
