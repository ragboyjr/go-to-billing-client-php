<?php

namespace Ragboyjr\GoToBilling\Model;

class Customer
{
    public $customer_id;
    public $company;
    public $last_name;
    public $first_name;
    public $address1;
    public $address2;
    public $city;
    public $state;
    public $zip;
    public $phone;
    public $email;

    public function __construct($customer_id) {
        $this->customer_id = $customer_id;
    }
}
