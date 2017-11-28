<?php
namespace Config;

class Routes
{
    protected $routes = array(
        'users' => array('controller' => 'users', 'action' => 'index', 'method' => 'get'),
    );

    public function getRoutes()
    {
        return $this->routes;
    }
}
