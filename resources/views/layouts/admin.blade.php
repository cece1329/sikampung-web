<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | SiKampung Joyotakan</title>
    <meta name="description" content="Panel administrasi SiKampung Joyotakan - Sistem informasi kelurahan digital">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
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
        body { font-family: 'Inter', system-ui, sans-serif; }

        /* Sidebar transitions */
        .sidebar-link {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar-link:hover {
            transform: translateX(4px);
        }
        .sidebar-link.active {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(139, 92, 246, 0.1));
            border-left: 3px solid #818cf8;
        }

        /* Glassmorphism card */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        /* Stat card hover */
        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.1);
        }

        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(148, 163, 184, 0.3); border-radius: 8px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(148, 163, 184, 0.5); }

        /* Mobile overlay */
        .sidebar-overlay {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        .sidebar-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        /* Mobile sidebar */
        .mobile-sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .mobile-sidebar.active {
            transform: translateX(0);
        }

        /* Page content animation */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.4s ease-out;
        }

        /* Subtle glow on brand elements */
        .brand-glow {
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.15);
        }

        /* Table row animation */
        .table-row-animate {
            transition: all 0.15s ease;
        }
        .table-row-animate:hover {
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.03), rgba(139, 92, 246, 0.02));
        }
    </style>
</head>

<body class="bg-slate-50/80 min-h-screen">

    {{-- ===== MOBILE TOP BAR ===== --}}
    <header class="lg:hidden fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-xl border-b border-slate-200/60">
        <div class="flex items-center justify-between px-4 py-3">
            <div class="flex items-center gap-3">
                <button id="mobileSidebarBtn" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 hover:bg-slate-200 transition" aria-label="Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                </button>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center brand-glow">
                        <span class="text-white font-black text-sm">S</span>
                    </div>
                    <span class="font-bold text-slate-800 text-sm">SiKampung</span>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center">
                    <span class="text-white text-xs font-bold">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</span>
                </div>
            </div>
        </div>
    </header>

    {{-- ===== MOBILE SIDEBAR OVERLAY ===== --}}
    <div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 bg-black/40 z-[60] lg:hidden"></div>

    {{-- ===== SIDEBAR ===== --}}
    <aside id="mobileSidebar" class="mobile-sidebar lg:!transform-none fixed lg:fixed top-0 left-0 bottom-0 w-[272px] z-[70] lg:z-40 flex flex-col bg-white border-r border-slate-200/60">

        {{-- Logo --}}
        <div class="p-5 pb-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center brand-glow shadow-lg shadow-brand-500/20">
                    <span class="text-white font-black text-lg">S</span>
                </div>
                <div>
                    <h1 class="font-extrabold text-slate-900 text-base tracking-tight leading-tight">SiKampung</h1>
                    <p class="text-[10px] font-semibold text-brand-500 uppercase tracking-widest">Joyotakan</p>
                </div>
            </div>
        </div>

        <div class="px-4 mb-2">
            <div class="h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent"></div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-2 space-y-1 custom-scrollbar overflow-y-auto">
            <p class="px-3 pt-2 pb-2 text-[10px] font-bold text-slate-400 uppercase tracking-[0.12em]">Menu Utama</p>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold @if(request()->routeIs('admin.dashboard')) active text-brand-700 @else text-slate-600 hover:text-slate-900 hover:bg-slate-50 @endif">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center @if(request()->routeIs('admin.dashboard')) bg-brand-100 text-brand-600 @else bg-slate-100 text-slate-500 @endif">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
                    </svg>
                </div>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.warga') }}"
               class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold @if(request()->routeIs('admin.warga')) active text-brand-700 @else text-slate-600 hover:text-slate-900 hover:bg-slate-50 @endif">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center @if(request()->routeIs('admin.warga')) bg-brand-100 text-brand-600 @else bg-slate-100 text-slate-500 @endif">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                    </svg>
                </div>
                <span>Data Penduduk</span>
            </a>

            <div class="!mt-4 px-3 pt-2 pb-2">
                <div class="h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent"></div>
            </div>
            <p class="px-3 pt-1 pb-2 text-[10px] font-bold text-slate-400 uppercase tracking-[0.12em]">Lainnya</p>

            <a href="{{ route('home') }}"
               class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:text-slate-900 hover:bg-slate-50">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-slate-100 text-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                    </svg>
                </div>
                <span>Halaman Utama</span>
            </a>
        </nav>

        {{-- Bottom User / Logout --}}
        <div class="p-3 border-t border-slate-100">
            <div class="flex items-center gap-3 px-3 py-2 mb-1">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center shadow-sm">
                    <span class="text-white text-sm font-bold">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wide">Administrator</p>
                </div>
            </div>
            <a href="{{ route('logout') }}"
               class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-red-500 hover:bg-red-50 hover:text-red-600 group">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center bg-red-50 text-red-400 group-hover:bg-red-100 group-hover:text-red-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
                    </svg>
                </div>
                <span>Keluar</span>
            </a>
        </div>
    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="lg:ml-[272px] min-h-screen pt-[60px] lg:pt-0">
        <div class="p-4 md:p-6 lg:p-8 animate-fade-in-up">
            @yield('content')
        </div>
    </main>

    {{-- ===== SIDEBAR TOGGLE SCRIPT ===== --}}
    <script>
        (function() {
            const btn = document.getElementById('mobileSidebarBtn');
            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (!btn || !sidebar || !overlay) return;

            function openSidebar() {
                sidebar.classList.add('active');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
            function closeSidebar() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }

            btn.addEventListener('click', openSidebar);
            overlay.addEventListener('click', closeSidebar);

            // Close on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeSidebar();
            });
        })();
    </script>
</body>

</html>
