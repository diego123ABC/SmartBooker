<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function () {
    return view('home');
});

// Web Routes
$routes->get('SmartBooker/public/risorse/tipo/(:segment)', 'ControllerRisorse::risorsePerTipo/$1');
$routes->get('SmartBooker/public/prenota/(:num)', 'ControllerPrenotazioni::formPrenotazione/$1');
$routes->post('SmartBooker/public/prenotazioni/inserisci', 'ControllerPrenotazioni::create');  

$routes->get('SmartBooker/public/login', 'ControllerAutenticazione::login');
$routes->post('SmartBooker/public/login', 'ControllerAutenticazione::login');
$routes->get('SmartBooker/public/register', 'ControllerAutenticazione::register');
$routes->post('SmartBooker/public/register', 'ControllerAutenticazione::register');
$routes->get('SmartBooker/public/logout', 'ControllerAutenticazione::logout');

// Dashboard generica con redirect in base al ruolo
$routes->get('SmartBooker/public/dashboard', 'DashboardController::index');

// Dashboard specifiche
$routes->get('SmartBooker/public/admin/dashboard', 'ControllerDashboard::adminDashboard');
$routes->get('SmartBooker/public/docente/dashboard', 'ControllerDashboard::docenteDashboard');
$routes->get('SmartBooker/public/studente/dashboard', 'ControllerDashboard::studenteDashboard');

// API Routes
$routes->resource('utenti', ['controller' => 'ControllerUtenti']);
$routes->resource('risorse', ['controller' => 'ControllerRisorse']);
$routes->resource('prenotazioni', ['controller' => 'ControllerPrenotazioni']);