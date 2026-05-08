<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('tampil-user', 'User::index');
$routes->match(['get', 'post'], 'login', 'Auth::login');
$routes->match(['get', 'post'], 'register', 'Auth::register');
$routes->get('logout', 'Auth::logout');
$routes->match(['get', 'post'], 'profile', 'Profile::index');
$routes->post('profile/update-password', 'Profile::updatePassword');

// Static Pages
$routes->get('about', 'Pages::about');
$routes->get('terms', 'Pages::terms');
$routes->get('privacy', 'Pages::privacy');
