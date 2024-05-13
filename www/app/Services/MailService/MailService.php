<?php

namespace App\Services\MailService;

use App\Services\MailService\Messages\SubscriptionMessage;
use App\Services\MailService\Messages\ParentSubscriptionMessage;
use App\Services\MailService\Messages\StudentSubscriptionMessage;
use App\Services\MailService\Messages\TeacherSubscriptionMessage;
use App\Services\MailService\Messages\TutorSubscriptionMessage;
use App\Models\Subscription;
use App\Enum\UserTypeEnum;

class MailService
{
    public function createMessage(Subscription $subscription): SubscriptionMessage
    {
        switch ($subscription->type) {
            case UserTypeEnum::PARENT:
                $message = new ParentSubscriptionMessage($subscription);
                break;
            case UserTypeEnum::STUDENT:
                $message = new StudentSubscriptionMessage($subscription);
                break;
            case UserTypeEnum::TEACHER:
                $message = new TeacherSubscriptionMessage($subscription);
                break;
            case UserTypeEnum::TUTOR:
            default:
                $message = new TutorSubscriptionMessage($subscription);
        }

        return $message;
    }

    public function sendMessage(SubscriptionMessage $message): bool
    {
        return mail($message->getTo(), $message->getSubject(), $message->getBody());
    }
}
