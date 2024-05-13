<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Enum\UserTypeEnum;
use App\Models\Subscription;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Services\MailService\MailService;

class SubscriptionController extends Controller
{
    public function __construct(
        protected MailService $mailService,
    ) {}

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'alpha:ascii', 'max:255'],
            'last_name' => ['required', 'alpha:ascii', 'max:255'],
            'email' => ['required', 'email:rfc,dns', 'unique:subscriptions', 'max:100'],
            'type' => ['required', Rule::enum(UserTypeEnum::class)],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $validated = $validator->validated();
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
