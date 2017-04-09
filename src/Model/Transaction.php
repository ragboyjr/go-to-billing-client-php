<?php

namespace Ragboyjr\GoToBilling\Model;

abstract class Transaction
{
    public $transaction_type;
    public $invoice_id;
    public $amount;
    public $process_date;
    public $invoice_file;
    public $payment_account_id;
    public $memo;
    public $notes;
    public $occurrence_type;
    public $occurrence_number;
    public $source_description;
    public $module_description;
    public $custom_field;

    public function __construct($transaction_type, $invoice_id, $amount) {
        $this->transaction_type = $transaction_type;
        $this->invoice_id = $invoice_id;
        $this->amount = $amount;
    }
}
