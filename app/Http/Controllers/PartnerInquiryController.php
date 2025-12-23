<?php

namespace App\Http\Controllers;

use App\Models\PartnerInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PartnerInquiryController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'organization_name' => 'required|string|max:255',
                'contact_person' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'nullable|string|max:255',
                'partnership_interest' => 'required|string',
                'partnership_type' => 'nullable|in:corporate,ngo,media,training,other',
                'message' => 'nullable|string',
            ]);

            PartnerInquiry::create($validated);

            return response()->json([
                'message' => 'Thank you for your inquiry! We will get back to you shortly.'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('Error storing partner inquiry: ' . $th->getMessage());
            return response()->json([
                'message' => 'An error occurred while processing your inquiry. Please try again later.'
            ], 500);
        }
    }
}
