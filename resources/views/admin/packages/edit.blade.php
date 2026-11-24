<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between font-mono">
            <div>
                <h1 class="text-2xl font-black text-white tracking-tight flex items-center gap-2.5 font-tech uppercase">
                    <i class="fa-regular fa-pen-to-square text-cyan-400"></i>
                    <span>EDIT MODUL: {{ $package->name }}</span>
                </h1>
                <p class="text-xs text-slate-400 mt-1">Perbarui parameter tarif, kuota slot reaktor, atau waktu siklus</p>
            </div>
            <a href="{{ route('packages.index') }}" class="px-4 py-2 rounded-xl border border-cyan-500/30 text-cyan-300 hover:bg-cyan-500/10 font-bold text-xs transition">
                ← KEMBALI
            </a>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 py-8">
        <form action="{{ route('packages.update', $package->id) }}" method="POST" class="cyber-glass rounded-3xl p-8 border border-cyan-500/30 shadow-[0_0_40px_rgba(6,182,212,0.15)] space-y-6 font-mono">
            @csrf
            @method('PUT')

            <!-- Nama Paket -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-cyan-300 mb-2">
                    [NAMA_MODUL] Nama Paket Layanan <span class="text-rose-400">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-cyan-400">
                        <i class="fa-solid fa-atom"></i>
                    </span>
                    <input type="text" name="name" value="{{ $package->name }}" required 
                           class="w-full pl-11 pr-4 py-3 bg-slate-900 border border-cyan-500/30 rounded-2xl text-sm font-semibold text-white focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 outline-none transition">
                </div>
            </div>

            <!-- Tarif & Kapasitas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-cyan-300 mb-2">
                        [TARIF_CREDITS] Harga per Kg (Rp) <span class="text-rose-400">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-cyan-400 font-bold text-xs">
                            Rp
                        </span>
                        <input type="number" name="price" value="{{ $package->price }}" min="0" required 
                               class="w-full pl-11 pr-4 py-3 bg-slate-900 border border-cyan-500/30 rounded-2xl text-sm font-semibold text-white focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 outline-none transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-cyan-300 mb-2">
                        [KUOTA_REAKTOR] Kapasitas Slot <span class="text-rose-400">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-cyan-400">
                            <i class="fa-solid fa-server"></i>
                        </span>
                        <input type="number" name="stock" value="{{ $package->stock }}" min="0" required 
                               class="w-full pl-11 pr-4 py-3 bg-slate-900 border border-cyan-500/30 rounded-2xl text-sm font-semibold text-white focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 outline-none transition">
                    </div>
                </div>
            </div>

            <!-- Estimasi Pengerjaan -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-cyan-300 mb-2">
                    [DURASI_SIKLUS] Estimasi Waktu Selesai
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-cyan-400">
                        <i class="fa-regular fa-clock"></i>
                    </span>
                    <input type="text" name="estimate" value="{{ $package->estimate }}" 
                           class="w-full pl-11 pr-4 py-3 bg-slate-900 border border-cyan-500/30 rounded-2xl text-sm font-semibold text-white focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 outline-none transition">
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-cyan-300 mb-2">
                    [SPESIFIKASI] Rincian Layanan & Fasilitas <span class="text-rose-400">*</span>
                </label>
                <textarea name="description" rows="3" required 
                          class="w-full p-4 bg-slate-900 border border-cyan-500/30 rounded-2xl text-sm font-semibold text-white focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 outline-none transition font-sans">{{ $package->description }}</textarea>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-cyan-500/20">
                <a href="{{ route('packages.index') }}" class="px-5 py-3 rounded-xl border border-slate-700 hover:bg-slate-800 font-bold text-xs text-slate-400 transition">
                    ABORT
                </a>
                <button type="submit" class="px-6 py-3 rounded-xl bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-300 hover:to-blue-400 text-slate-950 font-black text-xs shadow-[0_0_20px_rgba(34,211,238,0.4)] transition uppercase">
                    <i class="fa-solid fa-check mr-1.5"></i> COMMIT CHANGES
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
