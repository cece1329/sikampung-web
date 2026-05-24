<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Laporan | Joyotakan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen py-8 px-4 sm:py-12 sm:px-6 overflow-x-hidden">
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
<div class="bg-blue-600 p-8 text-white">
            <h2 class="text-2xl font-bold">Formulir Pengaduan Warga</h2>
            <p class="text-blue-100 text-sm mt-1">Laporan Anda akan diteruskan ke Admin Kelurahan Joyotakan.</p>
        </div>

        <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-8 space-y-6">
            @csrf

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700">Subjek Laporan</label>
                <input type="text" name="judul" required placeholder="Contoh: Lampu Jalan Mati atau Selokan Mampet"
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700">Wilayah RW</label>
                    <select name="lokasi_rw" required
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none transition appearance-none bg-white">
                        <option value="">-- Pilih RW --</option>
                        <option value="RW 01">RW 01</option>
                        <option value="RW 02">RW 02</option>
                        <option value="RW 03">RW 03</option>
                        <option value="RW 04">RW 04</option>
                        <option value="RW 05">RW 05</option>
                        <option value="RW 06">RW 06</option>
                        <option value="RW 07">RW 07</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700">Detail Lokasi (RT/Nama Jalan)</label>
                    <input type="text" name="lokasi" required placeholder="Contoh: RT 03 / Jl. Joyotakan"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700">Deskripsi Detail</label>
                <textarea name="description" rows="4" required
                    placeholder="Ceritakan secara detail kronologi atau kondisi di lapangan..."
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none transition"></textarea>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700">Lampiran Foto Bukti</label>
                <div
                    class="border-2 border-dashed border-slate-200 rounded-2xl p-8 text-center hover:bg-blue-50/50 hover:border-blue-300 transition relative">
                    <input type="file" name="foto" id="fotoInput" class="absolute inset-0 opacity-0 cursor-pointer"
                        required accept="image/*" onchange="showPreview()">

                    <div id="previewArea" class="space-y-2">
                        <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-sm text-slate-500 font-medium">Klik untuk pilih foto bukti</p>
                        <p class="text-[10px] text-slate-400">Format: JPG, PNG (Max 2MB)</p>
                    </div>

                    <img id="imgPreview" class="hidden h-48 mx-auto rounded-xl shadow-md border-4 border-white">
                </div>
            </div>

            <div class="pt-4 flex gap-4">
                <a href="{{ route('home') }}"
                    class="flex-1 bg-slate-100 text-center py-4 rounded-xl font-bold text-slate-600 hover:bg-slate-200 transition">Batal</a>
                <button type="submit"
                    class="flex-[2] bg-blue-600 text-white py-4 rounded-xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 transition transform active:scale-95">
                    Kirim Laporan Resmi
                </button>
            </div>
        </form>
    </div>

    <script>
        function showPreview() {
            const input = document.getElementById('fotoInput');
            const preview = document.getElementById('imgPreview');
            const placeholder = document.getElementById('previewArea');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>