<?php

namespace Ragboyjr\GoToBilling\Model;

use Ragboyjr\GoToBilling\Config;

class Merchant
{
    public $merchant_id;
    public $merchant_pin;
    public $ip_address;
    public $relay_url;
    public $relay_type;
    public $debug;

    public function __construct($ip_address) {
        $this->ip_address = $ip_address;
    }

    public function fillWithConfig(Config $config) {
        if ($this->merchant_id === null) {
            $this->merchant_id = $config->merchant_id;
        }
        if ($this->merchant_pin === null) {
            $this->merchant_pin = $config->merchant_pin;
        }
        if ($this->debug === null) {
            $this->debug = $config->debug;
        }
    }
}
