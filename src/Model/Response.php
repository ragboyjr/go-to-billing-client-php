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
}
