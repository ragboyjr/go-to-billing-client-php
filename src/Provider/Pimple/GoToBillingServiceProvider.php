<?php

namespace Ragboyjr\GoToBilling\Provider\Pimple;

use Pimple;
use Ragboyjr\GoToBilling;

class GoToBillingServiceProvider implements Pimple\ServiceProviderInterface
{
    public function register(Pimple\Container $c) {
        $c[GoToBilling\GoToBillingApi::class] = function($c) {
            return new GoToBilling\GuzzleGoToBillingApiClient($c[GoToBilling\Config::class]);
        };
        $c[GoToBilling\GoToBillingSoapApi::class] = function($c) {
            return GoToBilling\GoToBillingSoapApiClient::createFromConfig(
                $c[GoToBilling\Config::class],
                $c['ragboyjr.go_to_billing.soap_options']
            );
        };
        $c[GoToBilling\Config::class] = function($c) {
            return new GoToBilling\Config(
                getenv('GO_TO_BILLING_MERCHANT_ID'),
                getenv('GO_TO_BILLING_MERCHANT_PIN'),
                (bool) getenv('GO_TO_BILLING_DEBUG')
            );
        };
        $c['ragboyjr.go_to_billing.soap_options'] = [];
    }
}
