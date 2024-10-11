<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;

class AdminController extends Controller
{
    // Menampilkan daftar admin
    public function index()
    {
        $admins = Admin::all();
        return view('admin.index', compact('admins'));
    }

    // Menampilkan form untuk membuat admin baru
    public function create()
    {
        return view('admin.create');
    }

    // Menyimpan admin baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    // Menampilkan form edit admin
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    // Mengupdate admin
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        // Mengupdate informasi pengguna
        $admin->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone, 
            'address' => $request->address, 
        ]);

        // Check if a new password was provided
        if ($request->filled('password')) {
            $admin->password = $request->password; // Hash the new password
        }

        $admin->save(); // Save all changes

        return redirect()->route('account', $admin->id)->with('success', 'Admin berhasil diperbarui.');
    }    

    // Mengupload gambar profil
    // public function uploadImage(Request $request, $id)
    // {
    //     $request->validate([
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $admin = admin::findOrFail($id);

    //     // Check if the admin has an existing image and delete it if it's not the default image
    //     if ($admin->image && $admin->image !== 'images/default.jpg') {
    //         $oldImagePath = 'public/' . $admin->image; // Ensure you're using the correct path
            
    //         if (Storage::exists($oldImagePath)) {
    //             Storage::delete($oldImagePath); // Delete the old image
    //         }
    //     }

    //     // Handle image upload
    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('images', 'public');
    //         $admin->image = $imagePath; // Save the new image path
    //         $admin->save(); // Save changes
    //     }

    //     return redirect()->route('account')->with('success', 'Image uploaded successfully!');
    // }

    public function uploadImage(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        // Jika menerima permintaan untuk mereset gambar
        if ($request->has('reset')) {
            // Hapus gambar lama jika bukan default
            if ($admin->image && $admin->image !== 'images/default.jpg') {
                $oldImagePath = 'public/' . $admin->image;
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath); // Hapus gambar lama
                }
            }

            // Set gambar ke default
            $admin->image = 'images/default.jpg';
            $admin->save();

            return response()->json(['message' => 'Image reset to default successfully'], 200);
        }

        // Validasi dan proses upload gambar
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($admin->image && $admin->image !== 'images/default.jpg') {
                $oldImagePath = 'public/' . $admin->image;
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }

            // Upload gambar baru
            $imagePath = $request->file('image')->store('images', 'public');
            $admin->image = $imagePath;
            $admin->save();
        }

        return redirect()->route('account')->with('success', 'Image uploaded successfully!');
    }

    // Menghapus admin
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('index')->with('success', 'Admin berhasil dihapus.');
    }

    public function showLinkRequestForm()
    {
        return view('admin.forgot-password'); // This is the default view for forgot password
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
        $admin = Admin::where('username', $request->username)
                    ->where('email', $request->email)
                    ->first();

        if (!$admin) {
            return back()->withErrors(['username' => 'Username atau email tidak sesuai dengan data pengguna.']);
        }

        // Perbarui password dengan enkripsi yang aman
        $admin->password = $request->password;
        $admin->save();

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login-admin')->with('success', 'Password berhasil diperbarui. Silakan login dengan password baru Anda.');
    }
}