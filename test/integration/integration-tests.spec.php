<?php

use Ragboyjr\GoToBilling\{
    GoToBillingApi,
    Config,
    GoToBillingSoapApi,
    Model\Request,
    Model\Merchant,
    Model\TransactionType,
    Model\Card,
    Model\Customer,
    Model\CCTransaction,
    Provider\Pimple\GoToBillingServiceProvider
};

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

beforeEach(function() {
    $container = new Pimple\Container();
    $container->register(new GoToBillingServiceProvider());
    $this->container = $container;
});

describe('CC Transactions', function() {
    it('can perform auth-capture', function() {
        $gtb = $this->container[GoToBillingApi::class];

        $merchant = new Merchant('127.0.0.1');
        $customer = new Customer('_gtb_client_test');
        $customer->first_name = "Test";
        $customer->last_name = "Account";
        $cc = CCTransaction::createWithCard(
            TransactionType::AUTHORIZE_CAPTURE,
            uniqid(),
            '123.40',
            new Card('370000000000002', date('my', strtotime('+1 year')), '999')
        );

        $resp = $gtb->transact(new Request($merchant, $customer, $cc));

        assert($resp->isApproved());
    });
    it('can perform auth, then a subsequent capture', function() {
        $this->container->extend(Config::class, function($config) {
            $config->debug = false;
            return $config;
        });
        $gtb = $this->container[GoToBillingApi::class];

        $merchant = new Merchant('127.0.0.1');
        $customer = new Customer('_gtb_client_test');
        $customer->first_name = "Test";
        $customer->last_name = "Account";
        $customer->zip = '55555';
        $invoice_id = uniqid();
        $amount = '123.40';
        $cc = CCTransaction::createWithCard(
            TransactionType::AUTHORIZE_ONLY,
            $invoice_id,
            $amount,
            new Card('4111111111111111', date('my', strtotime('+1 year')), '123', null)
        );

        $resp = $gtb->transact(new Request($merchant, $customer, $cc));
        if (!$resp->isApproved()) {
            dump($resp);
            throw new RuntimeException('CC Transaction was not approved.');
        }

        $ticket_id = $resp->getTicketId();

        $cc = CCTransaction::createWithTicketId(
            TransactionType::CAPTURE_ONLY,
            $invoice_id,
            $amount,
            $ticket_id
        );

        $resp = $gtb->transact(new Request($merchant, $customer, $cc));
        assert($resp->isApproved());
    });
});
