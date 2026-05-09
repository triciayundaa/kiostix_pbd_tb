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
$routes->get('atraksi', 'Atraksi::index');
$routes->post('atraksi/process-payment', 'Atraksi::processPayment');
$routes->match(['get', 'post'], 'atraksi/checkout/(:segment)', 'Atraksi::checkout/$1');
$routes->get('atraksi/waiting-payment/(:segment)', 'Atraksi::waitingPayment/$1');
$routes->get('atraksi/(:segment)', 'Atraksi::detail/$1');

$routes->get('cart', 'Cart::index');
$routes->post('cart/add', 'Cart::add');
$routes->get('cart/get', 'Cart::getCart');
$routes->post('cart/update-qty', 'Cart::updateQty');
$routes->post('cart/remove', 'Cart::remove');
$routes->get('cart/checkout', 'Cart::checkout');
$routes->post('cart/process-payment', 'Cart::processPayment');

// Static Pages
$routes->get('about', 'Pages::about');
$routes->get('terms', 'Pages::terms');
$routes->get('privacy', 'Pages::privacy');
