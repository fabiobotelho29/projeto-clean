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

/** AUTHENTICATION */
$router->group("auth");
$router->get('/register', 'AuthController::register', 'AuthControllerRegister');
$router->get('/login', 'AuthController::login', 'AuthControllerLogin');

/** PANEL */
$router->group("panel");
$router->get('/test', 'PanelController::testvue', 'PanelControllerTestVue');
$router->get('/dashboard', 'PanelController::index', 'PanelControllerIndex');
$router->get('/account/profile/user-data', 'PanelController::ProfileUserData', 'PanelControllerProfileUserData');
$router->get('/account/profile/change-password', 'PanelController::ProfileChangePassword', 'PanelControllerProfileChangePassword');
$router->get('/account/company/data', 'PanelController::CompanyData', 'PanelControllerCompanyData');
$router->get('/account/employees/manage', 'PanelController::EmployeesManage', 'PanelControllerEmployeesManage');
$router->get('/account/employees/employee-data/{employee_code}', 'PanelController::EmployeeData', 'PanelControllerEmployeeData');

/** ADMIN */
$router->group("admin");
$router->get('/admin', 'Admin::login');

/** API */
$router->group("api");
$router->post('/api/registerUser', 'ApiController::registerUser');

/** DESPACHANDO ROTAS */
$router->dispatch();

ob_end_flush();