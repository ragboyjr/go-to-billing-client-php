<?php

namespace Ragboyjr\GoToBilling\Model;

final class TransactionStatus
{
    const APPROVED = 'G';
    const RECEIVED = 'R';
    const DECLINED = 'D';
    const CANCELLED = 'C';
    const TIMEOUT = 'T';
    const INVALID_DEBUG_CARD_NUMBER = 'E';
}
