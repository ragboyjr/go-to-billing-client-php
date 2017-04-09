<?php

namespace Ragboyjr\GoToBilling;

interface GoToBillingApi {
    public function transact(Model\Request $request);
}
