<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', function($routes) {
    // Public routes (no auth needed)
    $routes->post('register', 'Auth::register');
    $routes->post('login', 'Auth::login');

    // Protected routes (JWT required)
    $routes->group('', ['filter' => 'jwt'], function($routes) {
        $routes->post('teacher', 'Teacher::create');
        $routes->get('users', 'Teacher::getUsers');
        $routes->get('teachers', 'Teacher::getTeachers');
    });
});