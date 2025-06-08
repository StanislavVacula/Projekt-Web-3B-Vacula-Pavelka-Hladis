<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Domovská stránka
$routes->get('/', 'Home::index');

// AJAX požadavky pro získání modelů a typů
$routes->post('/home/getModelsByBrand', 'Home::getModelsByBrand');
$routes->post('/home/getTypesByModel', 'Home::getTypesByModel');

// Routy pro přihlášení a odhlášení
$routes->get('login', 'Login::index', ['as' => 'prihlaseni']); // Zobrazení přihlašovací stránky
$routes->post('login', 'Login::auth'); // Zpracování přihlášení
$routes->get('logout', 'Login::logout'); // Odhlášení uživatele

// O nás
$routes->get('about', function() {
    return view('about');
});

// Kontakt
$routes->get('contact', function() {
    return view('contact');
});

// Skupina rout pro administraci s filtrem 'auth'
$routes->group('administrace', ['filter' => 'auth'], static function ($routes) {
    $routes->get('dashboard', 'Dashboard::index'); // Administrativní dashboard
    $routes->get('odhlaseni', 'Dashboard::logout'); // Odhlášení z administrace
    $routes->get('profil/edit', 'Profile::edit'); // Úprava profilu
});

// Skupina rout pro správu aut (CRUD) pouze pro přihlášené uživatele
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('auta', 'Auta::index');
    $routes->get('auta/create', 'Auta::create');
    $routes->post('auta/store', 'Auta::store');
    $routes->get('auta/edit/(:num)', 'Auta::edit/$1');
    $routes->post('auta/update/(:num)', 'Auta::update/$1');
    $routes->get('auta/delete/(:num)', 'Auta::delete/$1');
});

// Detail auta je veřejně přístupný
$routes->get('auta/show/(:num)', 'Auta::show/$1');

// Detail auta s volitelnou barvou (routa se dvěma parametry)
$routes->get('auta/show/(:num)/barva/(:num)', 'Auta::showWithColor/$1/$2');