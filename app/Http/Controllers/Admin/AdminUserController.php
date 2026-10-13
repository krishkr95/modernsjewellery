<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(): View
    {
        Gate::authorize('manage-users');

        $users = User::whereHas('role', function ($q) {
            $q->whereIn('name', ['SUPER_ADMIN', 'ADMIN', 'MANAGER', 'STAFF']);
        })->with('role')->latest()->get();

        $roles = Role::whereIn('name', ['SUPER_ADMIN', 'ADMIN', 'MANAGER', 'STAFF'])->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('manage-users');

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role_id' => ['required', 'exists:roles,id'],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
            'phone' => $validated['phone'] ?? null,
            'status' => 'active',
        ]);

        AdminActivityLog::record("Created admin user '{$user->name}' [Role ID: {$user->role_id}]", $user);

        return back()->with('toast', ['type' => 'success', 'message' => 'Administrator account created.']);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        Gate::authorize('manage-users');

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role_id' => ['required', 'exists:roles,id'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id'],
            'phone' => $validated['phone'] ?? null,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->string('password'));
        }

        $user->update($updateData);

        AdminActivityLog::record("Updated admin user credentials for '{$user->name}'", $user);

        return back()->with('toast', ['type' => 'success', 'message' => 'User profile updated.']);
    }

    public function destroy(User $user): RedirectResponse
    {
        Gate::authorize('manage-users');

        if ($user->id === auth()->id()) {
            return back()->with('toast', ['type' => 'error', 'message' => 'You cannot delete your active session user.']);
        }

        $name = $user->name;
        $user->delete();

        AdminActivityLog::record("Revoked and deleted admin user '{$name}'");

        return back()->with('toast', ['type' => 'success', 'message' => 'Administrator account revoked.']);
    }
}
