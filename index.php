<?php
ob_start();

require(__DIR__ . "/vendor/autoload.php");
ini_set('xdebug.overload_var_dump', 1);

$timezone_identifier = "America/Sao_Paulo";
date_default_timezone_set($timezone_identifier);

use CoffeeCode\Router\Router;
$router = new Router("", "::");

/** NAMESPACE */
$router->namespace("Source\Controllers");



/** FRONT */
$router->get('/', 'FrontController::home');

/** API */
$router->group("api");
$router->post('/registerUser', 'ApiController::registerUser');
$router->post('/loginUser', 'ApiController::loginUser');
$router->post('/passwordReset', 'ApiController::passwordReset');
$router->post('/newPassword', 'ApiController::newPassword');
$router->get('/test', 'ApiController::test');

/** AUTHENTICATION */
$router->group("auth");
$router->get('/register', 'AuthController::register', 'AuthControllerRegister');
$router->get('/login', 'AuthController::login', 'AuthControllerLogin');
$router->get('/logout', 'AuthController::logout', 'AuthControllerLogout');
$router->get('/password-reset', 'AuthController::password_reset', 'AuthControllerPasswordReset');
$router->get('/new-password/{user_code}', 'AuthController::new_password', 'AuthControllerNewPassword');

/** PANEL */
$router->group("panel");
$router->get('/test', 'PanelController::testvue', 'PanelControllerTestVue');
$router->get('/dashboard', 'PanelController::dashboard', 'PanelControllerDashboard');
$router->get('/account/profile/user-data', 'PanelController::ProfileUserData', 'PanelControllerProfileUserData');
$router->get('/account/profile/change-password', 'PanelController::ProfileChangePassword', 'PanelControllerProfileChangePassword');
$router->get('/account/company/data', 'PanelController::CompanyData', 'PanelControllerCompanyData');
$router->get('/account/employees/manage', 'PanelController::EmployeesManage', 'PanelControllerEmployeesManage');
$router->get('/account/employees/employee-data/{employee_code}', 'PanelController::EmployeeData', 'PanelControllerEmployeeData');

/** ADMIN */
$router->group("admin");
$router->get('/admin', 'Admin::login');



/** DESPACHANDO ROTAS */
$router->dispatch();

ob_end_flush();