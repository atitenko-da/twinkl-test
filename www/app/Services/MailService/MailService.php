<?php

namespace App\Services\MailService;

use App\Services\MailService\Messages\SubscriptionMessage;

class MailService
{
    public function sendMessage(SubscriptionMessage $message): bool
    {
        return mail($message->getTo(), $message->getSubject(), $message->getBody());
    }
}
