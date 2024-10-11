<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
    public function index()
    {
        $users = User::all();
        $pakets = Paket::all(); 
        return view('admin.data-barang', compact('users', 'pakets')); 
    }

    public function indexPaket($id)
    {
        $paket = Paket::findOrFail($id); 
        $pakets = Paket::all(); 
        $selectedPaketId = $paket->id; 
        return view('user.index', compact('paket', 'pakets', 'selectedPaketId')); // Return the view with data
    }

    public function indexPricing()
    {
        $pakets = Paket::all(); // Retrieve all records from the pakets table
        return view('user.pricing', compact('pakets')); // Return the view with data
    }

    public function indexProfile()
    {
        $pakets = Paket::all(); // Retrieve all records from the pakets table
        $transaksi = Transaksi::all(); // Retrieve all records from the pakets table
        return view('user.profile', compact('pakets', 'transaksi')); // Return the view with data
    }

    public function indexDecor($id)
    {
        $paket = Paket::findOrFail($id); // Find the paket by ID
        $pakets = Paket::all(); // Retrieve all records from the pakets table
        $selectedPaketId = $paket->id; // Set the currently selected paket ID
        return view('user.decor', compact('paket', 'pakets', 'selectedPaketId')); // Return the view with data
    }
    
    public function indexDatatransaksi()
    {
        $users = User::all();
        $pakets = Paket::all(); 
        $transaksi = Transaksi::all(); // Retrieve all records from the pakets table
        return view('admin.data-transaksi', compact('users', 'pakets', 'transaksi')); // Return the view with data
    }

    public function showDecor() {
        $itemsPerPage = 6;
        $pakets = Paket::paginate($itemsPerPage); // Assuming you have a Paket model
        return view('user.decor', compact('pakets'));
    }

    public function showSingle($id)
    {
        $paket = Paket::findOrFail($id);  // Find the paket by its ID
    
        // Fetch related packages randomly, excluding the current package
        $relatedPakets = Paket::where('id', '!=', $id)
                                ->inRandomOrder()
                                ->take(3)  // Limit to 3 related packages
                                ->get();
    
        return view('user.decor-single', compact('paket', 'relatedPakets'));
    }    
    
    public function create()
    {
        return view('admin.create-paket'); // Return the form view for creating a new paket
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_paket' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Handle file upload if exists
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
        }
    
        // Simpan data ke database
        Paket::create([
            'gambar' => 'images/' . $imageName,
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);
    
        return redirect()->route('data-barang')->with('success', 'Barang berhasil disimpan.');
    }    

    /**
     * Show the form for editing the specified paket.
     */
    public function edit($id)
    {
        $pakets = Paket::findOrFail($id); // Find the paket by ID
        return view('admin.edit-barang', compact('pakets')); // Return the edit view with data
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);
        
        $paket = Paket::find($id);
        
        // Handle image upload if exists
        if ($request->hasFile('gambar')) {
            // Validasi gambar
            $request->validate([
                'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            
            // Menghapus gambar lama jika ada
            if ($paket->gambar) {
                Storage::delete($paket->gambar);
            }
            
            // Simpan gambar baru
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $paket->gambar = 'images/' . $imageName;
        }
        
        // Update data paket
        $paket->update([
            'nama_paket' => $request->input('nama_paket'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),
        ]);
        
        return redirect()->route('data-barang')->with('success', 'Barang berhasil diperbarui.');
    }     

    public function destroy($id)
    {
        $paket = Paket::findOrFail($id);

        // Periksa apakah barang ditemukan sebelum menghapus
        if ($paket) {
            // Menghapus file gambar dari penyimpanan
            Storage::delete($paket->gambar);

            // Menghapus record barang dari database
            $paket->delete();

            return redirect()->route('data-barang')->with('success', 'Barang berhasil dihapus');
        } else {
            return redirect()->route('data-barang')->with('error', 'Barang tidak ditemukan');
        }
    }
}
