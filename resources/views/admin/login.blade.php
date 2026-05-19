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

        /* Motif Batik Ketupat - Disesuaikan untuk tema gelap */
        .bg-batik {
            background-color: #172554; /* bg-blue-950 */
            background-image:
                url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M50 0L100 50L50 100L0 50Z'/%3E%3Ccircle cx='50' cy='50' r='12'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 120px;
        }

        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="bg-batik min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md glass rounded-[2.5rem] p-10 shadow-2xl shadow-black/40">

        <div class="text-center mb-10">

            <div
                class="w-16 h-16 bg-slate-900 rounded-2xl flex items-center justify-center mx-auto shadow-2xl shadow-slate-900/30 mb-5 border border-slate-700">

                <span class="text-white text-2xl font-black italic">
                    S
                </span>

            </div>

            <h1 class="text-3xl font-black tracking-tight text-slate-900">
                Admin <span class="text-blue-600">Panel</span>
            </h1>

            <p class="text-slate-500 text-sm mt-3 leading-relaxed">
                Portal Manajemen Kelurahan Joyotakan
            </p>

        </div>

        <!-- Tambahkan autocomplete off di level form -->
        <form action="/login" method="POST" class="space-y-6" id="loginForm" autocomplete="off">
            @csrf
            
            <!-- Honeypot agar browser tidak mengira ini field password biasa -->
            <input type="text" style="display:none">
            <input type="password" style="display:none">

            <div>

                <label class="block text-sm font-bold text-slate-700 mb-2">
                    Kunci Akses (PIN)
                </label>

                <input type="password" name="pin" id="pinInput" placeholder="•••" required autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');"
                    class="w-full px-5 py-4 rounded-2xl border @error('message') border-red-500 @else border-slate-200 @enderror bg-slate-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition text-center tracking-widest text-2xl font-black text-slate-800">

                @error('message')
                    <p class="text-red-500 text-sm mt-2 font-medium text-center">{{ $message }}</p>
                @enderror

                <div id="peringatanPin" class="hidden mt-3 p-4 bg-red-50 border border-red-200 rounded-2xl flex items-start gap-2.5">
                    <span class="text-red-500 text-sm">⚠️</span>
                    <div>
                        <p class="text-xs font-bold text-red-800">Gagal Masuk Sistem</p>
                        <p class="text-[11px] text-red-600 mt-0.5" id="pesanDetail">PIN wajib diisi!</p>
                    </div>
                </div>

            </div>

            <button type="button" onclick="cekValidasiAdmin()"
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
        const pinInput = document.getElementById('pinInput');
        const peringatanBox = document.getElementById('peringatanPin');
        const pesanDetail = document.getElementById('pesanDetail');

        function cekValidasiAdmin() {
            const nilaiPin = pinInput.value.trim();

            if (nilaiPin.length === 0) {
                pesanDetail.innerText = "Kolom PIN masih kosong, silakan isi PIN Admin!";
                peringatanBox.classList.remove('hidden');
                pinInput.classList.add('border-red-400', 'focus:ring-red-100');
                pinInput.focus();
            } else {
                form.submit();
            }
        }
    </script>

</body>

</html>