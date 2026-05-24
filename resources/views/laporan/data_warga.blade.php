<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Penduduk | Joyotakan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50">
    <nav class="bg-white shadow-sm border-b border-slate-200 p-4 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold">J</span>
            </div>
            <h1 class="text-xl font-bold text-slate-800">ADMIN <span class="text-blue-600">JOYOTAKAN</span></h1>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-blue-600 hover:underline">
            ← Kembali ke Dashboard
        </a>
    </nav>

    <div class="p-8">
        <div class="max-w-4xl mx-auto">

            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-slate-900">Manajemen Penduduk</h2>
                <p class="text-slate-500">Input data warga Joyotakan agar mereka dapat mengakses sistem laporan.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 mb-8">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                    </svg>
                    Tambah Warga Baru
                </h3>

                <form action="{{ route('admin.warga.store') }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name"
                            class="w-full border-slate-200 border-2 p-3 rounded-xl focus:border-blue-500 focus:outline-none transition"
                            placeholder="Masukkan nama sesuai KTP" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">NIK (Nomor KTP)</label>
                        <input type="text" name="nik"
                            class="w-full border-slate-200 border-2 p-3 rounded-xl focus:border-blue-500 focus:outline-none transition"
                            placeholder="16 Digit NIK" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">RT</label>
                            <input type="text" name="rt"
                                class="w-full border-slate-200 border-2 p-3 rounded-xl focus:border-blue-500 focus:outline-none transition"
                                placeholder="Contoh: 01" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">RW</label>
                            <input type="text" name="rw"
                                class="w-full border-slate-200 border-2 p-3 rounded-xl focus:border-blue-500 focus:outline-none transition"
                                placeholder="Contoh: 03" required>
                        </div>
                    </div>

                    <button type="submit"
                        class="md:col-span-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-100 transition-all transform hover:scale-[1.01]">
                        Simpan Data Penduduk
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-4 md:p-6 border-b border-slate-100">
                    <h3 class="font-bold text-slate-800">Daftar Warga Terdaftar</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="py-3 px-4 md:px-6 text-[11px] md:text-xs font-bold text-slate-500 uppercase">Nama</th>
                                <th class="py-3 px-4 md:px-6 text-[11px] md:text-xs font-bold text-slate-500 uppercase">NIK</th>
                                <th class="py-3 px-4 md:px-6 text-[11px] md:text-xs font-bold text-slate-500 uppercase text-center">RT/RW</th>
                                <th class="py-3 px-4 md:px-6 text-[11px] md:text-xs font-bold text-slate-500 uppercase text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($wargas as $w)
                                <tr class="hover:bg-blue-50/50 transition">
                                    <td class="py-3 px-4 md:px-6 font-bold text-slate-700">{{ $w->name }}</td>
                                    <td class="py-3 px-4 md:px-6 text-slate-600 font-mono text-sm">{{ $w->nik }}</td>
                                    <td class="py-3 px-4 md:px-6 text-center text-slate-500 font-medium">{{ $w->rt }} / {{ $w->rw }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>