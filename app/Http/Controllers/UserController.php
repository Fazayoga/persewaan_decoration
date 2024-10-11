<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $pakets = Paket::all();
        $users = User::all();
        return view('user.index', compact('pakets', 'users'));
    }

    // Menampilkan daftar user
    public function indexCustomer()
    {
        $users = User::all();
        return view('admin.data-customer', compact('users'));
    }

    // Menampilkan form untuk membuat user baru
    public function create()
    {
        return view('user.create');
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|string|in:user,admin', // Validasi untuk user_type
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type, // Simpan user_type
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Menampilkan detail user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    // Menampilkan form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit-profile', compact('user'));
    }

    // Update user
    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);
    
        // Mengupdate informasi pengguna
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, 
            'address' => $request->address, 
        ]);
    
        return redirect()->route('data-customer')->with('success', 'User berhasil diperbarui.');
    }    

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        // Mengupdate informasi pengguna
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, 
            'address' => $request->address, 
        ]);

        // Check if a new password was provided
        if ($request->filled('password')) {
            $user->password = $request->password; // Hash the new password
        }

        $user->save(); // Save all changes

        return redirect()->route('profile', $user->id)->with('success', 'User berhasil diperbarui.');
    }   
    
    // Mengupload gambar profil
    public function uploadImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $user = User::findOrFail($id);
    
        // Check if the user has an existing image and delete it if it's not the default image
        if ($user->image && $user->image !== 'images/default.jpg') {
            $oldImagePath = 'public/' . $user->image; // Ensure you're using the correct path
            
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath); // Delete the old image
            }
        }
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $user->image = $imagePath; // Save the new image path
            $user->save(); // Save changes
        }
    
        return redirect()->route('profile')->with('success', 'Image uploaded successfully!');
    }    
    
    // Menghapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }

    public function showLinkRequestForm()
    {
        return view('user.forgot-password'); // This is the default view for forgot password
    }

    // Handle sending the reset link
    public function sendResetPassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Cari pengguna berdasarkan username dan email
        $user = User::where('username', $request->username)
                    ->where('email', $request->email)
                    ->first();

        if (!$user) {
            return back()->withErrors(['username' => 'Username atau email tidak sesuai dengan data pengguna.']);
        }

        // Perbarui password dengan enkripsi yang aman
        $user->password = $request->password;
        $user->save();

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Password berhasil diperbarui. Silakan login dengan password baru Anda.');
    }
}
