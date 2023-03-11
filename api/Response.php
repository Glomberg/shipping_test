<?php

namespace IlsShippingCalculator;

class Response
{
    public $data;

    public function toJson()
    {
        return json_encode($this->data, JSON_FORCE_OBJECT);
    }
}
