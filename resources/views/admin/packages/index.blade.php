<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-cyan-950/60 border border-cyan-400/30 text-cyan-400 font-mono text-[10px] uppercase tracking-widest mb-1.5">
                    <span>CONFIG PROTOCOLS</span>
                </div>
                <h1 class="text-2xl font-black text-white tracking-tight flex items-center gap-2.5 font-tech uppercase">
                    <i class="fa-solid fa-server text-cyan-400"></i>
                    <span>DATA LAYANAN // CRUD MASTER</span>
                </h1>
                <p class="text-xs text-slate-400 font-mono mt-0.5">Kelola jenis layanan cuci (Reguler, Ekspres, Superkilat), tarif per kg, kuota harian, dan estimasi waktu</p>
            </div>

            <a href="{{ route('packages.create') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-300 hover:to-blue-400 text-slate-950 font-mono font-black text-xs rounded-xl shadow-[0_0_20px_rgba(34,211,238,0.4)] transition uppercase">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>+ TAMBAH LAYANAN BARU</span>
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        @if(session('success'))
            <div class="cyber-glass rounded-2xl border-emerald-500/40 p-4 shadow-[0_0_20px_rgba(16,185,129,0.2)] flex items-start gap-3 text-emerald-300 font-mono">
                <div class="w-8 h-8 rounded-xl bg-emerald-500/20 border border-emerald-400/40 flex items-center justify-center shrink-0 mt-0.5">
                    <i class="fa-solid fa-circle-check text-emerald-400"></i>
                </div>
                <div>
                    <h4 class="font-bold text-emerald-400 text-sm uppercase">MODULE REGISTRATION UPDATED</h4>
                    <p class="text-xs text-emerald-300/80 mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="cyber-glass rounded-3xl border-cyan-500/20 overflow-hidden shadow-[0_0_40px_rgba(0,0,0,0.5)]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-950/80 text-cyan-400/80 text-[10px] font-mono font-bold uppercase tracking-widest border-b border-cyan-500/20">
                            <th class="p-4 pl-6">NAMA MODUL</th>
                            <th class="p-4">TARIF SATUAN</th>
                            <th class="p-4">KAPASITAS REAKTOR</th>
                            <th class="p-4">DURASI SIKLUS</th>
                            <th class="p-4">SPESIFIKASI FASILITAS</th>
                            <th class="p-4 pr-6 text-center">TINDAKAN</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cyan-500/10 text-xs font-mono">
                        @forelse($packages as $package)
                            <tr class="hover:bg-cyan-950/20 transition">
                                <!-- Nama Paket -->
                                <td class="p-4 pl-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-cyan-950/60 border border-cyan-400/30 text-cyan-400 flex items-center justify-center text-sm shadow-[0_0_12px_rgba(34,211,238,0.2)]">
                                            <i class="fa-solid fa-atom"></i>
                                        </div>
                                        <div>
                                            <span class="block font-bold text-white text-sm font-tech">{{ $package->name }}</span>
                                            <span class="text-[10px] text-cyan-400/70">MODULE_ID: #0{{ $package->id }}</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Tarif -->
                                <td class="p-4">
                                    <span class="font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-300 text-sm block">
                                        Rp {{ number_format($package->price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-[10px] text-slate-500">/ KG ATAU PCS</span>
                                </td>

                                <!-- Kapasitas -->
                                <td class="p-4">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-slate-900 border border-cyan-500/30 text-cyan-300 text-xs font-bold">
                                        <i class="fa-solid fa-server text-[10px]"></i>
                                        <span>{{ $package->stock }} KUOTA</span>
                                    </span>
                                </td>

                                <!-- Estimasi -->
                                <td class="p-4">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-950/60 text-cyan-300 font-bold text-[11px] border border-cyan-400/30">
                                        <i class="fa-regular fa-clock text-xs"></i>
                                        <span>{{ $package->estimate ?? '1-2 HARI' }}</span>
                                    </span>
                                </td>

                                <!-- Deskripsi -->
                                <td class="p-4 text-slate-400 max-w-xs truncate font-sans">
                                    {{ $package->description }}
                                </td>

                                <!-- Aksi -->
                                <td class="p-4 pr-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('packages.edit', $package->id) }}" 
                                           class="px-3 py-1.5 rounded-xl border border-cyan-500/40 text-cyan-300 hover:bg-cyan-500/10 font-bold text-xs transition flex items-center gap-1 shadow-sm">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                            <span>EDIT</span>
                                        </a>

                                        <form action="{{ route('packages.destroy', $package->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Peringatan: Anda akan menghapus modul ini?')" 
                                                    class="px-3 py-1.5 rounded-xl border border-rose-500/40 text-rose-400 hover:bg-rose-950/30 font-bold text-xs transition flex items-center gap-1">
                                                <i class="fa-regular fa-trash-can"></i>
                                                <span>PURGE</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-16 text-center text-slate-500 font-mono">
                                    <h4 class="font-bold text-slate-300 text-sm uppercase">BELUM ADA MODUL TERDAFTAR</h4>
                                    <p class="text-xs text-slate-500 mt-1">Gunakan tombol "+ Tambah Modul Baru" untuk mengonfigurasi layanan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-cyan-500/20 bg-slate-950/60 font-mono">
                {{ $packages->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
