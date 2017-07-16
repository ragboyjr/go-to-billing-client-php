<?php

namespace Ragboyjr\GoToBilling\Model;

use Psr\Http\Message\ResponseInterface;

class Response
{
    public $response;
    public $parsed_body;

    public function __construct(ResponseInterface $response, $parsed_body = null) {
        $this->response = $response;
        $this->parsed_body = $parsed_body;
    }

    public function getBody() {
        return $this->parsed_body ?: $this->response->getBody();
    }

    public function getHttpResponse() {
        return $this->response;
    }

    public function getStatus() {
        return $this->parsed_body['status'];
    }

    public function isApproved() {
        return $this->getStatus() == Model\TransactionStatus::APPROVED;
    }
    public function isReceived() {
        return $this->getStatus() == Model\TransactionStatus::RECEIVED;
    }
    public function isDeclined() {
        return $this->getStatus() == Model\TransactionStatus::DECLINED;
    }
    public function isCancelled() {
        return $this->getStatus() == Model\TransactionStatus::CANCELLED;
    }
    public function isTimeout() {
        return $this->getStatus() == Model\TransactionStatus::TIMEOUT;
    }
}
