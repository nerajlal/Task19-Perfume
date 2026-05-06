<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $tenants = User::where('type', 'admin')->get();
        return view('super_admin.dashboard', compact('tenants'));
    }

    public function createTenant()
    {
        return view('super_admin.create_tenant');
    }

    public function storeTenant(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'site_name' => 'required|string|max:255',
        ]);

        // Create Tenant
        $tenant = \App\Models\Tenant::create([
            'name' => $validated['site_name'],
        ]);

        // Create Tenant Admin User
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'type' => 'admin',
            'site_name' => $validated['site_name'],
            'tenant_id' => $tenant->id,
        ]);

        return redirect()->route('super_admin.dashboard')->with('success', 'Tenant Admin created successfully.');
    }
}
