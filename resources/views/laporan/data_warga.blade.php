@extends('layouts.admin')

@section('title', 'Manajemen Penduduk')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- Page Header --}}
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">Manajemen Penduduk</h2>
        <p class="text-slate-500 mt-1 text-sm">Kelola data warga Joyotakan untuk akses sistem laporan digital.</p>
    </div>

    {{-- Notifications --}}
    @if($errors->any())
        <div class="bg-rose-50 border border-rose-200/80 text-rose-800 p-4 rounded-2xl mb-6 flex items-start gap-3">
            <div class="w-8 h-8 rounded-xl bg-rose-100 flex items-center justify-center text-rose-600 flex-shrink-0 mt-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-sm">Terjadi Kesalahan</p>
                <ul class="list-disc list-inside text-xs text-rose-700 mt-1 space-y-0.5 font-medium">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200/80 text-emerald-800 p-4 rounded-2xl mb-6 flex items-start gap-3">
            <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600 flex-shrink-0 mt-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-sm">Berhasil!</p>
                <p class="text-xs text-emerald-700 mt-0.5 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        {{-- LEFT COLUMN: Tambah Warga --}}
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
                <h3 class="text-lg font-bold text-slate-800 mb-5 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                        </svg>
                    </div>
                    Tambah Warga Baru
                </h3>

                <form action="{{ route('admin.warga.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" name="name"
                            class="w-full bg-slate-50 border border-slate-200 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-400 text-sm transition"
                            placeholder="Sesuai KTP" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wider">NIK (No. KTP)</label>
                        <input type="text" name="nik" maxlength="16"
                            class="w-full bg-slate-50 border border-slate-200 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-400 font-mono text-sm transition"
                            placeholder="16 digit angka" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wider">RT</label>
                            <input type="text" name="rt" placeholder="Contoh: 01"
                                class="w-full bg-slate-50 border border-slate-200 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-400 text-sm transition"
                                required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wider">RW</label>
                            <input type="text" name="rw" placeholder="Contoh: 03"
                                class="w-full bg-slate-50 border border-slate-200 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-400 text-sm transition"
                                required>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-3 px-4 rounded-xl shadow-md shadow-brand-600/20 transition-all hover:shadow-lg active:scale-[0.98] text-sm">
                        Simpan Data Warga
                    </button>
                </form>
            </div>
        </div>

        {{-- RIGHT COLUMN: Daftar Warga --}}
        <div class="lg:col-span-8 space-y-6">
            
            {{-- Search Bar --}}
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-4">
                <form action="{{ route('admin.warga') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama, NIK, RT, RW..."
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50/50 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-400 text-sm transition">
                    </div>
                    <button type="submit"
                        class="bg-brand-600 hover:bg-brand-700 text-white px-6 py-2.5 rounded-xl font-semibold text-sm shadow-md shadow-brand-600/20 transition active:scale-[0.98]">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.warga') }}"
                           class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-2.5 rounded-xl font-semibold text-sm transition flex items-center justify-center">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            {{-- Table Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="p-4 md:p-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-slate-800">Daftar Warga Terdaftar</h3>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $wargas->count() }} warga terdaftar</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80">
                                <th class="py-3.5 px-5 text-[10px] uppercase tracking-widest text-slate-400 font-bold">Nama Warga</th>
                                <th class="py-3.5 px-5 text-[10px] uppercase tracking-widest text-slate-400 font-bold">NIK</th>
                                <th class="py-3.5 px-5 text-[10px] uppercase tracking-widest text-slate-400 font-bold text-center">RT / RW</th>
                                <th class="py-3.5 px-5 text-[10px] uppercase tracking-widest text-slate-400 font-bold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($wargas as $w)
                                <tr class="table-row-animate">
                                    <td class="py-4 px-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand-100 to-brand-200 flex items-center justify-center flex-shrink-0">
                                                <span class="text-brand-700 text-xs font-bold">{{ substr($w->name, 0, 1) }}</span>
                                            </div>
                                            <span class="font-semibold text-slate-800 text-sm">{{ $w->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-5 text-slate-600 font-mono text-sm">
                                        {{ $w->nik }}
                                    </td>
                                    <td class="py-4 px-5 text-center text-slate-500 font-semibold text-sm">
                                        {{ $w->rt }} / {{ $w->rw }}
                                    </td>
                                    <td class="py-4 px-5">
                                        <div class="flex justify-center gap-1.5">
                                            <button type="button"
                                                class="w-8 h-8 flex items-center justify-center bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all hover:scale-110 active:scale-95"
                                                onclick="document.getElementById('edit-{{ $w->id }}').classList.toggle('hidden')"
                                                title="Edit data warga">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </button>

                                            <form action="{{ route('admin.warga.destroy', $w->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus data warga ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-100 transition-all hover:scale-110 active:scale-95"
                                                    title="Hapus data warga">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Collapsible Edit Form Row --}}
                                <tr class="hidden bg-slate-50/50" id="edit-{{ $w->id }}">
                                    <td colspan="4" class="px-5 py-5 border-t border-b border-slate-100">
                                        <div class="bg-white p-5 rounded-2xl border border-slate-200/60 shadow-sm max-w-2xl mx-auto">
                                            <h4 class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 text-brand-600" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                                Edit Warga: <span class="text-brand-600">{{ $w->name }}</span>
                                            </h4>
                                            
                                            <form action="{{ route('admin.warga.update', $w->id) }}" method="POST"
                                                class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                @csrf
                                                @method('PATCH')

                                                <div>
                                                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wider">Nama Lengkap</label>
                                                    <input type="text" name="name" value="{{ $w->name }}"
                                                        class="w-full bg-slate-50 border border-slate-200 px-3.5 py-2.5 rounded-xl text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-400 outline-none transition"
                                                        required>
                                                </div>

                                                <div>
                                                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wider">NIK (16 digit)</label>
                                                    <input type="text" name="nik" value="{{ $w->nik }}" maxlength="16"
                                                        class="w-full bg-slate-50 border border-slate-200 px-3.5 py-2.5 rounded-xl font-mono text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-400 outline-none transition"
                                                        required>
                                                </div>

                                                <div>
                                                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wider">RT</label>
                                                    <input type="text" name="rt" value="{{ $w->rt }}"
                                                        class="w-full bg-slate-50 border border-slate-200 px-3.5 py-2.5 rounded-xl text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-400 outline-none transition"
                                                        required>
                                                </div>

                                                <div>
                                                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wider">RW</label>
                                                    <input type="text" name="rw" value="{{ $w->rw }}"
                                                        class="w-full bg-slate-50 border border-slate-200 px-3.5 py-2.5 rounded-xl text-sm focus:ring-2 focus:ring-brand-500/20 focus:border-brand-400 outline-none transition"
                                                        required>
                                                </div>

                                                <div class="md:col-span-2 flex justify-end gap-2 mt-2 pt-2 border-t border-slate-100">
                                                    <button type="button"
                                                        class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2.5 px-4 rounded-xl text-xs transition"
                                                        onclick="document.getElementById('edit-{{ $w->id }}').classList.add('hidden')">
                                                        Batal
                                                    </button>
                                                    <button type="submit"
                                                        class="bg-brand-600 hover:bg-brand-700 text-white font-bold py-2.5 px-5 rounded-xl text-xs shadow-md shadow-brand-600/20 transition">
                                                        Simpan Perubahan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center mb-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                            </div>
                                            @if(request('search'))
                                                <p class="text-slate-600 font-bold text-sm">Tidak ada hasil</p>
                                                <p class="text-slate-400 text-xs mt-1">Coba ubah kata kunci pencarian warga.</p>
                                            @else
                                                <p class="text-slate-600 font-bold text-sm">Belum ada data warga</p>
                                                <p class="text-slate-400 text-xs mt-1">Silakan tambahkan data warga baru di kolom sebelah kiri.</p>
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

    </div>

</div>
@endsection
