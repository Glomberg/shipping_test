<?php

namespace IlsShippingCalculator\Controllers;

use IlsShippingCalculator\Companies\AbstractCompany;
use IlsShippingCalculator\Response;

class GetCompaniesController extends AbstractController
{
    protected function processData(Response $response)
    {
        $companies = $this->getCompanies();
        if ( ! count($companies) ) {
            throw new \RuntimeException('No delivery companies found');
        }

        $companies_names = [];
        foreach ( $companies as $company_id => $_company ) {
            /** @var AbstractCompany $company */
            $company = $_company;
            $companies_names[$company_id] = $company->getCompanyName();
        }

        $response->data['companies'] = $companies_names;
    }
}
