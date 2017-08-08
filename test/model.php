<?php

use Ragboyjr\GoToBilling;
use Ragboyjr\GoToBilling\{
    Model\TransactionType,
    Model\TransactionStatus
};
use GuzzleHttp\Psr7;

describe('CCTransaction', function() {
    it('can be created from a card', function() {
        $tran = GoToBilling\Model\CCTransaction::createWithCard(
            TransactionType::AUTHORIZE_ONLY,
            '1234',
            '12.34',
            new GoToBilling\Model\Card('42222', '0419')
        );
        assert($tran->cc_number == '42222' && $tran->cc_exp == '0419');
    });
    it('can be created from a ticket id', function() {
        $tran = GoToBilling\Model\CCTransaction::createWithTicketId(
            TransactionType::CAPTURE_ONLY,
            '1234',
            '12.34',
            '4321'
        );
        assert($tran->invoice_id == '1234' && $tran->ticket_id == '4321');
    });
    it('can be created from a payment token id', function() {
        $tran = GoToBilling\Model\CCTransaction::createWithPaymentTokenId(
            TransactionType::CAPTURE_ONLY,
            '1234',
            '12.34',
            '4321'
        );
        assert($tran->invoice_id == '1234' && $tran->payment_token_id == '4321');
    });
});
describe('TransactionResponse', function() {
    describe('isApproved', function() {
        it('returns true if transaction status is approved', function() {
            $resp = new GoToBilling\Model\TransactionResponse(new Psr7\Response(), [
                'status' => TransactionStatus::APPROVED
            ]);
            assert($resp->isApproved());
        });
    });
});
