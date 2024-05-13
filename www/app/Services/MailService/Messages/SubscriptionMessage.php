<?php

namespace App\Services\MailService\Messages;

use App\Models\Subscription;

abstract class SubscriptionMessage
{
    public function __construct(
        protected Subscription $subscription,
    ) {}

    public function getTo(): string
    {
        return $this->subscription->email;
    }

    public function getSubject(): string
    {
        return 'Subscription';
    }

    abstract public function getBody(): string;
}
