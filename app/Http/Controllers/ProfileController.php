<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validated();

        // Jika upload foto profil baru
        if ($request->hasFile('profile_photo')) {

            // Hapus foto lama dari Cloudinary
            if ($user->profile_photo && str_contains($user->profile_photo, 'cloudinary')) {
                $publicId = pathinfo($user->profile_photo, PATHINFO_FILENAME);
                try {
                    Cloudinary::adminApi()->deleteAssets('forsist/profile/' . $publicId);
                } catch (\Exception $e) {
                    // Ignore error jika file tidak ditemukan
                }
            }

            // Upload foto baru ke Cloudinary
            $uploadResponse = Cloudinary::uploadApi()->upload(
                $request->file('profile_photo')->getRealPath(),
                [
                    'folder' => 'forsist/profile',
                    'width' => 150,
                    'height' => 150,
                    'crop' => 'fill'
                ]
            );

            $validated['profile_photo'] = $uploadResponse['secure_url'];
        }

        $user->fill($validated);

        // Jika email berubah
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Hapus foto profile dari Cloudinary saat akun dihapus
        if ($user->profile_photo && str_contains($user->profile_photo, 'cloudinary')) {
            $publicId = pathinfo($user->profile_photo, PATHINFO_FILENAME);
            try {
                Cloudinary::adminApi()->deleteAssets('forsist/profile/' . $publicId);
            } catch (\Exception $e) {
                // Ignore error jika file tidak ditemukan
            }
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}