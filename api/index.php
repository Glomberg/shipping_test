<?php

namespace IlsShippingCalculator;

header('Content-Type: application/json');

if ( PHP_SAPI === 'cli' ) {
    http_response_code(403);
    die();
}

$allowed_methods = [
    'POST'
];

if ( ! in_array(strtoupper($_SERVER['REQUEST_METHOD']), $allowed_methods) ) {
    http_response_code(403);
    die();
}

require_once '../vendor/autoload.php';

$route = str_replace('/api', '', $_SERVER['REQUEST_URI']);

if ( ! $route ) {
    http_response_code(403);
    die();
}

define('ILS_APP_STARTED', true);

switch ($route) {
    // Endpoints for the web application
    case '/':
        return new \IlsShippingCalculator\Controllers\IndexController();
    case '/get_price':
        return new \IlsShippingCalculator\Controllers\GetPriceController();
    case '/get_companies':
        return new \IlsShippingCalculator\Controllers\GetCompaniesController();
    // Endpoints for the transports company emulation
}

http_response_code(404);
die();
