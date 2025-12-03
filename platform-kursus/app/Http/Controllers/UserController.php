<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
// UserController.php
public function index(Request $request)
{
    $query = User::query();

    // Filter berdasarkan role jika ada
    if ($request->has('role') && $request->input('role') != '') {
        $role = $request->input('role');
        $query->where('role', $role)->where('role', '!=', 'admin'); // Tidak menampilkan admin
    } else {
        // Jika tidak ada filter role, tampilkan semua pengguna yang bukan admin
        $query->where('role', '!=', 'admin');
    }

    // Pencarian berdasarkan nama atau email
    if ($request->has('search') && $request->input('search') != '') {
        $search = $request->get('search');
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%');
        });
    }

    // Pagination dengan 10 user per halaman
    $users = $query->paginate(10);

    return view('dashboard.admin.userIndex', compact('users'));
}
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form pembuatan user baru
        return view('dashboard.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:users,email', // Ensure email is unique
                function ($attribute, $value, $fail) {
                    // Validate that the email ends with @gmail.com or @yahoo.com
                    if (!preg_match('/@(gmail\.com|yahoo\.com)$/', $value)) {
                        $fail('The email must be a Gmail or Yahoo email address.');
                    }
                }
            ],
            'role' => 'required|in:student,teacher',
            'password' => 'nullable|string|min:8|confirmed', // Password bersifat opsional
        ]);
    
        // Membuat user baru dengan foto profil default
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => bcrypt($validated['password']),
            'profile_picture' => 'profile_pictures/defaultpp.jpg', // Tambahkan foto profil default
        ]);
    
        // Redirect ke halaman daftar user setelah berhasil disimpan
        return redirect()->route('admin.user.index')->with('success', 'User Successfully Created');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail user berdasarkan ID
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan form untuk mengedit data user
        $user = User::findOrFail($id);
        return view('dashboard.admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $id, // Pastikan email unik, kecuali saat edit
                function ($attribute, $value, $fail) {
                    // Validasi untuk email yang berakhiran @gmail.com atau @yahoo.com
                    if (!preg_match('/@(gmail\.com|yahoo\.com)$/', $value)) {
                        $fail('The email must be a Gmail or Yahoo email address.');
                    }
                }
            ],
            'role' => 'required|in:student,teacher',
            'password' => 'nullable|string|min:8|confirmed', // Password bersifat opsional
        ]);
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);
    
        // Update data yang ada
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
    
        // Hanya update password jika diisi
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }
    
        $user->save();
    
        return redirect()->route('admin.user.index')->with('success', 'User Successfully Updated');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menemukan user berdasarkan ID
        $user = User::findOrFail($id);
        
        // Menghapus user
        $user->delete();

        // Redirect ke halaman daftar user setelah berhasil dihapus
        return redirect()->route('admin.user.index')->with('success', 'User Successfully Deleted');
    }


    public function updateRole(Request $request)
    {
        $user = User::findOrFail(\Illuminate\Support\Facades\Auth::id());
    
        // Jika user adalah student, ubah menjadi teacher
        if ($user->role === 'student') {
            $user->role = 'teacher';
            $user->save();
    
            return redirect()->route('teacher.home')->with('success', 'Your role has been updated to Teacher!');
        }
    
        // Jika user adalah teacher, pastikan dia tidak memiliki kursus
        if ($user->role === 'teacher') {
            // Cek apakah teacher memiliki kursus yang diajarkan
            if ($user->taughtCourses()->count() > 0) {
                return back()->with('error', 'You must delete all your courses before changing your role back to student.');
            }
    
            // Jika tidak ada kursus yang diajarkan, ubah menjadi student
            $user->role = 'student';
            $user->save();
    
            return redirect()->route('student.home')->with('success', 'Your role has been updated to Student!');
        }
    
        // Jika kondisi tidak memenuhi, beri pesan error
        return back()->with('error', 'Role change is not allowed.');
    }
    

}
