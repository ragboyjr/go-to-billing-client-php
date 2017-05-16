<?php

namespace Ragboyjr\GoToBilling\Model\Soap;

class MerchantAuth {
    public $login;
    public $pin;
    public $source_description;
    public $module_description;

    public function __construct($login, $pin) {
        $this->login = $login;
        $this->pin = $pin;
    }
}
