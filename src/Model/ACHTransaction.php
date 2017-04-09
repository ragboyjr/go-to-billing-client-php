<?php

namespace Ragboyjr\GoToBilling\Model;

class ACHTransaction extends Transaction
{
    public $ach_payment_type;
    public $ach_route;
    public $ach_account;
    public $ach_account_type;
    public $ach_serial;
    public $arc_image;
    public $ach_verification;

    public function __construct(
        $transaction_type,
        $invoice_id,
        $amount,
        $ach_payment_type
    ) {
        parent::__construct($transaction_type, $invoice_id, $amount);
        $this->ach_payment_type = $ach_payment_type;
    }
}
