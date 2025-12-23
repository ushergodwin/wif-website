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
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:subscribers,email',
                'area_of_interest' => 'nullable|string|max:255',
            ]);

            $validated['subscribed_at'] = now();

            Subscriber::create($validated);

            return response()->json([
                'message' => 'Thank you for joining our community! You have been successfully subscribed to our newsletter.'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error subscribing user: ' . $th->getMessage());
            return response()->json([
                'message' => 'An error occurred while processing your subscription. Please try again later.'
            ], 500);
        }
    }
}
