<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('utenti', 'ControllerUtenti::index');
$routes->get('prenotazioni', 'ControllerPrenotazioni::index');
$routes->get('risorse', 'ControllerRisorse::index');
$routes->resource('utenti', ['controller' => 'ControllerUtenti']);
$routes->resource('risorse', ['controller' => 'ControllerRisorse']);
$routes->resource('prenotazioni', ['controller' => 'ControllerPrenotazioni']);
$routes->get('form/prenotazione', function() {
    echo view('crea_prenotazione');
});
$routes->get('/', function () {
    echo view('home');
});

$routes->get('risorse/tipo/(:segment)', 'ControllerRisorse::risorsePerTipo/$1');
$routes->get('prenota/(:num)', 'ControllerPrenotazioni::formPrenotazione/$1'); // form per prenotare
$routes->post('prenotazioni/inserisci', 'ControllerPrenotazioni::create'); // inserimento prenotazione
