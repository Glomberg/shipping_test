<?php

namespace IlsShippingCalculator\Companies;

/**
 * @psalm-suppress UnusedClass
 */
class FastDelivery extends AbstractCompany
{
    protected $company_name = 'Fast Delivery Company';

    public function getShippingTotal()
    {
        // Emulate company API request delay
        sleep(1);
        // Calculated delivery cost - 299.99
        $delivery_cost = 299.99;
        // Calculated delivery duration - 5 days
        $delivery_duration = 5;

        return [
            'price' => $delivery_cost,
            'period' => $delivery_duration,
            'error' => ''
        ];
    }
}
