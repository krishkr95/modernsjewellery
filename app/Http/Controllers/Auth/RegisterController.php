<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $customerRole = Role::where('name', Role::CUSTOMER)->first();

        $user = User::create([
            'name' => $request->string('name'),
            'email' => $request->string('email'),
            'password' => Hash::make($request->string('password')),
            'phone' => $request->string('phone'),
            'role_id' => $customerRole?->id,
            'status' => 'active',
            'last_login_at' => now(),
        ]);

        if ($customerRole) {
            $user->roles()->attach($customerRole->id);
        }

        // Create default personal wishlist
        Wishlist::create([
            'user_id' => $user->id,
            'name' => 'Curated Wishlist',
            'is_public' => false,
        ]);

        Auth::login($user);

        return redirect()->route('customer.dashboard')
            ->with('toast', ['type' => 'success', 'message' => "Welcome to the Modern Jewellery House family, {$user->name}."]);
    }
}
