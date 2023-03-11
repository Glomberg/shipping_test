<?php

namespace IlsShippingCalculator\Companies;

abstract class AbstractCompany
{
    /**
     * Company name have to be overridden in the child class
     * @var string
     */
    protected $company_name = 'Delivery Company';

    /**
     * @var int|null
     * @psalm-suppress PossiblyUnusedProperty
     */
    protected $fromKladr;

    /**
     * @var int|null
     * @psalm-suppress PossiblyUnusedProperty
     */
    protected $toKladr;

    /**
     * @var float|null
     * @psalm-suppress PossiblyUnusedProperty
     */
    protected $weight;

    /**
     * @param array $data Incoming data
     * @psalm-suppress PossiblyUnusedMethod
     */
    public function __construct($data)
    {
        $this->fromKladr = isset($data['from']) ? (int) $data['from'] : null;
        $this->toKladr = isset($data['to']) ? (int) $data['to'] : null;
        $this->weight = isset($data['weight']) ? (float) $data['weight'] : null;
    }

    /**
     * Getter for $this->company_name
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->company_name;
    }

    /**
     * Main logic for calculating shipping cost value
     *
     * @return array
     */
    abstract public function getShippingTotal();
}
