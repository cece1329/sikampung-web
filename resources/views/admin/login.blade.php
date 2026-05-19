<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Joyotakan Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }

        /* Motif Batik Ketupat */
        .bg-batik {
            background-image:
                url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%2394a3b8' fill-opacity='0.05'%3E%3Cpath d='M50 0L100 50L50 100L0 50Z'/%3E%3Ccircle cx='50' cy='50' r='12'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 120px;
        }

        .glass {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.7);
        }
    </style>
</head>

<body class="bg-batik min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md glass rounded-[2.5rem] p-10 shadow-2xl">

        <div class="text-center mb-10">

            <div
                class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center mx-auto shadow-2xl shadow-blue-600/30 mb-5">

                <span class="text-white text-2xl font-black italic">
                    J
                </span>

            </div>

            <h1 class="text-3xl font-black tracking-tight text-slate-900">
                Joyotakan <span class="text-blue-600">Digital</span>
            </h1>

            <p class="text-slate-500 text-sm mt-3 leading-relaxed">
                Sistem Pelayanan dan Pengaduan Warga Kelurahan Joyotakan
            </p>

        </div>

        <form action="/login" method="POST" class="space-y-6" id="loginForm">
            @csrf

            <div>

                <label class="block text-sm font-bold text-slate-700 mb-2">
                    NIK Warga
                </label>

                <input type="text" name="nik" id="nikInput" maxlength="16" placeholder="Masukkan 16 digit NIK"
                    class="w-full px-5 py-4 rounded-2xl border border-slate-200 bg-white/70 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition">

                <div id="peringatanNik" class="hidden mt-3 p-4 bg-red-50 border border-red-200 rounded-2xl flex items-start gap-2.5">
                    <span class="text-red-500 text-sm">⚠️</span>
                    <div>
                        <p class="text-xs font-bold text-red-800">Gagal Masuk Sistem</p>
                        <p class="text-[11px] text-red-600 mt-0.5" id="pesanDetail">NIK harus pas 16 digit angka!</p>
                    </div>
                </div>

            </div>

            <button type="button" onclick="cekValidasiWarga()"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-bold shadow-xl shadow-blue-600/20 transition duration-300 active:scale-95">

                Masuk ke Sistem

            </button>

        </form>

        <div class="mt-8 pt-6 border-t border-slate-200 text-center">

            <p class="text-xs text-slate-400 leading-relaxed">
                Portal resmi pengaduan masyarakat berbasis digital.
            </p>

            <p class="text-[11px] text-slate-300 mt-3 italic">
                Joyotakan • Surakarta
            </p>

        </div>

        <a href="/" class="block text-center mt-8 text-sm text-slate-400 hover:text-blue-600 transition">

            ← Kembali ke Beranda

        </a>

    </div>

    <script>
        const form = document.getElementById('loginForm');
        const nikInput = document.getElementById('nikInput');
        const peringatanBox = document.getElementById('peringatanNik');
        const pesanDetail = document.getElementById('pesanDetail');

        // Biar warga gak bisa ngetik huruf (otomatis kehapus kalau ngetik huruf)
        nikInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Sembunyikan kotak merah kalau pas diketik jumlahnya udah bener 16
            if (this.value.length === 16) {
                peringatanBox.classList.add('hidden');
                nikInput.classList.remove('border-red-400', 'focus:ring-red-100');
            }
        });

        // Fungsi pengecekan pas tombol diklik
        function cekValidasiWarga() {
            const nilaiNik = nikInput.value.trim();

            if (nilaiNik.length !== 16) {
                // Halaman gak bakalan ke-refresh di sini karena tipenya button biasa
                if (nilaiNik.length === 0) {
                    pesanDetail.innerText = "Kolom NIK masih kosong, diisi dulu ya!";
                } else {
                    pesanDetail.innerText = "Data salah! NIK kamu baru " + nilaiNik.length + " digit. Harus pas 16 digit angka.";
                }

                // Munculkan peringatan merahnya
                peringatanBox.classList.remove('hidden');
                nikInput.classList.add('border-red-400', 'focus:ring-red-100');
                nikInput.focus();
            } else {
                // Kalau sudah pas 16 digit angka, baru form dikirim resmi ke backend Laravel
                form.submit();
            }
        }
    </script>

</body>

</html>