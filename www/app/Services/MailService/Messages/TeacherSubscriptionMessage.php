<?php

namespace App\Services\MailService\Messages;

use App\Services\MailService\Messages\SubscriptionMessage;

class TeacherSubscriptionMessage extends SubscriptionMessage
{
    public function getBody(): string
    {
        return $this->subscription->type;
    }
}
