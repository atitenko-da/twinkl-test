<?php

namespace App\Services\MailService\Messages;

use App\Services\MailService\Messages\SubscriptionMessage;

class ParentSubscriptionMessage extends SubscriptionMessage
{
    public function getBody(): string
    {
        return $this->subscription->type;
    }
}
