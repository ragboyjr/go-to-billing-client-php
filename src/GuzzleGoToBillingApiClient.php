<?php

namespace Ragboyjr\GoToBilling;

use GuzzleHttp;
use Krak\Marshal;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

class GuzzleGoToBillingApiClient implements GoToBillingApi
{
    private $config;
    private $encoder;

    public function __construct(Config $config, GuzzleHttp\ClientInterface $client = null) {
        $this->config = $config;
        $this->client = $client ?: self::guzzleClient();
        $this->encoder = new XmlEncoder();
    }

    public function transact(Model\Request $request) {
        $request->merchant->fillWithConfig($this->config);
        $filter = function($v) { return $v !== null; };
        $data = array_filter(array_merge(
            get_object_vars($request->merchant),
            get_object_vars($request->customer),
            get_object_vars($request->transaction)
        ), $filter);
        $m = Marshal\keyMap(function($key) {
            if ($key == 'merchant_pin' || $key == 'merchant_id' || $key == 'ip_address') {
                return $key;
            }

            return 'x_' . $key;
        });
        $response = $this->client->request('POST', 'transact.php', [
            'form_params' => $m($data),
        ]);

        $data = (string) $response->getBody();
        $data = $this->encoder->decode($data, 'xml');

        return new Model\TransactionResponse($response, $data);
    }

    public static function guzzleClient() {
        return new GuzzleHttp\Client([
            'base_uri' => 'https://secure.gotobilling.com/os/system/gateway/',
            'http_errors' => false,
        ]);
    }
}
