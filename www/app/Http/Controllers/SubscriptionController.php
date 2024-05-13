<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class SubscriptionController extends Controller
{
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        return response()->json(['status' => 200]);
    }
}
