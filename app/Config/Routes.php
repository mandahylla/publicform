<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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

//Common Routes
$routes->get('/', 'Welcome::index');
$routes->get('test/multi', 'Welcome::registerMultiple');
$routes->post('login', 'Welcome::login');
$routes->get('blocked', 'Welcome::forbiddenPage');
$routes->get('register', 'Welcome::register');
$routes->post('register', 'Welcome::registration');
$routes->get('activation', 'Welcome::activate');
$routes->get('activation/(:any)', 'Welcome::activate/$1');
$routes->get('login/forgot_password', 'Welcome::forgotPassword');
$routes->post('login/forgot_password', 'Welcome::forgotPassword');
$routes->get('login/reset_password/(:any)/(:any)', 'Welcome::resetPassword/$1/$2');
$routes->post('login/reset_password/(:num)', 'Welcome::renewPassword/$1');
$routes->get('home', 'Home::index');
$routes->add('email/compose', 'TestMail::compose');
$routes->post('email/send-email', 'TestMail::send_email');
$routes->get('mailtest', 'TestMail::index');
$routes->get('conditions', 'Welcome::condition');

// Demand Routes
$routes->get('demands', 'Demand::index');
$routes->get('demand', 'Demand::addForm');
$routes->get('demand/export/excel', 'Demand::excelExport');
$routes->get('demand/export/pdf/(:any)', 'Demand::pdfExport/$1');
$routes->post('demand', 'Demand::createDemands');
$routes->get('demand/update/(:any)', 'Demand::updateForm/$1');
$routes->post('demand/updateDemands', 'Demand::updateDemands');
$routes->post('demand/status/update', 'Demand::updateDemands');
$routes->post('demand/cancel/(:num)', 'Demand::cancelDemands/$1');

// Upload Routes
$routes->get('uploadFile/list', 'UploadFile::ajaxListFiles');
$routes->post('uploadFile/add', 'UploadFile::createFiles');
$routes->get('uploadFile/(:any)', 'UploadFile::displayFile/$1');
$routes->post('uploadFile/delete', 'UploadFile::ajaxDeleteFiles');

// Setting Routes
$routes->get('users/userRoleAccess', 'Users::userRoleAccess');
$routes->post('users/createRole', 'Users::createRole');
$routes->post('users/updateRole', 'Users::updateRole');
$routes->delete('users/deleteRole', 'Users::deleteRole');
$routes->post('users/createUser', 'Users::createUser');
$routes->post('users/updateUser', 'Users::updateUser');
$routes->delete('users/deleteUser', 'Users::deleteUser');
$routes->post('users/changeMenuPermission', 'Users::changeMenuPermission');
$routes->post('users/changeMenuCategoryPermission', 'Users::changeMenuCategoryPermission');
$routes->post('users/changeSubMenuPermission', 'Users::changeSubMenuPermission');

$routes->post('menuManagement/createMenuCategory', 'Developers\MenuManagement::createMenuCategory');
$routes->post('menuManagement/createMenu', 'Developers\MenuManagement::createMenu');
$routes->post('menuManagement/createSubMenu', 'Developers\MenuManagement::createSubMenu');

//Developer Routes
$routes->get('menuManagement', 'Developers\MenuManagement::index');
$routes->get('crudGenerator', 'Developers\CRUDGenerator::index');

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