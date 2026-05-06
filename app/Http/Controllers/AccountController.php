<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use App\Models\UserAddress;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $address = $user->defaultAddress ?? $user->addresses()->first();
        
        return view('nurah.account.index', compact('user', 'address'));
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string|max:20',
            'address_line1' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:100',
        ]);

        $user = Auth::user();

        // Updating or Creating logic. Simple approach: assume we are editing the default address or creating a new one as default
        $address = $user->defaultAddress ?? $user->addresses()->first();

        if ($address) {
            $address->update($request->all());
        } else {
            $user->addresses()->create(array_merge($request->all(), ['is_default' => true]));
        }

        return back()->with('success', 'Address updated successfully.');
    }

    public function orders()
    {
        $orders = \App\Models\Order::where('user_id', Auth::id())->with(['items.product', 'items.bundle'])->orderBy('created_at', 'desc')->get();
        return view('nurah.account.orders', compact('orders'));
    }
}
