<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Joyotakan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50">
    <nav class="bg-white shadow-sm border-b border-slate-200 p-4 flex justify-between items-center sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold">J</span>
            </div>
            <h1 class="text-xl font-bold text-slate-800 tracking-tight">ADMIN <span
                    class="text-blue-600">JOYOTAKAN</span></h1>
        </div>
        <div class="flex items-center gap-6">
            <a href="{{ route('admin.warga') }}"
                class="text-sm font-bold text-slate-600 hover:text-blue-600 transition">Data Penduduk</a>
            <a href="{{ route('logout') }}"
                class="bg-red-50 text-red-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-red-100 transition">Keluar</a>
        </div>
    </nav>

    <div class="p-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Manajemen Laporan</h2>
                <p class="text-slate-500 mt-1">Update status aduan warga (Proses/Selesai).</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="py-4 px-6 text-[10px] uppercase tracking-widest text-slate-400 font-black">
                                    Tanggal</th>
                                <th class="py-4 px-6 text-[10px] uppercase tracking-widest text-slate-400 font-black">
                                    Pelapor</th>
                                <th class="py-4 px-6 text-[10px] uppercase tracking-widest text-slate-400 font-black">
                                    Aduan</th>
                                <th
                                    class="py-4 px-6 text-[10px] uppercase tracking-widest text-slate-400 font-black text-center">
                                    Bukti</th>
                                <th
                                    class="py-4 px-6 text-[10px] uppercase tracking-widest text-slate-400 font-black text-center">
                                    Status</th>
                                <th
                                    class="py-4 px-6 text-[10px] uppercase tracking-widest text-slate-400 font-black text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($laporans as $l)
                                <tr class="hover:bg-blue-50/30 transition duration-200">
                                    <td class="py-5 px-6 text-sm text-slate-500 font-medium">
                                        {{ $l->created_at->format('d/m/Y') }}</td>
                                    <td class="py-5 px-6">
                                        <div class="font-bold text-slate-800">{{ $l->user->name ?? 'Warga' }}</div>
                                        <div class="text-[10px] text-blue-500 font-bold uppercase tracking-tight">NIK:
                                            {{ $l->user->nik ?? '-' }}</div>
                                    </td>
                                    <td class="py-5 px-6">
                                        <div class="text-slate-800 font-semibold line-clamp-1">{{ $l->judul }}</div>
                                        <div class="text-[11px] text-slate-500 italic">{{ $l->lokasi }}</div>
                                    </td>
                                    <td class="py-5 px-6 text-center">
                                        <div class="flex justify-center">
                                            @if($l->foto)
                                                <img src="{{ asset('storage/' . $l->foto) }}"
                                                    class="w-12 h-12 object-cover rounded-xl shadow-sm border border-slate-200">
                                            @else
                                                <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center">
                                                    <span class="text-[8px] text-slate-400 font-bold uppercase">No Pic</span>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-5 px-6 text-center">
                                        {{-- PERBAIKAN STATUS DI SINI --}}
                                        @if ($l->status == 'proses')
                                            <span
                                                class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-[10px] font-black uppercase tracking-tighter">Diproses</span>
                                        @elseif($l->status == 'selesai') {{-- SUDAH DIGANTI JADI 'selesai' --}}
                                            <span
                                                class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-black uppercase tracking-tighter">Selesai</span>
                                        @else
                                            <span
                                                class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] font-black uppercase tracking-tighter">Ditinjau</span>
                                        @endif
                                    </td>
                                    <td class="py-5 px-6">
    <div class="flex justify-center gap-2">
        {{-- Tombol Jam (Proses) --}}
        {{-- Tombol ini muncul kalau statusnya masih 'ditinjau' --}}
        @if($l->status != 'proses' && $l->status != 'selesai')
            <form action="{{ route('admin.laporan.proses', $l->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" 
                    class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition" 
                    title="Proses">⏳</button>
            </form>
        @endif

        {{-- Tombol Centang (Selesai) --}}
        {{-- Tombol ini muncul selama statusnya belum 'selesai' --}}
        @if($l->status != 'selesai')
            <form action="{{ route('admin.laporan.update', $l->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" 
                    class="p-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition" 
                    title="Selesaikan">✅</button>
            </form>
        @endif

        {{-- Tombol Hapus --}}
        <form action="{{ route('admin.laporan.destroy', $l->id) }}" method="POST" onsubmit="return confirm('Hapus laporan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" 
                class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition" 
                title="Hapus">🗑️</button>
        </form>
    </div>
</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-32 text-center text-slate-400 font-bold">Belum ada laporan
                                        masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>