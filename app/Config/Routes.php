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
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index',['filter' => 'auth']);
$routes->get('/login','LoginController::index');
$routes->get('/logout','LoginController::logout');
$routes->add('/login','LoginController::auth');
$routes->get('/user', 'UserController::tampil');
$routes->get('/menu','MenuController::tampil');
$routes->get('/trans','TransaksiController::index');
$routes->add('/user', 'UserController::create');
$routes->add('user/edit/(:segment)', 'UserController::edit/$1');
$routes->get('user/hapus/(:segment)', 'UserController::hapus/$1');
$routes->get('/trans', 'TransaksiController::index');
$routes->add('/trans', 'TransaksiController::addCart');
$routes->add('/trans/save', 'TransaksiController::simpan');
$routes->get('trans/hapus/(:segment)', 'TransaksiController::hapusCart/$1');
$routes->get('/laporan', 'TransaksiController::laporan');
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
