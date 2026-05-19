<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Warga | Joyotakan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }

        .bg-batik {
            background-color: #f8fafc;
            background-image:
                url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%2394a3b8' fill-opacity='0.05'%3E%3Cpath d='M50 0L100 50L50 100L0 50Z'/%3E%3Ccircle cx='50' cy='50' r='12'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 120px;
            background-attachment: fixed;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body class="bg-batik text-slate-900 min-h-screen pb-12">

    <!-- NAVBAR SEDERHANA -->
    <nav class="w-full bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-105 transition">
                    <span class="text-white font-bold text-lg italic">S</span>
                </div>
                <span class="text-lg md:text-xl font-black tracking-tight uppercase group-hover:text-blue-600 transition">
                    Si <span class="text-blue-600">Kampung</span>
                </span>
            </a>

            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}"
                    class="text-sm font-bold text-slate-500 hover:text-blue-600 transition px-4 py-2">
                    Kembali ke Beranda
                </a>
                <a href="{{ route('logout') }}"
                    class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-5 py-2 rounded-xl font-bold transition text-sm flex items-center gap-2">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </a>
            </div>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-6 mt-10">

        <!-- HEADER PROFIL -->
        <div class="glass-card rounded-3xl p-8 shadow-xl flex flex-col md:flex-row gap-8 items-center md:items-start mb-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-100 rounded-full blur-3xl opacity-50 -mr-20 -mt-20"></div>
            
            <div class="relative w-32 h-32 bg-blue-600 rounded-[2rem] flex items-center justify-center text-white font-black text-5xl shadow-2xl shadow-blue-600/30 flex-shrink-0">
                {{ substr($user->name, 0, 1) }}
                <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 border-4 border-white rounded-full"></div>
            </div>

            <div class="relative text-center md:text-left flex-1">
                <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-3 inline-block">Warga Terverifikasi</span>
                <h1 class="text-3xl font-black mb-1">{{ $user->name }}</h1>
                <p class="text-slate-500 font-medium mb-6">NIK: {{ substr($user->nik, 0, 4) }}********{{ substr($user->nik, -4) }}</p>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">RT</p>
                        <p class="text-lg font-black text-slate-800">{{ $user->rt ?? '-' }}</p>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">RW</p>
                        <p class="text-lg font-black text-slate-800">{{ $user->rw ?? '-' }}</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-2xl border border-blue-100 md:col-span-2">
                        <p class="text-xs text-blue-400 font-bold uppercase tracking-wider mb-1">Total Laporan Dibuat</p>
                        <p class="text-lg font-black text-blue-700">{{ $laporans->count() }} Laporan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- DAFTAR LAPORAN -->
        <div class="glass-card rounded-3xl p-8 shadow-xl">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <div>
                    <h2 class="text-2xl font-black">Riwayat Laporan Anda</h2>
                    <p class="text-sm text-slate-500 mt-1">Daftar semua pengaduan yang telah Anda kirimkan.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <form action="{{ route('laporan.profil') }}" method="GET" class="flex flex-col sm:flex-row gap-2 w-full">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari laporan..."
                            class="px-4 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm w-full md:w-auto">
                        <select name="status" class="px-4 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm bg-white w-full md:w-auto">
                            <option value="semua" {{ request('status') == 'semua' ? 'selected' : '' }}>Semua</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Ditinjau</option>
                            <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white px-4 py-2 rounded-xl font-bold text-sm transition">
                            <i class="bi bi-search"></i>
                        </button>
                        @if(request('search') || (request('status') && request('status') != 'semua'))
                            <a href="{{ route('laporan.profil') }}" class="bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2 rounded-xl font-bold text-sm transition flex items-center justify-center">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </form>
                    <a href="{{ route('laporan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl font-bold transition shadow-lg shadow-blue-200 text-sm flex items-center justify-center gap-2 flex-shrink-0">
                        <i class="bi bi-plus-lg"></i> Buat Laporan
                    </a>
                </div>
            </div>

            @if($laporans->isEmpty())
                <div class="text-center py-16 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                    <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400 text-2xl">
                        <i class="bi bi-inbox"></i>
                    </div>
                    @if(request('search') || (request('status') && request('status') != 'semua'))
                        <h3 class="text-lg font-bold text-slate-700 mb-1">Laporan Tidak Ditemukan</h3>
                        <p class="text-slate-500 text-sm">Tidak ada laporan yang sesuai dengan pencarian atau filter Anda.</p>
                    @else
                        <h3 class="text-lg font-bold text-slate-700 mb-1">Belum Ada Laporan</h3>
                        <p class="text-slate-500 text-sm">Anda belum pernah membuat laporan atau pengaduan.</p>
                    @endif
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider border-y border-slate-200">
                                <th class="p-4 font-bold rounded-tl-2xl">Tanggal</th>
                                <th class="p-4 font-bold">Subjek / Lokasi</th>
                                <th class="p-4 font-bold">Bukti Foto</th>
                                <th class="p-4 font-bold rounded-tr-2xl">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($laporans as $laporan)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-4 align-top">
                                    <p class="font-bold text-sm text-slate-800">{{ $laporan->created_at->format('d M Y') }}</p>
                                    <p class="text-xs text-slate-500">{{ $laporan->created_at->format('H:i') }} WIB</p>
                                </td>
                                <td class="p-4 align-top">
                                    <p class="font-bold text-slate-800 mb-1">{{ $laporan->judul }}</p>
                                    <p class="text-xs text-slate-500 flex items-center gap-1">
                                        <i class="bi bi-geo-alt text-red-500"></i> {{ $laporan->lokasi }}
                                    </p>
                                </td>
                                <td class="p-4 align-top">
                                    @if($laporan->foto)
                                        <div class="w-20 h-14 rounded-lg overflow-hidden border border-slate-200 bg-slate-100 relative group cursor-pointer">
                                            <img src="{{ asset('storage/' . $laporan->foto) }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td class="p-4 align-top">
                                    @if($laporan->status == 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded-full text-xs font-bold">
                                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                            Ditinjau
                                        </span>
                                    @elseif($laporan->status == 'proses')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-700 border border-blue-200 rounded-full text-xs font-bold">
                                            <i class="bi bi-arrow-repeat text-blue-500 animate-spin"></i>
                                            Diproses
                                        </span>
                                    @elseif($laporan->status == 'selesai')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 border border-green-200 rounded-full text-xs font-bold">
                                            <i class="bi bi-check-circle-fill text-green-500"></i>
                                            Selesai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-50 text-slate-700 border border-slate-200 rounded-full text-xs font-bold">
                                            <i class="bi bi-dash-circle text-slate-500"></i>
                                            Unknown
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>

    </div>

</body>

</html>
