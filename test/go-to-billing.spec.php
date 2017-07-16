<?php

use Ragboyjr\GoToBilling;

describe(GoToBilling::class, function() {
    describe('Model', function() {
        require_once __DIR__ . '/model.php';
    });
    describe('Provider', function() {
        describe('Laravel', function() {
            it('registers services in Laravel container', function() {
                $container = new Illuminate\Container\Container();
                $provider = new GoToBilling\Provider\Laravel\GoToBillingServiceProvider($container);
                $provider->register();
                assert($container->bound(GoToBilling\GoToBillingApi::class));
            });
        });
    });
});
