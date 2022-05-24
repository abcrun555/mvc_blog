<?php

$routes = [
    'about' => [
        'controller' => 'main',
        'action' => 'about'
    ],

    'contact' => [
        'controller' => 'main',
        'action' => 'contact'
    ],

    '' => [
        'controller' => 'main',
        'action' => 'index'
    ],

    'main/post/{id:\d+}' =>
    [
        'controller' => 'main',
        'action' => 'post'

    ],
    'main/index/{page:\d+}' =>
    [
        'controller' => 'main',
        'action' => 'index'

    ],
    'main/login' => [
        'controller' => 'main',
        'action' => 'login'
    ],
    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout'
    ],
    'admin/delete/{id:\d+}' =>
    [
        'controller' => 'admin',
        'action' => 'delete'

    ],
    'admin/update/{id:\d+}' =>
    [
        'controller' => 'admin',
        'action' => 'update'
    ],
   
    'main/send'=>
    [
        'controller' => 'main',
        'action' => 'send'
    ],

    'admin/approve/{id:\d+}'=>
    [
        'controller' => 'admin',
        'action' => 'approve'
    ]
];



foreach ($routes as $route => $parameters) {
    $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
    $route = '#^' . $route . '$#';
    $array[$route] = $parameters;
}

return $array;
