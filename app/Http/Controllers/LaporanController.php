<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index()
    {
        $totalLaporan = Laporan::count();
        $totalDiproses = Laporan::where('status', 'proses')->count();
        $totalSelesai = Laporan::where('status', 'selesai')->count();

        return view('laporan.index', compact('totalLaporan', 'totalDiproses', 'totalSelesai'));
    }

    // --- LOGIN WARGA (Untuk tombol Masuk di beranda) ---
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        // Mengarah ke resources/views/auth/login.blade.php
        return view('auth.login');
    }

    // --- LOGIN ADMIN (Untuk yang ketik /joyo) ---
    public function showLoginAdmin()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        // Mengarah ke resources/views/admin/login.blade.php sesuai request kamu
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        // Login buat Admin pakai PIN
        if ($request->filled('pin')) {
            $admin = User::where('role', 'admin')->where('pin', $request->pin)->first();
            if ($admin) {
                Auth::login($admin);
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }
            return back()->withErrors(['message' => 'PIN salah']);
        }

        // Login buat Warga pakai NIK
        if ($request->has('nik')) {
            $request->validate([
                'nik' => 'required|numeric|digits:16'
            ], [
                'nik.required' => 'NIK wajib diisi.',
                'nik.numeric' => 'NIK hanya boleh berisi angka, tidak boleh ada huruf.',
                'nik.digits' => 'NIK harus berjumlah persis 16 digit angka.'
            ]);

            $user = User::where('nik', $request->nik)->first();
            if ($user) {
                Auth::login($user);
                $request->session()->regenerate();
                return redirect('/');
            }
            return back()->withErrors(['nik' => 'NIK tidak terdaftar di sistem.'])->withInput();
        }
        return back()->withErrors(['nik' => 'Isi NIK untuk masuk.']);
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }

    public function create()
    {
        return view('laporan.create');
    }

    public function profil(Request $request)
    {
        $user = Auth::user();
        
        $query = Laporan::where('user_id', $user->id)->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status != 'semua') {
            $query->where('status', $request->status);
        }

        $laporans = $query->get();

        return view('laporan.profil', compact('user', 'laporans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'lokasi' => 'required',
            'description' => 'required',
            'foto' => 'nullable|image|max:2048'
        ]);

        $foto = $request->file('foto') ? $request->file('foto')->store('laporan_images', 'public') : null;

        Laporan::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'lokasi' => $request->lokasi,
            'description' => $request->description,
            'foto' => $foto,
            'status' => 'pending'
        ]);

        return redirect()->route('home')->with('success', 'Laporan berhasil dikirim! Keluhan Anda akan segera diproses dan diselesaikan oleh pihak Kelurahan. Terima kasih sudah berkontribusi untuk Joyotakan!');
    }

    public function adminDashboard(Request $request)
    {
        $query = Laporan::with('user')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('nik', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status') && $request->status != 'semua') {
            $query->where('status', $request->status);
        }

        $laporans = $query->get();
        return view('laporan.admin', compact('laporans'));
    }

    public function prosesLaporan($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->status = 'proses';
        $laporan->save();
        return redirect()->route('admin.dashboard');
    }

    public function updateLaporan($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->status = 'selesai';
        $laporan->save();
        return redirect()->route('admin.dashboard');
    }

    public function destroyLaporan($id)
    {
        $laporan = Laporan::findOrFail($id);
        if ($laporan->foto)
            Storage::disk('public')->delete($laporan->foto);
        $laporan->delete();
        return redirect()->route('admin.dashboard');
    }

    public function dataWarga()
    {
        $wargas = User::where('role', 'warga')->get();
        return view('laporan.data_warga', compact('wargas'));
    }

    public function storeWarga(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16|unique:users,nik',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
        ]);

        User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'role' => 'warga',
            // mengikuti pola create: pin = nik
            'password' => Hash::make($request->nik),
            'pin' => $request->nik,
        ]);
        return redirect()->back();    }

    public function updateWarga(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16|unique:users,nik,' . $id,
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
        ]);

        $user = User::where('role', 'warga')->findOrFail($id);

        $user->update([
            'name' => $request->name,
            'nik' => $request->nik,
            'rt' => $request->rt,
            'rw' => $request->rw,
            // tetap pin = nik
            'pin' => $request->nik,
            'password' => Hash::make($request->nik),
        ]);

        return redirect()->route('admin.warga');
    }

    public function destroyWarga($id)
    {
        $user = User::where('role', 'warga')->findOrFail($id);
        $user->delete();

        return redirect()->route('admin.warga');
    }
}