<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function () {
    return view('home');
});

// Web Routes
$routes->get('risorse/tipo/(:segment)', 'ControllerRisorse::risorsePerTipo/$1');
$routes->get('prenota/(:num)', 'ControllerPrenotazioni::formPrenotazione/$1');
$routes->post('prenotazioni/inserisci', 'ControllerPrenotazioni::create');  

// API Routes
$routes->resource('utenti', ['controller' => 'ControllerUtenti']);
$routes->resource('risorse', ['controller' => 'ControllerRisorse']);
$routes->resource('prenotazioni', ['controller' => 'ControllerPrenotazioni']);