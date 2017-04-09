<?php

namespace Ragboyjr\GoToBilling;

class Config
{
    public $merchant_id;
    public $merchant_pin;
    public $debug;

    public function __construct($id, $pin, $debug) {
        $this->merchant_id = $id;
        $this->merchant_pin = $pin;
        $this->debug = $debug;
    }
}
