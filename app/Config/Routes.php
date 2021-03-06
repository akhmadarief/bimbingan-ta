<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setTranslateURIDashes(false);
$routes->set404Override(function() {
    return view('errors/404', ['title' => 'Page Not Found']);
});
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->group('/', ['filter' => 'noauth'], static function ($routes) {
    $routes->match(['get','post'], 'login', 'Auth\Login::index');
    $routes->match(['get','post'], 'forgot-password', 'Auth\Password::forgot');
    $routes->match(['get','post'], 'reset-password/(:hash)', 'Auth\Password::reset/$1');

    $routes->group('register', static function ($routes) {
        $routes->match(['get','post'], '/', 'Auth\Register::index');
        $routes->get('verify/(:hash)', 'Auth\Register::verify/$1');
    });

    $routes->group('google', static function ($routes) {
        $routes->get('login', 'Auth\Google\Login::index');
        $routes->match(['get','post'], 'register', 'Auth\Google\Register::index');
    });
});

$routes->get('chat', 'Chat::index', ['filter' => 'auth']);

$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->group('user', static function ($routes) {
        $routes->get('dosen', 'Admin\User::dosen');
        $routes->get('mhs', 'Admin\User::mhs');
        $routes->post('add', 'Admin\User::add');
        $routes->post('edit', 'Admin\User::edit');
        $routes->get('delete/(:num)', 'Admin\User::delete/$1');
    });
});

$routes->group('dosen', ['filter' => 'dosen'], static function ($routes) {
    $routes->get('dashboard', 'Dosen\Dashboard::index');
    $routes->group('bimbingan', static function ($routes) {
        $routes->get('submission', 'Dosen\Bimbingan::submission');
        $routes->get('on-progress', 'Dosen\Bimbingan::on_progress');
        $routes->get('completed', 'Dosen\Bimbingan::completed');
        $routes->get('approve/(:num)', 'Dosen\Bimbingan::approve/$1');
        $routes->get('cancel-approve/(:num)', 'Dosen\Bimbingan::cancel_approve/$1');
        $routes->get('reject/(:num)', 'Dosen\Bimbingan::reject/$1');
        $routes->get('mark-as-completed/(:num)', 'Dosen\Bimbingan::mark_as_completed/$1');
        $routes->get('mark-as-on-progress/(:num)', 'Dosen\Bimbingan::mark_as_on_progress/$1');
    });
});

$routes->group('mhs', ['filter' => 'mhs'], static function ($routes) {
    $routes->get('dashboard', 'Mhs\Dashboard::index');
    $routes->group('bimbingan', static function ($routes) {
        $routes->get('submission', 'Mhs\Bimbingan::submission');
        $routes->get('on-progress', 'Mhs\Bimbingan::on_progress');
        $routes->get('completed', 'Mhs\Bimbingan::completed');
        $routes->post('add', 'Mhs\Bimbingan::add');
    });
});

$routes->group('user', ['filter' => 'auth'], static function ($routes) {
    $routes->get('settings', 'User::settings');
    $routes->post('update-profile', 'User::update_profile');
    $routes->post('update-password', 'User::update_password');
});

$routes->get('logout', 'Auth\Logout::index');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
