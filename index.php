<?php
ob_start();

require(__DIR__ . "/vendor/autoload.php");
ini_set('xdebug.overload_var_dump', 1);

$timezone_identifier = "America/Sao_Paulo";
date_default_timezone_set($timezone_identifier);

use CoffeeCode\Router\Router;
$route = new Router("", "::");


/** NAMESPACE */
$route->namespace("Source\Controllers");

/** FRONT */
$route->get('/', 'FrontController::home');

/** AUTHENTICATION */
$route->group("auth");
$route->get('/register', 'AuthController::register', 'AuthControllerRegister');
$route->get('/login', 'AuthController::login', 'AuthControllerLogin');

/** PANEL */
$route->group("panel");
$route->get('/dashboard', 'PanelController::index', 'PanelControllerIndex');
$route->get('/account/profile/user-data', 'PanelController::ProfileUserData', '`PanelControllerProfileUserData`');
$route->get('/account/profile/change-password', 'PanelController::ProfileChangePassword', '`PanelControllerProfileChangePassworda`');
$route->get('/account/company/data', 'PanelController::CompanyData', '`PanelControllerCompanyData`');

/** ADMIN */
$route->group("admin");
$route->get('/admin', 'Admin::login');

/** API */
$route->group("api");
$route->post('/api/registerUser', 'ApiController::registerUser');

/** DESPACHANDO ROTAS */
$route->dispatch();

ob_end_flush();