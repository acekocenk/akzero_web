<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/notaccess', 'Home::notaccess');
$routes->get('/', 'Home::index');
$routes->get('/users', 'Users::index', ['filter' => 'role:admin']);
// $routes->get('/userprofile/(:num)', 'UserProfile::loaddata/$1');
// $routes->get('/home/about', 'Home::about');
// $routes->get('/home/contact', 'Home::contact');

$routes->get('/product/create', 'Product::create');
$routes->get('/product/edit/(:any)', 'Product::edit/$1');
$routes->delete('/product/(:num)', 'Product::delete/$1');
$routes->get('/product/(:any)', 'Product::detail/$1');

$routes->get('/category', 'Category::index', ['filter' => 'permission:Manage-Master-Inv']);
// $routes->get('/category', 'Category::index', ['filter' => 'role:admin']);

$routes->get('/material', 'Material::index', ['filter' => 'permission:Manage-Master-Inv']);
// $routes->get('/material', 'Material::index', ['filter' => 'role:admin']);

$routes->get('/materialtype', 'MaterialType::index', ['filter' => 'permission:Manage-Master-Inv']);
// $routes->get('/materialtype', 'MaterialType::index', ['filter' => 'role:admin']);

$routes->get('/colour', 'colour::index', ['filter' => 'permission:Manage-Master-Inv']);
// $routes->get('/colour', 'colour::index', ['filter' => 'role:admin']);

$routes->get('/supplier', 'supplier::index', ['filter' => 'permission:Manage-Master-Inv']);
// $routes->get('/supplier', 'supplier::index', ['filter' => 'role:admin']);

$routes->get('/bom', 'Bom::index', ['filter' => 'permission:Manage-Master-Inv']);
// $routes->get('/bom', 'Bom::index', ['filter' => 'role:admin']);

$routes->get('/items', 'Items::index', ['filter' => 'permission:Manage-Master-Inv']);
// $routes->get('/bom', 'Bom::index', ['filter' => 'role:admin']);

//inv warehouse

$routes->get('/whin', 'WarehouseIn::index', ['filter' => 'permission:Manage-WH']);
// $routes->get('/whin', 'WarehouseIn::index', ['filter' => 'role:admin']);

$routes->get('/po', 'po::index', ['filter' => 'permission:Purchase-Order']);
$routes->get('/po/create', 'po::create', ['filter' => 'permission:Purchase-Order-Add']);
$routes->get('/po/edit/(:any)', 'po::edit/$1', ['filter' => 'permission:Purchase-Order-Edit']);
$routes->delete('/po/(:num)', 'po::delete/$1', ['filter' => 'permission:Purchase-Order-Delete']);

// $routes->get('/bom/ajaxloaddatabom', 'bom::ajaxloaddatabom', ['filter' => 'role:admin']);
// $routes->get('/category/loaddata', 'Category::loaddata');
// $routes->get('/category/create', 'Category::create');

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
