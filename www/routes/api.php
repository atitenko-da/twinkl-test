<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\CheckIP;

Route::get('/subscription', [SubscriptionController::class, 'store'])
                ->middleware(CheckIp::class)
                ->name('subscription');
