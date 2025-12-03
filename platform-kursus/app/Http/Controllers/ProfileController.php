<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Menampilkan form profil pengguna.
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ])->with('layout', 'layouts.master');
    }

    /**
     * Mengupdate informasi profil pengguna termasuk foto profil.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'profile_picture' => 'nullable|image|max:2048',
            'bio' => 'nullable|string|max:500',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|confirmed|min:8',
        ]);
    
        $user = $request->user();
    
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama
            if ($user->profile_picture && $user->profile_picture !== 'profile_pictures/defaultpp.jpg') {
                $oldFilePath = 'profile_pictures/' . basename($user->profile_picture);
                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                    Log::info('Old profile picture deleted successfully: ' . $oldFilePath);
                } else {
                    Log::warning('Old profile picture not found at path: ' . $oldFilePath);
                }
            }
    
            // Simpan foto baru
            $fileName = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $fileName;
        }
    
        if ($request->filled('bio')) $user->bio = $validated['bio'];
        if ($request->filled('name')) $user->name = $validated['name'];
        if ($request->filled('email') && $user->email !== $validated['email']) {
            $user->email = $validated['email'];
            $user->email_verified_at = null;
        }
        if ($request->filled('password')) $user->password = bcrypt($validated['password']);
    
        if ($user->isDirty()) $user->save();
    
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    
    
    /**
     * Menghapus foto profil pengguna dan mengatur ke default.
     */
    public function deletePicture(Request $request)
    {
        $user = $request->user();
    
        // Hapus foto lama jika berbeda dari default
        if ($user->profile_picture && $user->profile_picture !== 'profile_pictures/defaultpp.jpg') {
            $filePath = $user->profile_picture;
    
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
                Log::info('Profile picture deleted: ' . $filePath);
            } else {
                Log::warning('Profile picture not found: ' . $filePath);
            }
        }
    
        // Ganti ke foto default
        $user->profile_picture = 'profile_pictures/defaultpp.jpg';
        $user->save();
    
        return redirect()->route('profile.edit')->with('success', 'Profile picture deleted successfully.');
    }
    
    /**
     * Menghapus akun pengguna.
     */
    public function destroy(Request $request)
    {
        // Validasi password sebelum menghapus akun
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Logout pengguna
        Auth::logout();

        // Hapus foto profil jika bukan default
        if ($user->profile_picture && $user->profile_picture !== 'profile_pictures/defaultpp.jpg') {
            $filePath = 'public/' . $user->profile_picture;
            Log::info('Trying to delete profile picture: ' . $filePath);

            if (Storage::exists($filePath)) {
                Storage::delete($filePath);  // Hapus foto profil lama
                Log::info('Profile picture deleted: ' . $filePath);
            } else {
                Log::warning('Profile picture file not found: ' . $filePath);
            }
        }

        // Hapus data pengguna dari database
        $user->delete();

        // Hapus sesi pengguna
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
