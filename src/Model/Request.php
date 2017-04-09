<?php

namespace Ragboyjr\GoToBilling\Model;

class Request
{
    public $merchant;
    public $customer;
    public $transaction;

    public function __construct(Merchant $merchant, Customer $customer, Transaction $transaction) {
        $this->merchant = $merchant;
        $this->customer = $customer;
        $this->transaction = $transaction;
    }
}
