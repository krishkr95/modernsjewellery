<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Upload and update authenticated user's profile avatar.
     */
    public function updateAvatar(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'avatar' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,webp,gif',
                'max:5120', // Max 5MB
            ],
        ], [
            'avatar.required' => 'Please select an image file to upload.',
            'avatar.image' => 'The selected file must be a valid image.',
            'avatar.mimes' => 'Profile picture must be a file of type: jpeg, png, jpg, webp, gif.',
            'avatar.max' => 'Profile picture size cannot exceed 5MB.',
        ]);

        /** @var \App\Models\User $user */
        $user = $request->user();

        // Remove previous local avatar if stored in public storage
        if ($user->avatar && !str_starts_with($user->avatar, 'http') && !str_starts_with($user->avatar, 'assets/')) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Store new avatar in public/storage/avatars
        $path = $request->file('avatar')->store('avatars', 'public');

        $user->update([
            'avatar' => $path,
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile picture updated successfully.',
                'avatar_url' => $user->avatar_url,
            ]);
        }

        return back()->with('success', 'Profile picture updated successfully.');
    }

    /**
     * Delete/revert authenticated user's profile avatar to default.
     */
    public function destroyAvatar(Request $request): JsonResponse|RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        if ($user->avatar && !str_starts_with($user->avatar, 'http') && !str_starts_with($user->avatar, 'assets/')) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->update([
            'avatar' => null,
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile picture reset to default initials.',
                'avatar_url' => $user->avatar_url,
            ]);
        }

        return back()->with('success', 'Profile picture reset to default initials.');
    }
}
