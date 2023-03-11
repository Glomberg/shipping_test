<?php

namespace IlsShippingCalculator\Controllers;

use IlsShippingCalculator\Companies\AbstractCompany;
use IlsShippingCalculator\Response;

class GetPriceController extends AbstractController
{
    protected function processData(Response $response)
    {
        if ( ! isset($this->data['from']) ) {
            throw new \RuntimeException('From parameter not provided');
        }
        if ( ! isset($this->data['to']) ) {
            throw new \RuntimeException('To parameter not provided');
        }
        if ( ! isset($this->data['weight']) ) {
            throw new \RuntimeException('Weight parameter not provided');
        }
        if ( ! isset($this->data['company']) ) {
            throw new \RuntimeException('Company parameter not provided');
        }

        if ( $this->data['company'] === 'all' ) {
            $companies = $this->getCompanies();
        } else {
            $companies = $this->getCompanies($this->data['company']);
        }


        if ( ! count($companies) ) {
            throw new \RuntimeException('No delivery companies found');
        }

        foreach ( $companies as $company_id => $_company ) {
            /** @var AbstractCompany $company */
            $company = $_company;
            $shipping_total = $this->normalizeShippingTotal($company->getShippingTotal());
            $response->data[$company_id] = $shipping_total;
        }
    }

    private function normalizeShippingTotal($shipping_total)
    {
        $delivery_cost = $shipping_total['price'] ?? 0;
        $delivery_date = '';
        if ($shipping_total['date']) {
            $delivery_date = date('Y-m-d', strtotime($shipping_total['date']));
        }
        if ($shipping_total['period']) {
            $delivery_date = date('Y-m-d', time() + $shipping_total['period']  * 60 * 60 * 24);
        }
        $delivery_error = $shipping_total['error'] ?? '';
        return [
            'price' => $delivery_cost,
            'date' => $delivery_date,
            'error' => $delivery_error
        ];
    }
}
