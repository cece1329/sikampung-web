<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | SiKampung Joyotakan</title>
    <meta name="description" content="Portal pelayanan digital dan pengaduan warga Kelurahan Joyotakan, Surakarta">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                            950: '#1e1b4b',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            scroll-behavior: smooth;
        }

        .bg-batik {
            background-color: #f8fafc;
            background-image:
                url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%236366f1' fill-opacity='0.03'%3E%3Cpath d='M50 0L100 50L50 100L0 50Z'/%3E%3Ccircle cx='50' cy='50' r='12'/%3E%3C/g%3E%3C/svg%3E");
            background-size: 100px;
            background-attachment: fixed;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .marquee-text {
            white-space: nowrap;
            display: inline-block;
            animation: marquee 25s linear infinite;
        }

        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .footer-glass {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(12px);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .hover-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<script>
    // Secret code entry to Admin Login: type "joyo" on the landing page
    let secretCode = "";
    const targetCode = "joyo";

    document.addEventListener("keydown", function (e) {
        secretCode += e.key.toLowerCase();
        if (secretCode.length > targetCode.length) {
            secretCode = secretCode.slice(-targetCode.length);
        }
        if (secretCode === targetCode) {
            window.location.href = "{{ route('admin.login') }}";
        }
    });

    // Secret tap gesture on Logo: tap 5 times to open admin login
    let logoTaps = 0;
    let tapTimeout;
    function handleLogoTap() {
        logoTaps++;
        if (logoTaps >= 5) {
            window.location.href = "{{ route('admin.login') }}";
            logoTaps = 0;
        }
        clearTimeout(tapTimeout);
        tapTimeout = setTimeout(() => {
            logoTaps = 0;
        }, 2000);
    }
</script>

<body class="bg-batik text-slate-800 antialiased" id="home">

    {{-- ===== NAVBAR ===== --}}
    <nav class="fixed w-full z-50 bg-white/75 backdrop-blur-xl border-b border-slate-200/60 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            
            {{-- Logo (Tapping 5 times redirects to Admin Login on mobile/desktop) --}}
            <div class="flex items-center gap-3 cursor-pointer select-none" onclick="handleLogoTap()">
                <div class="w-10 h-10 bg-brand-600 rounded-xl flex items-center justify-center shadow-lg shadow-brand-600/20">
                    <span class="text-white font-black text-lg italic">S</span>
                </div>
                <span class="text-lg md:text-xl font-black tracking-tight uppercase text-slate-800">
                    Si<span class="text-brand-600">Kampung</span>
                </span>
            </div>

            {{-- Desktop Actions and Menu --}}
            <div class="flex items-center gap-6">
                {{-- Navigation links --}}
                <div class="hidden md:flex items-center gap-8 text-[11px] font-extrabold uppercase tracking-wider text-slate-500">
                    <a href="#tutorial" class="hover:text-brand-600 transition">Tutorial</a>
                    <a href="#statistik" class="hover:text-brand-600 transition">Statistik</a>
                    <a href="#berita" class="hover:text-brand-600 transition">Berita</a>
                </div>

                {{-- Auth Button / Profile (Desktop) --}}
                <div class="hidden md:block">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <div class="flex items-center gap-3 bg-indigo-50 px-3.5 py-1.5 rounded-2xl border border-indigo-100/80">
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 hover:opacity-90 transition cursor-pointer" title="Ke Dashboard Admin">
                                    <div class="text-right">
                                        <p class="text-[9px] font-black text-indigo-500 uppercase leading-none">Administrator</p>
                                        <p class="text-xs font-bold text-indigo-900 mt-0.5">{{ Auth::user()->name }}</p>
                                    </div>
                                    <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-sm">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                </a>
                                <a href="{{ route('logout') }}"
                                    class="text-[10px] font-bold text-red-500 hover:text-red-700 ml-2 border-l border-indigo-200 pl-3 transition">
                                    KELUAR
                                </a>
                            </div>
                        @else
                            <div class="flex items-center gap-3 bg-brand-50 px-3.5 py-1.5 rounded-2xl border border-brand-100/80">
                                <a href="{{ route('laporan.profil') }}" class="flex items-center gap-3 hover:opacity-90 transition cursor-pointer" title="Lihat Profil">
                                    <div class="text-right">
                                        <p class="text-[9px] font-black text-brand-400 uppercase leading-none">Warga</p>
                                        <p class="text-xs font-bold text-brand-900 mt-0.5">{{ Auth::user()->name }}</p>
                                    </div>
                                    <div class="w-8 h-8 bg-brand-600 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-sm">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                </a>
                                <a href="{{ route('logout') }}"
                                    class="text-[10px] font-bold text-red-500 hover:text-red-700 ml-2 border-l border-brand-200 pl-3 transition">
                                    KELUAR
                                </a>
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="bg-brand-600 hover:bg-brand-700 text-white px-6 py-2.5 rounded-full font-bold transition shadow-md shadow-brand-600/10 text-sm">
                            Masuk
                        </a>
                    @endauth
                </div>

                <!-- Mobile Hamburger Button -->
                <button id="mobileMenuBtn"
                    class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 transition border border-slate-200/60"
                    aria-label="Buka menu" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-700" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm1 4a1 1 0 100 2h12a1 1 0 100-2H4z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

        </div>

        <!-- Mobile Dropdown -->
        <div id="mobileMenu" class="md:hidden hidden border-t border-slate-200/60 bg-white/95 backdrop-blur-xl">
            <div class="px-6 py-4 space-y-3">
                <a href="#tutorial" class="block text-xs font-bold uppercase tracking-wider text-slate-600 hover:text-brand-600 transition py-1">Tutorial</a>
                <a href="#statistik" class="block text-xs font-bold uppercase tracking-wider text-slate-600 hover:text-brand-600 transition py-1">Statistik</a>
                <a href="#berita" class="block text-xs font-bold uppercase tracking-wider text-slate-600 hover:text-brand-600 transition py-1">Berita</a>
                
                <div class="border-t border-slate-100 pt-3 mt-1">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <div class="flex items-center justify-between mb-3 bg-indigo-50 p-3 rounded-xl border border-indigo-100/50">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-sm">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-indigo-400 uppercase leading-none">Administrator</p>
                                        <p class="text-xs font-bold text-indigo-900 mt-0.5">{{ Auth::user()->name }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold text-indigo-600 hover:underline">Dashboard</a>
                            </div>
                        @else
                            <div class="flex items-center justify-between mb-3 bg-brand-50 p-3 rounded-xl border border-brand-100">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 bg-brand-600 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-sm">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-brand-400 uppercase leading-none">Warga</p>
                                        <p class="text-xs font-bold text-brand-900 mt-0.5">{{ Auth::user()->name }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('laporan.profil') }}" class="text-xs font-bold text-brand-600 hover:underline">Profil</a>
                            </div>
                        @endif
                        <a href="{{ route('logout') }}" class="block text-center text-sm font-bold text-red-600 bg-red-50 border border-red-100 rounded-xl py-2.5 hover:bg-red-100 transition">KELUAR</a>
                    @else
                        <a href="{{ route('login') }}" class="block text-center text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 rounded-xl py-2.5 transition">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- ===== TOAST NOTIFICATION ===== --}}
    @if(session('success'))
    <div id="toast-success" class="fixed top-24 left-1/2 transform -translate-x-1/2 z-[60] flex items-start gap-4 w-11/12 max-w-lg p-5 text-slate-800 bg-white rounded-2xl shadow-2xl border-l-8 border-emerald-500" role="alert" data-aos="fade-down">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-emerald-600 bg-emerald-100 rounded-full mt-0.5">
            <i class="bi bi-check-lg text-2xl font-black"></i>
        </div>
        <div class="flex-1 text-sm leading-relaxed">
            <p class="text-emerald-700 font-bold text-base mb-0.5">Berhasil!</p>
            <span class="text-slate-600 font-medium">{{ session('success') }}</span>
        </div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 text-slate-400 hover:text-red-500 rounded-lg p-1.5 hover:bg-slate-100 inline-flex items-center justify-center h-8 w-8 transition" onclick="document.getElementById('toast-success').remove()" aria-label="Close">
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

    {{-- ===== HERO SECTION ===== --}}
    <header class="relative min-h-screen flex items-center overflow-hidden pt-20">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/header_joyotakan.png') }}" class="w-full h-full object-cover scale-105 filter brightness-[0.8] contrast-[1.05]" alt="Header Joyotakan">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-slate-900/30"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full" data-aos="fade-up">
            <div class="max-w-3xl text-white">
                <div class="inline-flex items-center gap-3 px-4.5 py-2 bg-white/10 backdrop-blur-lg border border-white/20 rounded-full text-[10px] font-bold uppercase tracking-[0.2em] text-brand-200 mb-7 shadow-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-500"></span>
                    </span>
                    Kelurahan Joyotakan • Surakarta
                </div>

                <h1 class="text-5xl md:text-7xl font-extrabold leading-tight tracking-tight mb-6 uppercase">
                    Joyotakan <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-300 via-brand-200 to-emerald-200 font-black">
                        Digital
                    </span>
                </h1>

                <p class="text-base md:text-lg text-slate-200/90 leading-relaxed mb-10 max-w-xl">
                    Melayani masyarakat dengan sistem informasi terpadu untuk lingkungan yang lebih modern, 
                    transparan, dan responsif. Platform pengaduan warga resmi kelurahan Joyotakan.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('laporan.create') }}"
                        class="bg-brand-600 hover:bg-brand-700 hover:scale-[1.02] active:scale-[0.98] text-white px-8 py-4 rounded-2xl font-bold transition shadow-xl shadow-brand-600/30 text-sm">
                        Buat Laporan Warga
                    </a>
                    
                    <div class="flex items-center gap-4 px-6 py-4 bg-white/5 border border-white/15 rounded-2xl backdrop-blur-xl">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
                            <i class="bi bi-clock-fill text-sm"></i>
                        </div>
                        <div>
                            <p class="text-[9px] uppercase tracking-widest text-slate-300 font-bold">Layanan 24/7</p>
                            <p class="text-xs font-bold text-white">Respon Cepat Kelurahan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-8 left-0 w-full overflow-hidden opacity-20 pointer-events-none">
            <div class="marquee-text text-[3vw] md:text-[2vw] font-black text-white uppercase italic tracking-wider">
                Joyotakan Digital • Surakarta Hadiningrat • Masyarakat Sejahtera • Joyotakan Jaya • 
                Joyotakan Digital • Surakarta Hadiningrat • Masyarakat Sejahtera • Joyotakan Jaya •
            </div>
        </div>
    </header>

    {{-- ===== TUTORIAL SECTION ===== --}}
    <section id="tutorial" class="py-24 px-6 relative">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-brand-600 font-bold text-xs uppercase tracking-[0.3em] bg-brand-50 px-3 py-1.5 rounded-lg border border-brand-100/80">Panduan Warga</span>
                <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-900 mt-4 uppercase">
                    Alur Pengaduan Digital
                </h2>
                <p class="text-slate-500 mt-4 max-w-2xl mx-auto text-sm">
                    Ikuti 4 langkah mudah berikut untuk mengirimkan laporan kerusakan fasilitas umum ke Kelurahan Joyotakan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                
                {{-- Step 1 --}}
                <div class="glass-card rounded-[2rem] p-8 hover-card relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-brand-100 rounded-full blur-3xl opacity-50"></div>
                    <div class="w-12 h-12 rounded-xl bg-brand-600 text-white flex items-center justify-center font-black text-lg mb-6 shadow-md shadow-brand-600/20">
                        1
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-3">Login Sistem</h3>
                    <p class="text-slate-500 text-xs leading-relaxed">
                        Masuk menggunakan NIK (Nomor Induk Kependudukan) Anda yang telah terdaftar di sistem kelurahan.
                    </p>
                </div>

                {{-- Step 2 --}}
                <div class="glass-card rounded-[2rem] p-8 hover-card relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-100 rounded-full blur-3xl opacity-50"></div>
                    <div class="w-12 h-12 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-black text-lg mb-6 shadow-md shadow-indigo-600/20">
                        2
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-3">Isi Formulir</h3>
                    <p class="text-slate-500 text-xs leading-relaxed">
                        Isi form aduan dengan judul laporan, detail penjelasan, serta lokasi fasilitas yang rusak secara tepat.
                    </p>
                </div>

                {{-- Step 3 --}}
                <div class="glass-card rounded-[2rem] p-8 hover-card relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-cyan-100 rounded-full blur-3xl opacity-50"></div>
                    <div class="w-12 h-12 rounded-xl bg-cyan-600 text-white flex items-center justify-center font-black text-lg mb-6 shadow-md shadow-cyan-600/20">
                        3
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-3">Unggah Bukti</h3>
                    <p class="text-slate-500 text-xs leading-relaxed">
                        Ambil dan unggah foto bukti kerusakan di lapangan agar laporan Anda dapat segera diverifikasi kelurahan.
                    </p>
                </div>

                {{-- Step 4 --}}
                <div class="glass-card rounded-[2rem] p-8 hover-card relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-100 rounded-full blur-3xl opacity-50"></div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-black text-lg mb-6 shadow-md shadow-emerald-600/20">
                        4
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-3">Tindak Lanjut</h3>
                    <p class="text-slate-500 text-xs leading-relaxed">
                        Laporan dikirim. Anda dapat memantau status perkembangan laporan (Proses/Selesai) di profil Anda.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- ===== STATISTIK SECTION ===== --}}
    <section id="statistik" class="py-24 px-6 relative bg-slate-50/50 border-y border-slate-200/50">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-16" data-aos="fade-up">
                <div>
                    <span class="text-brand-600 font-bold text-xs uppercase tracking-[0.3em] bg-brand-50 px-3 py-1.5 rounded-lg border border-brand-100/80">Live Data Monitoring</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-900 mt-4 uppercase">
                        Statistik Laporan Warga
                    </h2>
                </div>
                <p class="text-slate-500 text-sm italic max-w-xs border-l-4 border-brand-500 pl-4 py-1">
                    Transparansi pengaduan publik demi pembangunan kelurahan yang lebih modern.
                </p>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                
                {{-- Stat 1 --}}
                <div class="p-8 bg-white rounded-[2rem] shadow-sm border border-slate-200/60 hover-card flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 bg-brand-50 text-brand-600 flex items-center justify-center rounded-xl mb-6">
                            <i class="bi bi-file-earmark-text-fill text-lg"></i>
                        </div>
                        <h3 class="text-4xl font-black text-slate-800 mb-2">{{ $totalLaporan }}</h3>
                    </div>
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mt-2">Total Pengaduan</p>
                </div>

                {{-- Stat 2 --}}
                <div class="p-8 bg-white rounded-[2rem] shadow-sm border border-slate-200/60 hover-card flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 flex items-center justify-center rounded-xl mb-6">
                            <i class="bi bi-check-circle-fill text-lg"></i>
                        </div>
                        <h3 class="text-4xl font-black text-slate-800 mb-2">{{ $totalSelesai }}</h3>
                    </div>
                    <p class="text-emerald-500 text-[10px] font-bold uppercase tracking-widest mt-2">Laporan Selesai</p>
                </div>

                {{-- Stat 3 --}}
                <div class="p-8 bg-white rounded-[2rem] shadow-sm border border-slate-200/60 hover-card flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 bg-amber-50 text-amber-600 flex items-center justify-center rounded-xl mb-6">
                            <i class="bi bi-arrow-repeat text-lg animate-spin" style="animation-duration: 6s;"></i>
                        </div>
                        <h3 class="text-4xl font-black text-slate-800 mb-2">{{ $totalDiproses }}</h3>
                    </div>
                    <p class="text-amber-500 text-[10px] font-bold uppercase tracking-widest mt-2">Sedang Diproses</p>
                </div>

                {{-- Stat 4 --}}
                <div class="p-8 bg-white rounded-[2rem] shadow-sm border border-slate-200/60 hover-card flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 bg-violet-50 text-violet-600 flex items-center justify-center rounded-xl mb-6">
                            <i class="bi bi-geo-alt-fill text-lg"></i>
                        </div>
                        <h3 class="text-4xl font-black text-slate-800 mb-2">07</h3>
                    </div>
                    <p class="text-violet-500 text-[10px] font-bold uppercase tracking-widest mt-2">Cakupan Wilayah RW</p>
                </div>

            </div>
        </div>
    </section>

    {{-- ===== BERITA SECTION ===== --}}
    <section id="berita" class="py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-brand-600 font-bold text-xs uppercase tracking-[0.3em] bg-brand-50 px-3 py-1.5 rounded-lg border border-brand-100/80">Kabar Lingkungan</span>
                <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-900 mt-4 uppercase">
                    Warta Terkini Joyotakan
                </h2>
                <div class="w-16 h-1 bg-brand-600 mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                {{-- Berita 1 --}}
                <div class="group bg-white overflow-hidden rounded-[2rem] border border-slate-200/60 hover-card">
                    <div class="h-56 overflow-hidden relative">
                        <img src="{{ asset('images/berita/berita1.jpeg') }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="Posyandu Remaja">
                        <span class="absolute top-4 left-4 bg-brand-600 text-white text-[9px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-lg">Kesehatan</span>
                    </div>
                    <div class="p-6">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">12 Mei 2026</span>
                        <h4 class="text-lg font-bold text-slate-800 mt-2 mb-3 group-hover:text-brand-600 transition">
                            Posyandu Remaja RW 04
                        </h4>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Pemeriksaan kesehatan rutin untuk para remaja wilayah RW 04 guna menjaga pola hidup sehat masyarakat kelurahan.
                        </p>
                    </div>
                </div>

                {{-- Berita 2 --}}
                <div class="group bg-white overflow-hidden rounded-[2rem] border border-slate-200/60 hover-card">
                    <div class="h-56 overflow-hidden relative">
                        <img src="{{ asset('images/berita/berita2.jpeg') }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="Kerja Bakti Lingkungan">
                        <span class="absolute top-4 left-4 bg-emerald-600 text-white text-[9px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-lg">Kebersihan</span>
                    </div>
                    <div class="p-6">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">09 Mei 2026</span>
                        <h4 class="text-lg font-bold text-slate-800 mt-2 mb-3 group-hover:text-brand-600 transition">
                            Kerja Bakti Bersama Warga
                        </h4>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Warga saling bahu-membahu membersihkan saluran drainase dan halaman umum menyambut musim pancaroba.
                        </p>
                    </div>
                </div>

                {{-- Berita 3 --}}
                <div class="group bg-white overflow-hidden rounded-[2rem] border border-slate-200/60 hover-card">
                    <div class="h-56 overflow-hidden relative">
                        <img src="{{ asset('images/berita/berita3.jpeg') }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="Pelatihan UMKM">
                        <span class="absolute top-4 left-4 bg-violet-600 text-white text-[9px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-lg">Ekonomi</span>
                    </div>
                    <div class="p-6">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">05 Mei 2026</span>
                        <h4 class="text-lg font-bold text-slate-800 mt-2 mb-3 group-hover:text-brand-600 transition">
                            Pelatihan UMKM Go Digital
                        </h4>
                        <p class="text-slate-500 text-xs leading-relaxed">
                            Pemberdayaan usaha mikro dengan pembekalan pemasaran online dan pembukuan digital di aula kelurahan.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ===== FOOTER ===== --}}
    <footer class="relative bg-slate-950 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-5 flex items-center justify-center select-none pointer-events-none">
            <h2 class="text-[14vw] font-black">JOYOTAKAN</h2>
        </div>

        <div class="footer-glass relative z-10">
            <div class="max-w-7xl mx-auto px-6 py-16">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                    
                    {{-- Col 1 --}}
                    <div>
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-12 h-12 bg-brand-600 rounded-2xl flex items-center justify-center shadow-xl shadow-brand-600/30">
                                <span class="text-white font-bold text-2xl italic">S</span>
                            </div>
                            <span class="text-2xl font-black tracking-tight uppercase">
                                Si<span class="text-brand-500">Kampung</span>
                            </span>
                        </div>
                        <p class="text-slate-400 text-xs leading-relaxed mb-6">
                            Portal pelayanan digital dan pengaduan kerusakan fasilitas umum resmi di wilayah Kelurahan Joyotakan, Surakarta.
                        </p>
                        <div class="flex items-center gap-3">
                            <a href="https://instagram.com/kelurahanjoyotakan" target="_blank" rel="noopener noreferrer" 
                                class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-gradient-to-tr hover:from-amber-500 hover:via-pink-600 hover:to-purple-600 hover:text-white hover:border-transparent transition-all duration-300">
                                <i class="bi bi-instagram text-base"></i>
                            </a>
                            
                            <a href="https://wa.me/6289540164305" target="_blank" rel="noopener noreferrer" 
                                class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-emerald-600 hover:text-white hover:border-emerald-500 transition-all duration-300">
                                <i class="bi bi-whatsapp text-base"></i>
                            </a>
                        </div>
                    </div>

                    {{-- Col 2 --}}
                    <div>
                        <h3 class="font-bold text-sm mb-5 uppercase tracking-wider text-slate-200">Informasi Link</h3>
                        <ul class="space-y-3 text-xs text-slate-400 font-medium">
                            <li><a href="https://kel-joyotakan.surakarta.go.id/" target="_blank" rel="noopener noreferrer" class="hover:text-brand-400 transition">Situs Resmi Kelurahan</a></li>
                            <li><a href="#tutorial" class="hover:text-brand-400 transition">Alur Pengaduan</a></li>
                            <li><a href="#statistik" class="hover:text-brand-400 transition font-bold text-brand-400">Live Statistik</a></li>
                            <li><a href="#berita" class="hover:text-brand-400 transition">Warta Kegiatan</a></li>
                            <li><a href="{{ route('admin.login') }}" class="hover:text-brand-400 transition opacity-60 hover:opacity-100">Portal Admin</a></li>
                        </ul>
                    </div>

                    {{-- Col 3 --}}
                    <div>
                        <h3 class="font-bold text-sm mb-5 uppercase tracking-wider text-slate-200">Kontak Kantor</h3>
                        <ul class="space-y-3 text-xs text-slate-400">
                            <li>Kelurahan Joyotakan</li>
                            <li>Kec. Serengan, Kota Surakarta</li>
                            <li>Jawa Tengah, Indonesia</li>
                            <li>joyotakan@surakarta.go.id</li>
                        </ul>
                    </div>

                    {{-- Col 4 --}}
                    <div>
                        <h3 class="font-bold text-sm mb-5 uppercase tracking-wider text-slate-200">Jam Operasional</h3>
                        <ul class="space-y-3 text-xs text-slate-400">
                            <li>Senin - Kamis : 08.00 - 15.00</li>
                            <li>Jumat : 08.00 - 11.00</li>
                            <li>Sabtu & Minggu : Libur Pelayanan</li>
                        </ul>
                    </div>

                </div>

                {{-- Peta Lokasi --}}
                <div class="mt-12 rounded-3xl overflow-hidden border border-white/10 shadow-2xl">
                    <div class="px-4 py-2.5 bg-white/5 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-300">Peta Lokasi Kantor Kelurahan</p>
                    </div>
                    <iframe
                        src="https://maps.google.com/maps?q=Kelurahan+Joyotakan,+Serengan,+Surakarta&output=embed"
                        width="100%"
                        height="240"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        class="w-full grayscale hover:grayscale-0 transition duration-500">
                    </iframe>
                </div>

                <div class="border-t border-white/10 mt-10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-slate-500 text-[10px] tracking-widest uppercase font-bold">
                        © 2026 SiKampung • Kelurahan Joyotakan
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
            duration: 800
        });

        // Mobile Menu toggle behavior
        (function () {
            const btn = document.getElementById('mobileMenuBtn');
            const menu = document.getElementById('mobileMenu');
            if (!btn || !menu) return;

            btn.setAttribute('aria-expanded', 'false');
            menu.classList.add('hidden');

            btn.addEventListener('click', function () {
                const isHidden = menu.classList.contains('hidden');
                if (isHidden) {
                    menu.classList.remove('hidden');
                    btn.setAttribute('aria-expanded', 'true');
                } else {
                    menu.classList.add('hidden');
                    btn.setAttribute('aria-expanded', 'false');
                }
            });
        })();
    </script>

</body>

</html>