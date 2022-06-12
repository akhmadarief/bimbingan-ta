<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth_filter']);

$routes->group('/', function($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::login');
    $routes->get('forgot-password', 'Auth::forgot_password');
    $routes->post('forgot-password', 'Auth::forgot_password');
    $routes->get('reset-password/(:hash)', 'Auth::reset_password/$1');
    $routes->post('reset-password/(:hash)', 'Auth::reset_password/$1');
    $routes->get('logout', 'Auth::logout');
});

$routes->group('admin/user', ['filter' => 'admin_filter'], function($routes) {
    $routes->get('dosen', 'Admin\User::dosen');
    $routes->get('mhs', 'Admin\User::mhs');
});

$routes->group('dosen/bimbingan', ['filter' => 'dosen_filter'], function($routes) {
    $routes->get('submission', 'Dosen\Bimbingan::submission');
    $routes->get('on-progress', 'Dosen\Bimbingan::on_progress');
    $routes->get('completed', 'Dosen\Bimbingan::completed');
    $routes->get('approve/(:num)', 'Dosen\Bimbingan::approve/$1');
    $routes->get('cancel-approve/(:num)', 'Dosen\Bimbingan::approve/$1');
    $routes->get('reject/(:num)', 'Dosen\Bimbingan::reject/$1');
    $routes->get('mark-as-completed/(:num)', 'Dosen\Bimbingan::mark_as_completed/$1');
    $routes->get('mark-as-on-progress/(:num)', 'Dosen\Bimbingan::mark_as_on_progress/$1');
});

$routes->group('mhs/bimbingan', ['filter' => 'mhs_filter'], function($routes) {
    $routes->get('submission', 'Mhs\Bimbingan::submission');
    $routes->get('on-progress', 'Mhs\Bimbingan::on_progress');
    $routes->get('completed', 'Mhs\Bimbingan::completed');
    $routes->post('new', 'Mhs\Bimbingan::new');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
