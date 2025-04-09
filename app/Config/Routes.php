<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->resource('utenti', ['controller' => 'ControllerUtenti']);
$routes->resource('prenotazioni', ['controller' => 'ControllerPrenotazioni']);
$routes->resource('risorse', ['controller' => 'ControllerRisorse']);
