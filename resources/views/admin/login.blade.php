<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Joyotakan Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #020617;
        }

        .glass {
            background: rgba(15, 23, 42, 0.72);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .bg-pattern {
            background-image:
                radial-gradient(circle at 25% 25%, rgba(59, 130, 246, 0.15) 0, transparent 25%),
                radial-gradient(circle at 75% 75%, rgba(14, 165, 233, 0.12) 0, transparent 25%);
        }

        .input-style {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgb(51 65 85);
            transition: 0.3s;
        }

        .input-style:focus {
            border-color: rgb(59 130 246);
            box-shadow: 0 0 0 5px rgba(59, 130, 246, 0.15);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-6 overflow-hidden bg-pattern">

    <!-- BACKGROUND -->
    <div class="absolute inset-0 overflow-hidden">

        <div class="absolute -top-40 -left-40 w-[30rem] h-[30rem] bg-blue-600/20 rounded-full blur-3xl">
        </div>

        <div class="absolute bottom-0 right-0 w-[28rem] h-[28rem] bg-cyan-500/10 rounded-full blur-3xl">
        </div>

    </div>

    <!-- CARD -->
    <div class="relative z-10 w-full max-w-md glass rounded-[2.7rem] p-10 shadow-2xl">

        <!-- LOGO -->
        <div class="text-center mb-10">

            <div
                class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-700 rounded-[1.7rem] flex items-center justify-center mx-auto shadow-2xl shadow-blue-600/30 mb-6">

                <span class="text-white text-3xl font-black italic">
                    J
                </span>

            </div>

            <h1 class="text-3xl font-black tracking-tight text-white">
                Admin Panel
            </h1>

            <p class="text-slate-400 text-sm mt-3 leading-relaxed">
                Akses terbatas khusus administrator <br>
                Joyotakan Digital
            </p>

        </div>

        <!-- ERROR -->
        @if ($errors->any())
            <div class="mb-6 bg-red-500/10 border border-red-500/20 text-red-300 text-sm rounded-2xl px-5 py-4">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- FORM -->
        <form action="/login" method="POST" autocomplete="off" class="space-y-6">
            @csrf

            <div>

                <label class="block text-sm font-bold text-slate-300 mb-3">
                    PIN Administrator
                </label>

                <div class="relative">

                    <input type="password" name="pin" required autocomplete="new-password"
                        placeholder="Masukkan PIN Khusus"
                        class="input-style w-full px-5 py-4 rounded-2xl text-white placeholder:text-slate-500 outline-none">

                    <div class="absolute inset-y-0 right-5 flex items-center text-slate-500">
                        🔒
                    </div>

                </div>

            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-2xl font-bold shadow-2xl shadow-blue-600/20 transition duration-300 active:scale-95">

                Masuk Admin

            </button>

        </form>

        <!-- INFO -->
        <div class="mt-8 pt-6 border-t border-white/10 text-center">

            <p class="text-xs uppercase tracking-[0.2em] text-slate-500 font-bold">
                Authorized Personnel Only
            </p>

        </div>

        <!-- BACK -->
        <a href="/" class="block text-center mt-8 text-sm text-slate-500 hover:text-blue-400 transition">

            ← Kembali ke Beranda

        </a>

    </div>

</body>

</html>