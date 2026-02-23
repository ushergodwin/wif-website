<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscriberController extends Controller
{
    public function create()
    {
        return view('subscribers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'area_of_interest' => 'nullable|string|max:255',
        ]);

        // Already subscribed — treat as success so the user isn't confused
        if (Subscriber::where('email', $validated['email'])->exists()) {
            return response()->json([
                'message' => 'You are already subscribed to our newsletter. Thank you!'
            ]);
        }

        try {
            $validated['subscribed_at'] = now();
            Subscriber::create($validated);

            return response()->json([
                'message' => 'Thank you for joining our community! You have been successfully subscribed to our newsletter.'
            ]);
        } catch (\Throwable $th) {
            Log::error('Error subscribing user: ' . $th->getMessage());
            return response()->json([
                'message' => 'An error occurred while processing your subscription. Please try again later.'
            ], 500);
        }
    }
}
