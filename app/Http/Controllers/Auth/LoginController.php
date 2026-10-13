<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $user->update(['last_login_at' => now()]);

            if ($user->hasRole(['SUPER_ADMIN', 'ADMIN', 'MANAGER', 'STAFF'])) {
                return redirect()->intended(route('admin.dashboard'))
                    ->with('toast', ['type' => 'success', 'message' => "Welcome back, {$user->name}."]);
            }

            return redirect()->intended(route('customer.dashboard'))
                ->with('toast', ['type' => 'success', 'message' => "Welcome to Modern Jewellery House, {$user->name}."]);
        }

        throw ValidationException::withMessages([
            'email' => __('These credentials do not match our records.'),
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('toast', ['type' => 'info', 'message' => 'You have been signed out safely.']);
    }
}
