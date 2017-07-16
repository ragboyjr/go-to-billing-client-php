<?php

namespace Ragboyjr\GoToBilling\Model;

class CCTransaction extends Transaction
{
    use CardFields;

    public $ticket_id;
    public $authorization;
    public $trackdata;

    public static function createWithCard($transaction_type, $invoice_id, $amount, Card $card) {
        $trans = new self($transaction_type, $invoice_id, $amount);
        foreach ($card as $key => $value) {
            $trans->{$key} = $value;
        }
        return $trans;
    }

    public static function createWithTicketId($transaction_type, $invoice_id, $amount, $ticket_id) {
        $trans = new self($transaction_type, $invoice_id, $amount);
        $trans->ticket_id = $ticket_id;
        return $trans;
    }
}
