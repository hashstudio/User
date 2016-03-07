<?php

return [
    '/' => [
        'name' => 'list',
        'callback' => '\Modules\User\Controllers\UserController:index'
    ],
    '/recover/' => [
        'name'     => 'recover',
        'callback' => '\Modules\User\Controllers\RecoverController:index'
    ],
    '/recover/{key}' => [
        'name'     => 'recover_activate',
        'callback' => '\Modules\User\Controllers\RecoverController:activate'
    ],
    '/profile' => [
        'name'     => 'profile',
        'callback' => '\Modules\User\Controllers\UserController:profile',
    ],
    '/password' => [
        'name'     => 'change_password',
        'callback' => '\Modules\User\Controllers\UserController:changepassword',
    ],
    '/registration' => [
        'name'     => 'registration',
        'callback' => '\Modules\User\Controllers\RegistrationController:index'
    ],
    '/registration/success' => [
        'name'     => 'registration_success',
        'callback' => '\Modules\User\Controllers\RegistrationController:success'
    ],
    '/registration/activation/{key}' => [
        'name'     => 'registration_activation',
        'callback' => '\Modules\User\Controllers\RegistrationController:activate'
    ],
    '/logout' => [
        'name'     => 'logout',
        'callback' => '\Modules\User\Controllers\AuthController:logout'
    ],
    '/login' => [
        'name'     => 'login',
        'callback' => '\Modules\User\Controllers\AuthController:login'
    ],
    '/{username:\w+}' => [
        'name'   => 'view',
        'callback' => '\Modules\User\Controllers\UserController:view'
    ],
];
