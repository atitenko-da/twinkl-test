<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Models\Subscription;
use App\Services\MailService\MailService;
use App\Http\Requests\SubscriptionRequest;

class SubscriptionController extends Controller
{
    public function __construct(
        protected MailService $mailService,
    ) {}

    public function store(SubscriptionRequest $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();
        $subscription = Subscription::create($validated);
        $message = $this->mailService->createMessage($subscription);
        $this->mailService->sendMessage($message);

        return response()->json([
            'status' => 200,
            'validated' => $validated,
            'id' => $subscription->id,
            'message' => $message->getBody(),
        ]);
    }
}
