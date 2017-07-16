<?php

namespace Ragboyjr\GoToBilling\Provider\Laravel;

use Illuminate\Support\ServiceProvider;
use Ragboyjr\GoToBilling;

class GoToBillingServiceProvider extends ServiceProvider
{
    public function register() {
        $this->app->singleton(GoToBilling\GoToBillingApi::class, function($c) {
            return new GoToBilling\GuzzleGoToBillingApiClient($c->make(GoToBilling\Config::class));
        });
        $this->app->singleton(GoToBilling\GoToBillingSoapApi::class, function($c) {
            return GoToBilling\GoToBillingSoapApiClient::createFromConfig(
                $c[GoToBilling\Config::class],
                $c['config']->get('go_to_billing.soap_options', [])
            );
        });
        $this->app->singleton(GoToBilling\Config::class, function($c) {
            return new GoToBilling\Config(
                getenv('GO_TO_BILLING_MERCHANT_ID'),
                getenv('GO_TO_BILLING_MERCHANT_PIN'),
                (bool) getenv('GO_TO_BILLING_DEBUG')
            );
        });
        $c['ragboyjr.go_to_billing.soap_options'] = [];
    }
}
