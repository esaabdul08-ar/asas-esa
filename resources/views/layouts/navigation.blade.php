<nav x-data="{ open: false }" class="bg-slate-950/90 backdrop-blur-xl border-b border-cyan-500/20 sticky top-0 z-30 shadow-[0_4px_30px_rgba(0,0,0,0.6)]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links (Desktop) Sesuai Soal Ujian (PDF) -->
                <div class="hidden sm:flex sm:items-center sm:gap-2 font-mono">
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold transition {{ request()->routeIs('dashboard') ? 'bg-cyan-500/15 text-cyan-300 border border-cyan-400/50 shadow-[0_0_15px_rgba(34,211,238,0.25)]' : 'text-slate-400 hover:text-cyan-300 hover:bg-slate-900 border border-transparent' }}">
                        <i class="fa-solid fa-chart-line text-sm"></i>
                        <span>REKAP TRANSAKSI LAUNDRY</span>
                    </a>

                    <a href="{{ route('packages.index') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold transition {{ request()->routeIs('packages.*') ? 'bg-cyan-500/15 text-cyan-300 border border-cyan-400/50 shadow-[0_0_15px_rgba(34,211,238,0.25)]' : 'text-slate-400 hover:text-cyan-300 hover:bg-slate-900 border border-transparent' }}">
                        <i class="fa-solid fa-server text-sm"></i>
                        <span>DATA LAYANAN</span>
                    </a>

                    <a href="{{ route('customer.index') }}" target="_blank"
                       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-slate-400 hover:text-cyan-300 hover:bg-slate-900 border border-transparent transition">
                        <i class="fa-solid fa-cash-register text-sm"></i>
                        <span>+ TRANSAKSI KASIR</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[9px] text-cyan-400"></i>
                    </a>
                </div>
            </div>

            <!-- Settings & User Profile (Desktop) -->
            <div class="hidden sm:flex sm:items-center sm:gap-4 font-mono">
                <!-- Role Badge -->
                @if(Auth::user()->role === 'admin')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest bg-purple-950/60 border border-purple-400/50 text-purple-300 shadow-[0_0_12px_rgba(168,85,247,0.3)]">
                        <span class="w-1.5 h-1.5 rounded-full bg-purple-400 animate-ping"></span>
                        <span>ADMIN_ROOT</span>
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest bg-cyan-950/60 border border-cyan-400/50 text-cyan-300 shadow-[0_0_12px_rgba(34,211,238,0.3)]">
                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-ping"></span>
                        <span>OPERATOR_KASIR</span>
                    </span>
                @endif

                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 p-1.5 pl-3 border border-cyan-500/30 hover:border-cyan-400 rounded-2xl bg-slate-900/80 hover:bg-slate-900 transition shadow-[0_0_15px_rgba(6,182,212,0.1)]">
                            <div class="text-left font-mono">
                                <div class="text-xs font-bold text-white leading-tight">{{ Auth::user()->name }}</div>
                                <div class="text-[10px] text-cyan-400/70 leading-tight">ONLINE // READY</div>
                            </div>

                            <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-cyan-500 to-indigo-600 text-slate-950 flex items-center justify-center font-black text-xs shadow-[0_0_10px_rgba(34,211,238,0.4)]">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-cyan-500/20 bg-slate-950">
                            <p class="text-[10px] font-mono text-slate-400 uppercase">AUTHENTICATED AS:</p>
                            <p class="text-xs font-mono font-bold text-cyan-300 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="text-xs font-mono py-2.5 flex items-center gap-2 hover:bg-slate-800 text-slate-300">
                            <i class="fa-solid fa-sliders text-cyan-400 text-xs w-4"></i>
                            <span>SYSTEM PREFERENCES</span>
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-xs font-mono text-rose-400 hover:bg-rose-950/30 py-2.5 flex items-center gap-2">
                                <i class="fa-solid fa-power-off text-xs w-4"></i>
                                <span>TERMINATE SESSION</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-900 border border-cyan-500/20 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-cyan-500/20 bg-slate-950 font-mono">
        <div class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 rounded-xl font-bold text-xs {{ request()->routeIs('dashboard') ? 'bg-cyan-500/20 text-cyan-300 border border-cyan-400/40' : 'text-slate-400 hover:bg-slate-900' }}">
                <i class="fa-solid fa-chart-line text-cyan-400"></i>
                <span>REKAP TRANSAKSI LAUNDRY</span>
            </a>

            <a href="{{ route('packages.index') }}" class="flex items-center gap-3 p-3 rounded-xl font-bold text-xs {{ request()->routeIs('packages.*') ? 'bg-cyan-500/20 text-cyan-300 border border-cyan-400/40' : 'text-slate-400 hover:bg-slate-900' }}">
                <i class="fa-solid fa-server text-cyan-400"></i>
                <span>DATA LAYANAN</span>
            </a>

            <a href="{{ route('customer.index') }}" target="_blank" class="flex items-center gap-3 p-3 rounded-xl font-bold text-xs text-slate-400 hover:bg-slate-900">
                <i class="fa-solid fa-cash-register text-cyan-400"></i>
                <span>+ TRANSAKSI KASIR</span>
            </a>
        </div>

        <div class="p-4 border-t border-cyan-500/20 bg-slate-900/60">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-xl bg-cyan-500 text-slate-950 flex items-center justify-center font-black text-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-bold text-xs text-white">{{ Auth::user()->name }}</div>
                    <div class="text-[10px] text-cyan-400">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left font-bold text-xs text-rose-400 hover:bg-rose-950/30 p-2.5 rounded-xl">
                    <i class="fa-solid fa-power-off mr-2"></i> TERMINATE SESSION
                </button>
            </form>
        </div>
    </div>
</nav>
