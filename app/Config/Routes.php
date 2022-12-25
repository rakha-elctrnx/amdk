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
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post("login","LoginController::login");
$routes->get('logout', 'LogoutController::index');

$routes->get('dashboard', 'DashboardController::index');

$routes->get('supplier', 'SupplierController::supplier');
$routes->get('supplier/add', 'SupplierController::supplier_add');
$routes->post('supplier/add', 'SupplierController::supplier_add_process');
$routes->get('supplier/(:num)/delete', 'SupplierController::supplier_delete_process/$1');
$routes->get('supplier/(:num)/edit', 'SupplierController::supplier_edit/$1');
$routes->post('supplier/edit', 'SupplierController::supplier_edit_process');

$routes->get('customer', 'CustomerController::customer');
$routes->get('customer/add', 'CustomerController::customer_add');
$routes->post('customer/add', 'CustomerController::customer_add_process');
$routes->get('customer/(:num)/delete', 'CustomerController::customer_delete_process/$1');
$routes->get('customer/(:num)/edit', 'CustomerController::customer_edit/$1');
$routes->post('customer/edit', 'CustomerController::customer_edit_process');

$routes->get('material', 'MaterialController::material');
$routes->get('material/add', 'MaterialController::material_add');
$routes->post('material/add', 'MaterialController::material_add_process');
$routes->get('material/(:num)/delete', 'MaterialController::material_delete_process/$1');
$routes->get('material/(:num)/edit', 'MaterialController::material_edit/$1');
$routes->post('material/edit', 'MaterialController::material_edit_process');

$routes->get('buy', 'BuyController::buy');
$routes->get("buy/add","BuyController::buy_add");
$routes->post("buy/add","BuyController::buy_add_process");
$routes->get("buy/(:num)/manage","BuyController::buy_manage/$1");
$routes->post("buy/edit","BuyController::buy_edit_process");
$routes->post("buy/item/add","BuyController::buy_item_add");

$routes->get('transaction', 'TransactionController::transaction');
$routes->get('transaction/add', 'TransactionController::transaction_add');
$routes->post('transaction/add', 'TransactionController::transaction_add_process');
$routes->get('transaction/(:num)/delete', 'TransactionController::transaction_delete_process/$1');
$routes->get('transaction/(:num)/edit', 'TransactionController::transaction_edit/$1');
$routes->post('transaction/edit', 'TransactionController::transaction_edit_process');

$routes->get('product', 'ProductController::product');
$routes->get('product/add', 'ProductController::product_add');
$routes->post('product/add', 'ProductController::product_add_process');

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
