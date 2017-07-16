# Go To Billing API Client

Simple PHP Client for interacting with the Go To Billing API.

## Installation

Install with composer at `ragboyjr/go-to-billing-client`

## Usage

```php
<?php

use Ragboyjr\GoToBilling;

$client = new GoToBilling\GuzzleGoToBillingApiClient(
    new GoToBilling\Config($user, $pin, $debug = $true)
);

$merchant = new GoToBilling\Model\Merchant('127.0.0.1');
$customer = new GoToBilling\Model\Customer('0');
$customer->first_name = "RJ";
$customer->last_name = "Garcia";
$ach = new GoToBilling\Model\ACHTransaction('DH', '1', '1.00', GoToBilling\Model\ACHPaymentType::WEB);
$ach->ach_account = '000123456789';
$ach->ach_route = '110000000';
$ach->ach_account_type = GoToBilling\Model\ACHAccountType::PERSONAL_CHECKING;
$ach->ach_verification = true;

$resp = $client->transact(new GoToBilling\Model\Request($merchant, $customer, $ach));
var_dump($resp->getBody());
```

This will print something out like:

```
array(7) {
  ["status"]=>
  string(1) "R"
  ["order_number"]=>
  string(29) "238665-20170408-58e982c1d0607"
  ["term_code"]=>
  string(1) "0"
  ["tran_amount"]=>
  string(4) "1.00"
  ["tran_date"]=>
  string(8) "20170408"
  ["tran_time"]=>
  string(6) "193929"
  ["invoice_id"]=>
  string(1) "1"
}
```

The Model objects reflect the GoToBilling documentation request fields. You can look through the source code to see the supported request types.

### Transaction Responses

Transaction Responses also have a few helper methods for grabbing data from the response. Here's an example with a CC auth and capture using the same client and merchant details as above.

```php
<?php

$cc = CCTransaction::createWithCard(
    TransactionType::AUTHORIZE_CAPTURE,
    uniqid(),
    '123.40',
    new Card('370000000000002', '0521', '999')
);

$resp = $client->transact(new Request($merchant, $customer, $cc));

$resp->getTicketId(); // return the ticket id
$resp->getStatus(); // return the transaction status
$resp->isApproved(); // check if status is approved
$resp->isReceived(); // check if status is received
$resp->isDeclined(); // check if status is declined
$resp->isCancelled(); // check if status is cancelled
$resp->isTimeout(); // check if status is timeout
```

### Soap Api

You can also utilize the soap api with the `GoToBillingSoapApiClient`

```php
<?php

use Ragboyjr\GoToBilling;

$client = GoToBilling\GoToBillingSoapApiClient::createFromConfig(
    new GoToBilling\Config($user, $pin, $debug = $true)
);
$client->getAccounts();
$client->getTransactions([
    'po_number' => '1234'
]);
// return the inner soap client
$soap = $client->getSoapClient();
```

The SoapApiClient will forward all calls to the internal php SoapClient class. However, it will inject an instance of `Ragboyjr\GoToBilling\Model\Soap\MerchantAuth` as the first parameter so that you don't have to for each call.

### Pimple Service Provider

You can also use the Pimple service provider to create the services.

```php
<?php

use Ragboyjr\GoToBilling;

// you can use these env vars to configure the GoToBilling\Config entity or just extend it in pimple.
putenv('GO_TO_BILLING_MERCHANT_ID={id}');
putenv('GO_TO_BILLING_MERCHANT_PIN={pin}');
putenv('GO_TO_BILLING_DEBUG=1');

$pimple->register(new GoToBilling\Provider\Pimple\GoToBillingServiceProvider(), [
    'ragboyjr.go_to_billing.soap_options' => [
        // any SoapClient options can go here
    ]
]);
$rest_api = $pimple[GoToBilling\GoToBillingApi::class];
$soap_api = $pimple[GoToBilling\GoToBillingSoapApi::class];
```

### Laravel Service Provider

```php
<?php

use Ragboyjr\GoToBilling\Provider\Laravel\GoToBillingServiceProvider;

// in your app service provider
$this->app->register(GoToBillingServiceProvider::class);
// configure soap options
$this->app['config']->set('go_to_billing.soap_options', [
    // soap options go here
]);

// then you can use the following services
$rest_api = app('Ragboyjr\GoToBilling\GoToBillingApi');
$soap_api = app('Ragboyjr\GoToBilling\GoToBillingSoapApi');
```
