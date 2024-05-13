<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\CheckIP;
use App\Models\Subscription;
use App\Http\Resources\SubscriptionCollection;

Route::post('/subscription', [SubscriptionController::class, 'store'])
                ->middleware(CheckIp::class)
                ->name('subscription');

Route::get('/subscriptions', function () {
    return new SubscriptionCollection(Subscription::all());
});
