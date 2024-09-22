<?php

require './router/router.php';
require './Travel/controller_travel.php';
require './Country/controller_country.php';

$router = new Router();
$countryController = new CountryController();
$travelController = new TravelController();

$router->addRoute(['GET'], '/countries', [$countryController, 'get']);
$router->addRoute(['POST'], '/countries', [$countryController, 'insert']);

$router->addRoute(['GET'], '/trips', [$travelController, 'get']);
$router->addRoute(['POST'], '/trips', [$travelController, 'insert']);

$router->addRoute('GET', '/', function () use ($travelController, $countryController) {
    $travelController->filter();
    $countryController->manage();
    $travelController->manage();
});

$router->dispatch();
