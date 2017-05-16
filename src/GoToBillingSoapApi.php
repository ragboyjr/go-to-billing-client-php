<?php

namespace Ragboyjr\GoToBilling;

interface GoToBillingSoapApi {
    /** @return \SoapClient */
    public function getSoapClient();
    /** delegate to the soap methods, but inject the merchant auth as first paremeter */
    public function __call($method, array $params);
}
