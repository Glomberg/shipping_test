<?php

namespace IlsShippingCalculator\Companies;

/**
 * @psalm-suppress UnusedClass
 */
class SlowDelivery extends AbstractCompany
{
    protected $company_name = 'Slow Delivery Company';

    public function getShippingTotal()
    {
        // Emulate company API request delay
        sleep(1);
        // Calculated delivery cost - 199.99
        $delivery_cost = 199.99;
        // Calculated delivery duration - 8 days
        $delivery_duration = 8;

        return [
            'price' => $delivery_cost,
            'date' => date('Y-m-d', time() + $delivery_duration  * 60 * 60 * 24),
            'error' => ''
        ];
    }
}
