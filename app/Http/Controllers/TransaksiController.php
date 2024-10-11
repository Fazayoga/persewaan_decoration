<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Paket;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        $users = User::all();
        $pakets = Paket::all();
        $transaksi = Transaksi::all();
        $transaksis = Transaksi::with('user', 'paket')->get();
        return view('admin.data-transaksi', compact('users', 'pakets', 'transaksi', 'transaksis'));
    }

    public function indexTransaksi()
    {
        $pakets = Paket::all(); 
        $users = User::all();
        $transaksi = Transaksi::with('user')->get();
        return view('user.index', compact('pakets', 'users', 'transaksi'));
    }

    // Menampilkan form untuk membuat transaksi baru
    public function create()
    {
        $users = User::all(); // Ambil semua user untuk dropdown
        $pakets = Paket::all(); // Ambil semua paket untuk dropdown
        $transaksi = Transaksi::with('user')->get();
        return view('admin.create-paket', compact('users', 'pakets', 'transaksi'));
    }

    public function userBookings()
    {
        // Ambil user yang sedang login
        $userId = Auth::guard('web')->id();

        // Ambil transaksi yang terkait dengan user yang sedang login
        $transaksi = Transaksi::where('user_id', $userId)->with('paket')->get();

        // Kirimkan data transaksi ke view
        return view('user.profile', compact('transaksi'));
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'event_location' => 'required|string|max:255',
            'event_start_date' => 'required|date',
            'event_end_date' => 'required|date|after_or_equal:event_start_date',
            'event_start_time' => 'required|date_format:H:i',
            'event_end_time' => 'required|date_format:H:i',
        ]);

        // Retrieve the selected package
        $pakets = Paket::all();
        $paket = Paket::find($request->paket_id);
        if (!$paket) {
            return redirect()->back()->withErrors(['paket_id' => 'Paket tidak ditemukan.']);
        }
        // Hitung jumlah hari sewa
        $startDate = Carbon::parse($request->event_start_date);
        $endDate = Carbon::parse($request->event_end_date);
        $jumlahHari = $endDate->diffInDays($startDate) + 1; // +1 untuk menghitung hari terakhir
        
        // Hitung total biaya berdasarkan jumlah hari
        $total = $paket->harga * $jumlahHari;

        // Calculate the total cost based on package price
        // $total = $paket->harga;

        // Store the transaction in the database
        Transaksi::create([
            'user_id' => Auth::guard('web')->id(),
            'paket_id' => $request->paket_id,
            'event_location' => $request->event_location,
            'event_start_date' => $request->event_start_date,
            'event_end_date' => $request->event_end_date,
            'event_start_time' => $request->event_start_time,
            'event_end_time' => $request->event_end_time,
            'total' => $total,
            'status' => 'pending', // Default status is pending
        ]);

        // Construct WhatsApp URL with transaction details
        $whatsappUrl = "http://wa.me/+62895385894616?text=Thank%20you%20for%20your%20order!%20Here%20are%20the%20details:%0A%0A";
        $customerName = Auth::guard('web')->check() ? Auth::guard('web')->user()->name : 'Guest'; // Default if not authenticated
        $whatsappUrl .= "Customer%20Name:%20" . urlencode($customerName) . "%0A"; // Get the user's name
        $whatsappUrl .= "Event%20Location:%20" . urlencode($request->event_location) . "%0A";
        $whatsappUrl .= "Event%20Rental%20Date:%20" . urlencode($request->event_start_date) . "%0A";
        $whatsappUrl .= "Event%20Rental%20Start%20Time:%20" . urlencode($request->event_start_time) . "%0A";
        $whatsappUrl .= "Event%20Rental%20End%20Time:%20" . urlencode($request->event_end_time) . "%0A";
        $whatsappUrl .= "Total%20Cost:%20" . urlencode("Rp " . number_format($total, 0, ',', '.')) . "%0A"; // Total cost

        // Construct WhatsApp URL with transaction details
        $whatsappUrl2 = "http://wa.me/+62895385894616?text=Thank%20you%20for%20your%20order!%20Here%20are%20the%20details:%0A%0A";
        $customerName2 = Auth::guard('web')->check() ? Auth::guard('web')->user()->name : 'Guest'; // Default if not authenticated
        $whatsappUrl2 .= "Customer%20Name:%20" . urlencode($customerName2) . "%0A"; // Get the user's name
        $whatsappUrl2 .= "Event%20Location:%20" . urlencode($request->event_location) . "%0A";
        $whatsappUrl2 .= "Event%20Rental%20Date:%20" . urlencode($request->event_start_date) . "%0A";
        $whatsappUrl2 .= "Event%20Rental%20Start%20Time:%20" . urlencode($request->event_start_time) . "%0A";
        $whatsappUrl2 .= "Event%20Rental%20End%20Time:%20" . urlencode($request->event_end_time) . "%0A";
        $whatsappUrl2 .= "Total%20Cost:%20" . urlencode("Rp " . number_format($total, 0, ',', '.')) . "%0A"; // Total cost

        // Redirect to the confirmation view with WhatsApp URL
        return redirect()->route('home')->with('success', 'Transaction successfully created.');
    }

    public function storeItem(Request $request)
    {
        // Validate the form data
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'event_location' => 'required|string|max:255',
            'event_start_date' => 'required|date',
            'event_end_date' => 'required|date|after_or_equal:event_start_date',
            'event_start_time' => 'required|date_format:H:i',
            'event_end_time' => 'required|date_format:H:i',
        ]);

        // Retrieve the selected package
        $pakets = Paket::all();
        $paket = Paket::find($request->paket_id);
        if (!$paket) {
            return redirect()->back()->withErrors(['paket_id' => 'Paket tidak ditemukan.']);
        }
        // Hitung jumlah hari sewa
        $startDate = Carbon::parse($request->event_start_date);
        $endDate = Carbon::parse($request->event_end_date);
        $jumlahHari = $endDate->diffInDays($startDate) + 1; // +1 untuk menghitung hari terakhir
        
        // Hitung total biaya berdasarkan jumlah hari
        $total = $paket->harga * $jumlahHari;

        // Calculate the total cost based on package price
        // $total = $paket->harga;

        // Store the transaction in the database
        Transaksi::create([
            'user_id' => Auth::guard('web')->id(),
            'paket_id' => $request->paket_id,
            'event_location' => $request->event_location,
            'event_start_date' => $request->event_start_date,
            'event_end_date' => $request->event_end_date,
            'event_start_time' => $request->event_start_time,
            'event_end_time' => $request->event_end_time,
            'total' => $total,
            'status' => 'pending', // Default status is pending
        ]);

        // Construct WhatsApp URL with transaction details
        $whatsappUrl = "http://wa.me/+62895385894616?text=Thank%20you%20for%20your%20order!%20Here%20are%20the%20details:%0A%0A";
        $customerName = Auth::guard('web')->check() ? Auth::guard('web')->user()->name : 'Guest'; // Default if not authenticated
        $whatsappUrl .= "Customer%20Name:%20" . urlencode($customerName) . "%0A"; // Get the user's name
        $whatsappUrl .= "Event%20Location:%20" . urlencode($request->event_location) . "%0A";
        $whatsappUrl .= "Event%20Rental%20Date:%20" . urlencode($request->event_start_date) . "%0A";
        $whatsappUrl .= "Event%20Rental%20Start%20Time:%20" . urlencode($request->event_start_time) . "%0A";
        $whatsappUrl .= "Event%20Rental%20End%20Time:%20" . urlencode($request->event_end_time) . "%0A";
        $whatsappUrl .= "Total%20Cost:%20" . urlencode("Rp " . number_format($total, 0, ',', '.')) . "%0A"; // Total cost

        // Construct WhatsApp URL with transaction details
        $whatsappUrl2 = "http://wa.me/+62895385894616?text=Thank%20you%20for%20your%20order!%20Here%20are%20the%20details:%0A%0A";
        $customerName2 = Auth::guard('web')->check() ? Auth::guard('web')->user()->name : 'Guest'; // Default if not authenticated
        $whatsappUrl2 .= "Customer%20Name:%20" . urlencode($customerName2) . "%0A"; // Get the user's name
        $whatsappUrl2 .= "Event%20Location:%20" . urlencode($request->event_location) . "%0A";
        $whatsappUrl2 .= "Event%20Rental%20Date:%20" . urlencode($request->event_start_date) . "%0A";
        $whatsappUrl2 .= "Event%20Rental%20Start%20Time:%20" . urlencode($request->event_start_time) . "%0A";
        $whatsappUrl2 .= "Event%20Rental%20End%20Time:%20" . urlencode($request->event_end_time) . "%0A";
        $whatsappUrl2 .= "Total%20Cost:%20" . urlencode("Rp " . number_format($total, 0, ',', '.')) . "%0A"; // Total cost

        // Redirect to the confirmation view with WhatsApp URL
        return redirect()->route('home')->with('success', 'Transaction successfully created.');
    }

    public function storeDecor(Request $request)
    {
        // Validate the form data
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'event_location' => 'required|string|max:255',
            'event_start_date' => 'required|date',
            'event_end_date' => 'required|date|after_or_equal:event_start_date',
            'event_start_time' => 'required|date_format:H:i',
            'event_end_time' => 'required|date_format:H:i',
        ]);

        // Retrieve the selected package
        $pakets = Paket::all();
        $paket = Paket::find($request->paket_id);
        if (!$paket) {
            return redirect()->back()->withErrors(['paket_id' => 'Paket tidak ditemukan.']);
        }
        // Hitung jumlah hari sewa
        $startDate = Carbon::parse($request->event_start_date);
        $endDate = Carbon::parse($request->event_end_date);
        $jumlahHari = $endDate->diffInDays($startDate) + 1; // +1 untuk menghitung hari terakhir
        
        // Hitung total biaya berdasarkan jumlah hari
        $total = $paket->harga * $jumlahHari;

        // Calculate the total cost based on package price
        // $total = $paket->harga;

        // Store the transaction in the database
        Transaksi::create([
            'user_id' => Auth::guard('web')->id(),
            'paket_id' => $request->paket_id,
            'event_location' => $request->event_location,
            'event_start_date' => $request->event_start_date,
            'event_end_date' => $request->event_end_date,
            'event_start_time' => $request->event_start_time,
            'event_end_time' => $request->event_end_time,
            'total' => $total,
            'status' => 'pending', // Default status is pending
        ]);

        // Construct WhatsApp URL with transaction details
        $whatsappUrl = "http://wa.me/+62895385894616?text=Thank%20you%20for%20your%20order!%20Here%20are%20the%20details:%0A%0A";
        $customerName = Auth::guard('web')->check() ? Auth::guard('web')->user()->name : 'Guest'; // Default if not authenticated
        $whatsappUrl .= "Customer%20Name:%20" . urlencode($customerName) . "%0A"; // Get the user's name
        $whatsappUrl .= "Event%20Location:%20" . urlencode($request->event_location) . "%0A";
        $whatsappUrl .= "Event%20Rental%20Date:%20" . urlencode($request->event_start_date) . "%0A";
        $whatsappUrl .= "Event%20Rental%20Start%20Time:%20" . urlencode($request->event_start_time) . "%0A";
        $whatsappUrl .= "Event%20Rental%20End%20Time:%20" . urlencode($request->event_end_time) . "%0A";
        $whatsappUrl .= "Total%20Cost:%20" . urlencode("Rp " . number_format($total, 0, ',', '.')) . "%0A"; // Total cost

        // Construct WhatsApp URL with transaction details
        $whatsappUrl2 = "http://wa.me/+62895385894616?text=Thank%20you%20for%20your%20order!%20Here%20are%20the%20details:%0A%0A";
        $customerName2 = Auth::guard('web')->check() ? Auth::guard('web')->user()->name : 'Guest'; // Default if not authenticated
        $whatsappUrl2 .= "Customer%20Name:%20" . urlencode($customerName2) . "%0A"; // Get the user's name
        $whatsappUrl2 .= "Event%20Location:%20" . urlencode($request->event_location) . "%0A";
        $whatsappUrl2 .= "Event%20Rental%20Date:%20" . urlencode($request->event_start_date) . "%0A";
        $whatsappUrl2 .= "Event%20Rental%20Start%20Time:%20" . urlencode($request->event_start_time) . "%0A";
        $whatsappUrl2 .= "Event%20Rental%20End%20Time:%20" . urlencode($request->event_end_time) . "%0A";
        $whatsappUrl2 .= "Total%20Cost:%20" . urlencode("Rp " . number_format($total, 0, ',', '.')) . "%0A"; // Total cost

        // Redirect to the confirmation view with WhatsApp URL
        return redirect()->route('decor')->with('success', 'Transaction successfully created.');
    }

    // Menampilkan detail transaksi
    public function show($id)
    {
        $pakets = Paket::all();
        $transaksi = Transaksi::with('user')->findOrFail($id);
        return view('user.index', compact('transaksi', 'pakets'));
    }

    // Menampilkan form edit transaksi
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $users = User::all();
        $pakets = Paket::all(); // Get pakets for dropdown in the edit form
        return view('transaksi.edit', compact('transaksi', 'users', 'pakets'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:paid,pending,failed,cancelled', // Validasi status
        ]);
    
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = $request->input('status'); // Hanya memperbarui status
        $transaksi->save(); // Simpan perubahan
    
        return redirect()->route('data-transaksi')->with('success', 'Status transaksi berhasil diperbarui!');
    }
    
    // Update transaksi
    public function update(Request $request, $id)
    {
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'event_location' => 'required|string|max:255',
            'event_start_date' => 'required|date',
            'event_start_time' => 'required',
            'event_end_date' => 'required|date|after_or_equal:event_start_date',
            'event_end_time' => 'required',
            'total' => 'required|numeric',
        ]);
    
        // Setelah validasi, simpan data transaksi
        $transaksi = Transaksi::findOrFail($id);
        // $transaksi->update($request->all());
        // Update the transaction data
        $transaksi->update([
            'paket_id' => $request->paket_id,
            'event_location' => $request->event_location,
            'event_start_date' => $request->event_start_date,
            'event_start_time' => $request->event_start_time,
            'event_end_date' => $request->event_end_date,
            'event_end_time' => $request->event_end_time,
            'total' => $request->total,
        ]);

        // Save the updated transaction
        $transaksi->save();

        // Redirect kembali atau mengembalikan respons
        return redirect()->route('profile')->with('success', 'Transaksi diperbarui dengan sukses.');
    }

    // Menghapus transaksi
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('data-transaksi')->with('success', 'Transaksi berhasil dihapus.');
    }
}
