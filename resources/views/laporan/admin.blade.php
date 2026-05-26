@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- Page Header --}}
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Dashboard</h2>
        <p class="text-slate-500 mt-1 text-sm">Ringkasan laporan & kelola aduan warga Joyotakan.</p>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3 md:gap-4 mb-8">
        {{-- Total Laporan --}}
        <div class="stat-card bg-white rounded-2xl p-4 md:p-5 border border-slate-200/60 shadow-sm">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-50 to-brand-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                </div>
            </div>
            <div class="text-2xl md:text-3xl font-black text-slate-900">{{ $totalLaporan }}</div>
            <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide mt-0.5">Total Laporan</p>
        </div>

        {{-- Ditinjau --}}
        <div class="stat-card bg-white rounded-2xl p-4 md:p-5 border border-slate-200/60 shadow-sm">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-50 to-amber-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="text-2xl md:text-3xl font-black text-slate-900">{{ $totalPending }}</div>
            <p class="text-[11px] font-semibold text-amber-500 uppercase tracking-wide mt-0.5">Ditinjau</p>
        </div>

        {{-- Diproses --}}
        <div class="stat-card bg-white rounded-2xl p-4 md:p-5 border border-slate-200/60 shadow-sm">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182"/>
                    </svg>
                </div>
            </div>
            <div class="text-2xl md:text-3xl font-black text-slate-900">{{ $totalProses }}</div>
            <p class="text-[11px] font-semibold text-blue-500 uppercase tracking-wide mt-0.5">Diproses</p>
        </div>

        {{-- Selesai --}}
        <div class="stat-card bg-white rounded-2xl p-4 md:p-5 border border-slate-200/60 shadow-sm">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-50 to-emerald-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="text-2xl md:text-3xl font-black text-slate-900">{{ $totalSelesai }}</div>
            <p class="text-[11px] font-semibold text-emerald-500 uppercase tracking-wide mt-0.5">Selesai</p>
        </div>

        {{-- Total Warga --}}
        <div class="stat-card bg-white rounded-2xl p-4 md:p-5 border border-slate-200/60 shadow-sm col-span-2 lg:col-span-1">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-50 to-violet-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                    </svg>
                </div>
            </div>
            <div class="text-2xl md:text-3xl font-black text-slate-900">{{ $totalWarga }}</div>
            <p class="text-[11px] font-semibold text-violet-500 uppercase tracking-wide mt-0.5">Warga Terdaftar</p>
        </div>
    </div>

    {{-- Filter & Search --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm mb-6">
        <div class="p-4 md:p-5">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, NIK, judul laporan..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-400 text-sm transition">
                </div>
                <select name="status"
                    class="px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-400 text-sm text-slate-700 transition min-w-[140px]">
                    <option value="semua" {{ request('status') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Ditinjau</option>
                    <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                <button type="submit"
                    class="bg-brand-600 hover:bg-brand-700 text-white px-5 py-2.5 rounded-xl font-semibold text-sm shadow-md shadow-brand-600/20 transition-all hover:shadow-lg hover:shadow-brand-600/25 active:scale-[0.98]">
                    Filter
                </button>
                @if(request('search') || (request('status') && request('status') != 'semua'))
                    <a href="{{ route('admin.dashboard') }}"
                       class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-2.5 rounded-xl font-semibold text-sm transition flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
        <div class="p-4 md:p-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h3 class="font-bold text-slate-800">Daftar Laporan Warga</h3>
                <p class="text-xs text-slate-400 mt-0.5">{{ $laporans->count() }} laporan ditemukan</p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="laporanTable">
                <thead>
                    <tr class="bg-slate-50/80">
                        <th class="py-3.5 px-5 text-[10px] uppercase tracking-widest text-slate-400 font-bold">Tanggal</th>
                        <th class="py-3.5 px-5 text-[10px] uppercase tracking-widest text-slate-400 font-bold">Pelapor</th>
                        <th class="py-3.5 px-5 text-[10px] uppercase tracking-widest text-slate-400 font-bold">Aduan</th>
                        <th class="py-3.5 px-5 text-[10px] uppercase tracking-widest text-slate-400 font-bold text-center">Bukti</th>
                        <th class="py-3.5 px-5 text-[10px] uppercase tracking-widest text-slate-400 font-bold text-center">Status</th>
                        <th class="py-3.5 px-5 text-[10px] uppercase tracking-widest text-slate-400 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($laporans as $l)
                        <tr class="table-row-animate">
                            <td class="py-4 px-5 text-sm text-slate-500 font-medium whitespace-nowrap">
                                {{ $l->created_at->format('d M Y') }}
                            </td>
                            <td class="py-4 px-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand-100 to-brand-200 flex items-center justify-center flex-shrink-0">
                                        <span class="text-brand-700 text-xs font-bold">{{ substr($l->user->name ?? 'W', 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-slate-800 text-sm">{{ $l->user->name ?? 'Warga' }}</div>
                                        <div class="text-[10px] text-slate-400 font-mono">{{ $l->user->nik ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-5 max-w-[240px]">
                                <div class="text-slate-800 font-semibold text-sm truncate">{{ $l->judul }}</div>
                                <div class="text-[11px] text-slate-400 flex items-center gap-1 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                    </svg>
                                    <span class="truncate">{{ $l->lokasi }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-5 text-center">
                                @if($l->foto)
                                    <div class="flex justify-center">
                                        <img src="{{ asset('storage/' . $l->foto) }}"
                                             class="w-11 h-11 object-cover rounded-xl border-2 border-white shadow-md hover:scale-110 transition cursor-pointer"
                                             alt="Bukti foto">
                                    </div>
                                @else
                                    <div class="flex justify-center">
                                        <div class="w-11 h-11 bg-slate-50 rounded-xl flex items-center justify-center border border-slate-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v13.5A1.5 1.5 0 003.75 21z"/>
                                            </svg>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td class="py-4 px-5 text-center">
                                @if ($l->status == 'proses')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-blue-50 text-blue-700 rounded-lg text-[10px] font-bold uppercase tracking-wide">
                                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-pulse"></span>
                                        Diproses
                                    </span>
                                @elseif($l->status == 'selesai')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-lg text-[10px] font-bold uppercase tracking-wide">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                        Selesai
                                    </span>
                                @elseif($l->status == 'pending')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-50 text-amber-700 rounded-lg text-[10px] font-bold uppercase tracking-wide">
                                        <span class="w-1.5 h-1.5 bg-amber-500 rounded-full"></span>
                                        Ditinjau
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-bold uppercase tracking-wide">
                                        {{ $l->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-5">
                                <div class="flex justify-center gap-1.5">
                                    @if($l->status != 'proses' && $l->status != 'selesai')
                                        <form action="{{ route('admin.laporan.proses', $l->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="w-8 h-8 flex items-center justify-center bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all hover:scale-110 active:scale-95"
                                                title="Proses laporan">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif

                                    @if($l->status != 'selesai')
                                        <form action="{{ route('admin.laporan.update', $l->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="w-8 h-8 flex items-center justify-center bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition-all hover:scale-110 active:scale-95"
                                                title="Selesaikan laporan">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.laporan.destroy', $l->id) }}" method="POST" onsubmit="return confirm('Hapus laporan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-100 transition-all hover:scale-110 active:scale-95"
                                            title="Hapus laporan">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-24 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12H9.75m3 0H9.75m0 0v-3.75m0 3.75v3.75M5.625 5.25A2.625 2.625 0 018.25 2.625h3.375a2.625 2.625 0 012.625 2.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a2.625 2.625 0 012.625 2.625v6.75A2.625 2.625 0 0116.875 19.5H8.25a2.625 2.625 0 01-2.625-2.625v-11.625z"/>
                                        </svg>
                                    </div>
                                    @if(request('search') || (request('status') && request('status') != 'semua'))
                                        <p class="text-slate-600 font-bold text-sm">Tidak ada hasil</p>
                                        <p class="text-slate-400 text-xs mt-1">Coba ubah filter atau kata kunci pencarian.</p>
                                    @else
                                        <p class="text-slate-600 font-bold text-sm">Belum ada laporan masuk</p>
                                        <p class="text-slate-400 text-xs mt-1">Laporan dari warga akan muncul di sini.</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection