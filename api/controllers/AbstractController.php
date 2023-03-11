<?php

namespace IlsShippingCalculator\Controllers;

use IlsShippingCalculator\Response;

abstract class AbstractController
{
    /**
     * @var array
     */
    protected $data;

    protected $delivery_companies = [
        'FastDelivery',
        'SlowDelivery'
    ];

    /**
     * @var Response
     */
    protected $response;

    public function __construct()
    {
        $this->data = $_POST;
        $this->response = $this->getResponse();
        try {
            $this->processData($this->response);
        } catch (\RuntimeException $e) {
            $this->response->data['error'] = $e->getMessage();
        }
        $this->doResponse();
    }

    /**
     * Output the data
     *
     * @return void
     */
    private function doResponse()
    {
        echo $this->response->toJson();
        die();
    }

    /**
     * Getting response object
     *
     * @return Response
     */
    private function getResponse()
    {
        return new Response();
    }

    /**
     * Getting available transports companies
     *
     * @return array Array of the Companies objects or empty array
     */
    protected function getCompanies($concrete_company = null)
    {
        if ( ! is_array($this->delivery_companies) && ! count($this->delivery_companies) ) {
            return [];
        }
        $companies_objects = [];
        foreach ( $this->delivery_companies as $company ) {
            if ( $concrete_company && $concrete_company !== $company ) {
                continue;
            }
            $company_class = '\IlsShippingCalculator\Companies\\' . $company;
            if ( class_exists($company_class) ) {
                $companies_objects[$company] = new $company_class($this->data);
            }
        }
        return $companies_objects;
    }

    /**
     * Modify response
     *
     * @return void
     */
    abstract protected function processData(Response $response);
}
