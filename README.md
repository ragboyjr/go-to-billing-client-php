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
