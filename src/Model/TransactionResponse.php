<?php

namespace Ragboyjr\GoToBilling\Model;

use Psr\Http\Message\ResponseInterface;

class TransactionResponse extends Response
{
    public function getTicketId() {
        return $this->parsed_body['ticket_id'];
    }
    public function getStatus() {
        return $this->parsed_body['status'];
    }
    public function isApproved() {
        return $this->getStatus() == TransactionStatus::APPROVED;
    }
    public function isReceived() {
        return $this->getStatus() == TransactionStatus::RECEIVED;
    }
    public function isDeclined() {
        return $this->getStatus() == TransactionStatus::DECLINED;
    }
    public function isCancelled() {
        return $this->getStatus() == TransactionStatus::CANCELLED;
    }
    public function isTimeout() {
        return $this->getStatus() == TransactionStatus::TIMEOUT;
    }
}
