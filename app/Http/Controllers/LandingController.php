<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing.index');
    }

    public function templates()
    {
        return view('landing.templates');
    }

    public function handleDemoRequest(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country_code' => 'required|string|max:10',
            'phone' => 'required|string|regex:/^[0-9]{10}$/',
            'business_name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'business_status' => 'required|string|max:255',
            'target_url' => 'nullable|string'
        ]);

        try {
            $adminEmail = config('app.admin_email');
            $senderEmail = config('mail.from.address');
            $appName = config('app.name');

            $fullPhone = $validated['country_code'] . ' ' . $validated['phone'];

            $messageContent = "New Demo Request Received for {$appName}:\n\n" .
                             "Name: {$validated['name']}\n" .
                             "Country: {$validated['country']}\n" .
                             "Email: {$validated['email']}\n" .
                             "Phone: {$fullPhone}\n" .
                             "Business: {$validated['business_name']}\n" .
                             "Business Type: {$validated['business_status']}\n" .
                             "Requested Demo: {$validated['target_url']}\n\n" .
                             "Timestamp: " . now()->format('Y-m-d H:i:s');

            Mail::raw($messageContent, function ($message) use ($adminEmail, $appName) {
                $message->to($adminEmail)
                        ->subject("New Lead: Demo Request from {$appName}");
            });

            return response()->json(['success' => true, 'message' => 'Request submitted successfully.']);
        } catch (\Exception $e) {
            \Log::error('Mail Error: ' . $e->getMessage());
            // We still return success to the user so they can see the demo, 
            // but log the error for the developer.
            return response()->json(['success' => true, 'message' => 'Request processed (Mail logged).']);
        }
    }
}
