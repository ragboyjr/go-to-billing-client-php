<?php

namespace Ragboyjr\GoToBilling\Model;

final class TransactionType
{
    const TOKENIZE = 'TK';

    // card types
    const AUTHORIZE_ONLY = 'AS';
    const CAPTURE_ONLY = 'DS';
    const AUTHORIZE_CAPTURE = 'ES';
    const CREDIT_REFUND = 'CR';
    const VOID = 'VO';
    const AVS_CHECK_ONLY = 'AV';
    const OFFLINE = 'OF';

    // ach types
    const ELECTRONIC_CHECK_DEBIT = 'DH';
    const ELECTRONIC_CHECK_CREDIT = 'DC';
    const ELECTRONIC_CHECK_VERIFICATION_ONLY = 'DV';

    const REMOVE_TRANSACTION = 'RM';
}
