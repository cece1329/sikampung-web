<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | Joyotakan Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            scroll-behavior: smooth;
            background-color: #f8fafc;
        }

        .bg-batik {
            background-color: #f8fafc;
            background-image:
                url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%2394a3b8' fill-opacity='0.05'%3E%3Cpath d='M50 0L100 50L50 100L0 50Z'/%3E%3Ccircle cx='50' cy='50' r='12'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 120px;
            background-attachment: fixed;
        }

        /* Dioptimalkan sedikit transparansinya agar motif batik di bawah card tetap mengintip estetik */
        .glass-card {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .marquee-text {
            white-space: nowrap;
            display: inline-block;
            animation: marquee 20s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .footer-glass {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(12px);
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>

<script>

    let secretCode = "";
    const targetCode = "joyo";

    document.addEventListener("keydown", function (e) {

        secretCode += e.key.toLowerCase();

        // biar cuma nyimpen 4 huruf terakhir
        if (secretCode.length > targetCode.length) {
            secretCode = secretCode.slice(-targetCode.length);
        }

        // kalau ketik JOYO
        if (secretCode === targetCode) {

            window.location.href = "{{ route('admin.login') }}";

        }

    });

</script>

<body class="bg-batik text-slate-900" id="profil">

    <nav class="fixed w-full z-50 bg-white/70 backdrop-blur-md border-b border-slate-200">

        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-lg italic">S</span>
                </div>
                <span class="text-lg md:text-xl font-black tracking-tight uppercase">
                    Si <span class="text-blue-600">Kampung</span>
                </span>
            </div>

<div class="flex items-center gap-7">
                <div class="hidden md:flex gap-7 text-[11px] font-bold uppercase tracking-wider text-slate-600 mr-4">
                    <a href="#statistik" class="hover:text-blue-600 transition">Statistik</a>
                    <a href="#berita" class="hover:text-blue-600 transition">Berita</a>
                    <a href="#tutorial" class="hover:text-blue-600 transition">Tutorial</a>
                </div>

                <!-- Mobile Hamburger -->
                <button id="mobileMenuBtn"
                    class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white/60 hover:bg-white transition border border-slate-200"
                    aria-label="Buka menu" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-700" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm1 4a1 1 0 100 2h12a1 1 0 100-2H4z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Dropdown -->
            <div id="mobileMenu" class="md:hidden hidden border-t border-slate-200 bg-white/80 backdrop-blur-md">
                <div class="max-w-7xl mx-auto px-6 py-3">
                    <a href="#statistik" class="block text-[11px] font-bold uppercase tracking-wider text-slate-600 hover:text-blue-600 transition py-2">Statistik</a>
                    <a href="#berita" class="block text-[11px] font-bold uppercase tracking-wider text-slate-600 hover:text-blue-600 transition py-2">Berita</a>
                    <a href="#tutorial" class="block text-[11px] font-bold uppercase tracking-wider text-slate-600 hover:text-blue-600 transition py-2">Tutorial</a>
                    <div class="border-t border-slate-200 mt-2 pt-2">
                        @auth
                            <a href="{{ route('laporan.profil') }}" class="block text-sm font-bold text-blue-900 bg-blue-50 border border-blue-100 rounded-2xl px-4 py-2 hover:opacity-80 transition mb-2">Lihat Profil</a>
                            <a href="{{ route('logout') }}" class="block text-sm font-bold text-red-600 hover:text-red-700 py-2">KELUAR</a>
                        @else
                            <a href="{{ route('login') }}" class="block text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-2xl px-4 py-2 transition">Masuk</a>
                        @endauth
                    </div>
                </div>
            </div>

                @auth
                    <div class="flex items-center gap-3 bg-blue-50 px-4 py-2 rounded-2xl border border-blue-100">
                        <a href="{{ route('laporan.profil') }}" class="flex items-center gap-3 hover:opacity-80 transition cursor-pointer" title="Lihat Profil">
                            <div class="text-right hidden sm:block">
                                <p class="text-[9px] font-black text-blue-400 uppercase leading-none">Warga</p>
                                <p class="text-xs font-bold text-blue-900">{{ Auth::user()->name }}</p>
                            </div>
                            <div
                                class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-sm">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </a>
                        <a href="{{ route('logout') }}"
                            class="text-[10px] font-bold text-red-500 hover:text-red-700 ml-2 border-l border-blue-200 pl-3 transition">
                            KELUAR
                        </a>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-full font-bold transition shadow-lg shadow-blue-200 text-sm">
                        Masuk
                    </a>
                @endauth
            </div>

        </div>
    </nav>

    @if(session('success'))
    <div id="toast-success" class="fixed top-24 left-1/2 transform -translate-x-1/2 z-[60] flex items-start gap-4 w-11/12 max-w-lg p-5 text-slate-800 bg-white rounded-2xl shadow-2xl border-l-8 border-green-500" role="alert" data-aos="fade-down">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-green-600 bg-green-100 rounded-full mt-1">
            <i class="bi bi-check-lg text-2xl font-black"></i>
        </div>
        <div class="flex-1 text-sm font-semibold leading-relaxed">
            <p class="text-green-700 font-black text-base mb-1">Berhasil!</p>
            {{ session('success') }}
        </div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-slate-400 hover:text-red-500 rounded-lg p-1.5 hover:bg-slate-100 inline-flex items-center justify-center h-8 w-8 transition" onclick="document.getElementById('toast-success').remove()" aria-label="Close">
            <i class="bi bi-x-lg font-bold"></i>
        </button>
    </div>
    
    <script>
        setTimeout(function() {
            const toast = document.getElementById('toast-success');
            if (toast) {
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                toast.style.transform = 'translate(-50%, -20px)';
                setTimeout(() => toast.remove(), 500);
            }
        }, 8000);
    </script>
    @endif

    <header class="relative min-h-screen flex items-center overflow-hidden">

        <div class="absolute inset-0 z-0">

            <img src="{{ asset('images/header_joyotakan.png') }}" class="w-full h-full object-cover" alt="Header">

            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/40 to-slate-900/20"></div>

        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full" data-aos="fade-up">

            <div class="max-w-2xl text-white">

                <div
                    class="inline-flex items-center gap-3 px-4 py-2 bg-white/10 backdrop-blur-lg border border-white/20 rounded-full text-[10px] font-bold uppercase tracking-[0.2em] text-blue-200 mb-7">

                    <span class="relative flex h-2 w-2">

                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>

                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>

                    </span>

                    Kelurahan Joyotakan • Surakarta

                </div>

                <h1 class="text-5xl md:text-7xl font-black leading-tight tracking-tight mb-6">

                    JOYO <br>

                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-300">
                        JAYA
                    </span>

                </h1>

                <p class="text-base md:text-lg text-slate-200 leading-relaxed mb-8 max-w-xl">

                    Melayani masyarakat dengan sistem info terpadu untuk lingkungan yang lebih modern,
                    transparan, dan berbudaya. Platform Pengaduan kerusakan fasilitas kampung.

                </p>

                <div class="flex flex-wrap gap-4">

                    <a href="{{ route('laporan.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-bold transition shadow-2xl shadow-blue-600/40">

                        Buat Laporan

                    </a>

                    <div class="flex items-center gap-4 px-5 py-4 border border-white/20 rounded-2xl backdrop-blur-md">

                        <div>

                            <p class="text-[10px] uppercase tracking-widest text-slate-300 font-bold">
                                Layanan 24/7
                            </p>

                            <p class="text-sm font-semibold">
                                Respon Cepat
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="absolute bottom-8 left-0 w-full overflow-hidden opacity-15 pointer-events-none">

            <div class="marquee-text text-[3vw] md:text-[2vw] font-black text-white uppercase italic tracking-wider">

                Joyotakan Digital • Surakarta Hadiningrat • Masyarakat Sejahtera • Joyotakan Jaya • 
                Joyotakan Digital • Surakarta Hadiningrat • Masyarakat Sejahtera • Joyotakan Jaya •

            </div>

        </div>

    </header>

    <section id="tutorial" class="py-24 px-6 relative">

        <div class="max-w-7xl mx-auto">

            <div class="text-center mb-16" data-aos="fade-up">

                <span class="text-blue-600 font-bold text-xs uppercase tracking-[0.3em]">
                    Panduan Warga
                </span>

                <h2 class="text-4xl md:text-5xl font-black tracking-tight uppercase mt-3">
                    Cara Membuat <br>
                    Laporan
                </h2>

                <p class="text-slate-500 mt-5 max-w-2xl mx-auto">
                    Ikuti langkah berikut untuk mengirim laporan resmi kepada Kelurahan Joyotakan
                    melalui sistem digital.
                </p>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                <div class="glass-card rounded-[2rem] p-8 shadow-xl relative overflow-hidden" data-aos="zoom-in">

                    <div class="absolute top-0 right-0 w-28 h-28 bg-blue-100 rounded-full blur-3xl opacity-60">
                    </div>

                    <div
                        class="w-14 h-14 rounded-2xl bg-blue-600 text-white flex items-center justify-center font-black text-xl mb-6 shadow-lg">
                        1
                    </div>

                    <h3 class="text-xl font-black mb-4">
                        Login Sistem
                    </h3>

                    <p class="text-slate-500 text-sm leading-relaxed">
                        Masuk menggunakan NIK warga atau akun admin untuk accessing layanan laporan digital.
                    </p>

                </div>

                <div class="glass-card rounded-[2rem] p-8 shadow-xl relative overflow-hidden" data-aos="zoom-in"
                    data-aos-delay="100">

                    <div class="absolute top-0 right-0 w-28 h-28 bg-indigo-100 rounded-full blur-3xl opacity-60">
                    </div>

                    <div
                        class="w-14 h-14 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-black text-xl mb-6 shadow-lg">
                        2
                    </div>

                    <h3 class="text-xl font-black mb-4">
                        Isi Form Aduan
                    </h3>

                    <p class="text-slate-500 text-sm leading-relaxed">
                        Lengkapi subjek laporan, lokasi kejadian, serta detail permasalahan secara jelas.
                    </p>

                </div>

                <div class="glass-card rounded-[2rem] p-8 shadow-xl relative overflow-hidden" data-aos="zoom-in"
                    data-aos-delay="200">

                    <div class="absolute top-0 right-0 w-28 h-28 bg-cyan-100 rounded-full blur-3xl opacity-60">
                    </div>

                    <div
                        class="w-14 h-14 rounded-2xl bg-cyan-600 text-white flex items-center justify-center font-black text-xl mb-6 shadow-lg">
                        3
                    </div>

                    <h3 class="text-xl font-black mb-4">
                        Upload Bukti
                    </h3>

                    <p class="text-slate-500 text-sm leading-relaxed">
                        Tambahkan foto kondisi lapangan agar laporan lebih valid dan mudah diproses.
                    </p>

                </div>

                <div class="glass-card rounded-[2rem] p-8 shadow-xl relative overflow-hidden" data-aos="zoom-in"
                    data-aos-delay="300">

                    <div class="absolute top-0 right-0 w-28 h-28 bg-emerald-100 rounded-full blur-3xl opacity-60">
                    </div>

                    <div
                        class="w-14 h-14 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-black text-xl mb-6 shadow-lg">
                        4
                    </div>

                    <h3 class="text-xl font-black mb-4">
                        Kirim Laporan
                    </h3>

                    <p class="text-slate-500 text-sm leading-relaxed">
                        Laporan akan diteruskan kepada admin kelurahan untuk diverifikasi dan ditindaklanjuti.
                    </p>

                </div>

            </div>

        </div>

    </section>

    <section id="statistik" class="py-20 px-6 relative z-10">

        <div class="max-w-7xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-14" data-aos="fade-up">

                <div>

                    <span class="text-blue-600 font-bold text-xs uppercase tracking-[0.3em]">
                        Live Data Monitoring
                    </span>

                    <h2 class="text-4xl md:text-5xl font-black tracking-tight mt-2 uppercase">
                        Statistik <br>
                        Laporan Warga
                    </h2>

                </div>

                <p class="text-slate-500 text-sm italic hidden md:block max-w-xs">
                    "Transparansi data untuk pelayanan publik yang lebih baik dan modern."
                </p>

            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                <div class="p-8 glass-card rounded-[2rem] shadow-xl border-b-4 border-blue-600">

                    <h3 class="text-4xl font-black text-blue-600 mb-2">
                        {{ $totalLaporan }}
                    </h3>

                    <p class="text-slate-500 text-[11px] font-bold uppercase tracking-widest">
                        Total Laporan
                    </p>

                </div>

                <div class="p-8 glass-card rounded-[2rem] shadow-xl border-b-4 border-green-500">

                    <h3 class="text-4xl font-black text-green-600 mb-2">
                        {{ $totalSelesai }}
                    </h3>

                    <p class="text-slate-500 text-[11px] font-bold uppercase tracking-widest">
                        Selesai
                    </p>

                </div>

                <div class="p-8 glass-card rounded-[2rem] shadow-xl border-b-4 border-orange-500">

                    <h3 class="text-4xl font-black text-orange-500 mb-2">
                        {{ $totalDiproses }}
                    </h3>

                    <p class="text-slate-500 text-[11px] font-bold uppercase tracking-widest">
                        Diproses
                    </p>

                </div>

                <div class="p-8 glass-card rounded-[2rem] shadow-xl border-b-4 border-slate-900">

                    <h3 class="text-4xl font-black text-slate-900 mb-2">
                        07
                    </h3>

                    <p class="text-slate-500 text-[11px] font-bold uppercase tracking-widest">
                        Cakupan RW
                    </p>

                </div>

            </div>

        </div>

    </section>

    <section id="berita" class="py-20 px-6">

        <div class="max-w-7xl mx-auto">

            <div class="text-center mb-14">

                <h2 class="text-4xl md:text-5xl font-black tracking-tight uppercase italic">
                    Warta Terkini
                </h2>

                <div class="w-24 h-2 bg-blue-600 mx-auto mt-4 rounded-full"></div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="group glass-card overflow-hidden rounded-[2rem] shadow-xl">

                    <div class="h-56 overflow-hidden">

                        <img src="{{ asset('images/berita/berita1.jpeg') }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-700">

                    </div>

                    <div class="p-8">

                        <h4 class="text-xl font-bold mb-3 group-hover:text-blue-600 transition">
                            Posyandu Remaja
                        </h4>

                        <p class="text-slate-500 text-sm leading-relaxed mb-5">
                            Pemeriksaan kesehatan rutin remaja wilayah RW 04.
                        </p>

                        <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest">
                            12 Mei 2026
                        </span>

                    </div>

                </div>

                <div class="group glass-card overflow-hidden rounded-[2rem] shadow-xl">

                    <div class="h-56 overflow-hidden">

                        <img src="{{ asset('images/berita/berita2.jpeg') }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-700">

                    </div>

                    <div class="p-8">

                        <h4 class="text-xl font-bold mb-3 group-hover:text-blue-600 transition">
                            Kerja Bakti Lingkungan
                        </h4>

                        <p class="text-slate-500 text-sm leading-relaxed mb-5">
                            Warga bersama membersihkan area lingkungan dan drainase.
                        </p>

                        <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest">
                            09 Mei 2026
                        </span>

                    </div>

                </div>

                <div class="group glass-card overflow-hidden rounded-[2rem] shadow-xl">

                    <div class="h-56 overflow-hidden">

                        <img src="{{ asset('images/berita/berita3.jpeg') }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-700">

                    </div>

                    <div class="p-8">

                        <h4 class="text-xl font-bold mb-3 group-hover:text-blue-600 transition">
                            Pelatihan UMKM Digital
                        </h4>

                        <p class="text-slate-500 text-sm leading-relaxed mb-5">
                            Pelatihan digital marketing bagi pelaku UMKM Joyotakan.
                        </p>

                        <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest">
                            05 Mei 2026
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <footer class="relative bg-slate-950 text-white overflow-hidden">

        <div class="absolute inset-0 opacity-5 flex items-center justify-center">

            <h2 class="text-[14vw] font-black">
                JOYOTAKAN
            </h2>

        </div>

        <div class="footer-glass relative z-10">

            <div class="max-w-7xl mx-auto px-6 py-16">

                <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

                    <div>

                        <div class="flex items-center gap-3 mb-5">

                            <div
                                class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center shadow-2xl shadow-blue-600/50">

                                <span class="text-white font-bold text-2xl italic">
                                    S
                                </span>

                            </div>

                            <span class="text-2xl font-black tracking-tight uppercase">
                                Si <span class="text-blue-500">Kampung</span>
                            </span>

                        </div>

                        <p class="text-slate-400 text-sm leading-relaxed mb-6">
                            Portal pelayanan digital Kelurahan Joyotakan untuk pelayanan masyarakat modern.
                        </p>

                        <div class="flex items-center gap-3">
                            <a href="https://instagram.com/kelurahanjoyotakan" target="_blank" rel="noopener noreferrer" 
                                class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-gradient-to-tr hover:from-amber-500 hover:via-pink-600 hover:to-purple-600 hover:text-white hover:border-transparent transition-all duration-300 group">
                                <i class="bi bi-instagram text-lg group-hover:scale-110 transition"></i>
                            </a>
                            
                            <a href="https://wa.me/6289540164305" target="_blank" rel="noopener noreferrer" 
                                class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-emerald-600 hover:text-white hover:border-emerald-500 transition-all duration-300 group">
                                <i class="bi bi-whatsapp text-lg group-hover:scale-110 transition"></i>
                            </a>
                        </div>

                    </div>

                    <div>

                        <h3 class="font-bold text-lg mb-5">
                            Informasi
                        </h3>

                        <ul class="space-y-3 text-sm text-slate-400">
                            <li><a href="https://kel-joyotakan.surakarta.go.id/" target="_blank" rel="noopener noreferrer" class="hover:text-blue-400 transition">Profil Kelurahan</a></li>
                            <li><a href="#tutorial" class="hover:text-blue-400 transition">Pelayanan Masyarakat</a></li>
                            <li><a href="#statistik" class="hover:text-blue-400 transition">Pengaduan Warga</a></li>
                            <li><a href="#berita" class="hover:text-blue-400 transition">Kegiatan RW</a></li>
                        </ul>

                    </div>

                    <div>

                        <h3 class="font-bold text-lg mb-5">
                            Kontak
                        </h3>

                        <ul class="space-y-3 text-sm text-slate-400">
                            <li>Kelurahan Joyotakan</li>
                            <li>Serengan, Surakarta</li>
                            <li>(0271) 000000</li>
                            <li>joyotakan@surakarta.go.id</li>
                        </ul>

                    </div>

                    <div>

                        <h3 class="font-bold text-lg mb-5">
                            Jam Pelayanan
                        </h3>

                        <ul class="space-y-3 text-sm text-slate-400">
                            <li>Senin - Kamis : 08.00 - 15.00</li>
                            <li>Jumat : 08.00 - 11.00</li>
                            <li>Sabtu - Minggu : Libur</li>
                        </ul>

                    </div>

                </div>

                <div
                    class="border-t border-white/10 mt-14 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">

                    <p class="text-slate-500 text-xs tracking-widest uppercase font-bold">
                        © 2026 SiKampung • Surakarta
                    </p>

                    <p class="text-slate-600 text-xs italic">
                        Dikembangkan oleh Citra Arifera
                    </p>

                </div>

            </div>

        </div>

    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({
            once: true,
            duration: 900
        });
    </script>

</body>

</html>