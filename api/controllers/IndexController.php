<?php

namespace IlsShippingCalculator\Controllers;

use IlsShippingCalculator\Response;

class IndexController extends AbstractController
{
    protected function processData(Response $response)
    {
        /**
         * Just for example
         */
        $response->data = ['example' => 'OK'];
    }
}
