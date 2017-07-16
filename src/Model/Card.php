<?php

namespace Ragboyjr\GoToBilling\Model;

class Card
{
    use CardFields;

    public function __construct($cc_number, $cc_exp, $cc_cvv = null, $cc_type = null, $cc_name = null) {
        $this->cc_number = $cc_number;
        $this->cc_exp = $cc_exp;
        $this->cc_cvv = $cc_cvv;
        $this->cc_type = $cc_type;
        $this->cc_name = $cc_name;
    }
}
