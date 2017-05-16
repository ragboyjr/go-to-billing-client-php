<?php

namespace Ragboyjr\GoToBilling;

use SoapClient;

class GoToBillingSoapApiClient implements GoToBillingSoapApi
{
    const WSDL_URL = 'https://secure.gotobilling.com/gateway/services/1.4/soap.php?wsdl';

    private $auth;
    private $client;

    public function __construct(Model\Soap\MerchantAuth $auth, SoapClient $client) {
        $this->auth = $auth;
        $this->client = $client;
    }

    public function getSoapClient() {
        return $this->client;
    }

    public function __call($method, array $params) {
        array_unshift($params, $this->auth);
        return $this->client->__call($method, $params);
    }

    public static function createFromConfig(Config $config, array $soap_options = []) {
        return new self(
            new Model\Soap\MerchantAuth($config->merchant_id, $config->merchant_pin),
            new SoapClient(self::WSDL_URL, $soap_options)
        );
    }
}
