<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('utenti', 'ControllerUtenti::index');
$routes->get('prenotazioni', 'ControllerPrenotazioni::index');
$routes->get('risorse', 'ControllerRisorse::index');
$routes->resource('utenti', ['controller' => 'ControllerUtenti']);
$routes->resource('risorse', ['controller' => 'ControllerRisorse']);
$routes->resource('prenotazioni', ['controller' => 'ControllerPrenotazioni']);
