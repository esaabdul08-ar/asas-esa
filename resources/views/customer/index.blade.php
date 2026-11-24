<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLEANWASH // Quantum Cyber Laundry Terminal</title>

    <!-- Google Fonts: Space Grotesk & Outfit & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700;800&family=Outfit:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Outfit"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                        tech: ['"Space Grotesk"', 'sans-serif'],
                    },
                    colors: {
                        cyber: {
                            base: '#050813',
                            card: '#0a0f24',
                            border: 'rgba(56, 189, 248, 0.2)',
                            cyan: '#06b6d4',
                            neon: '#22d3ee',
                            blue: '#3b82f6',
                            purple: '#8b5cf6',
                            emerald: '#10b981',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Cyber Grid Background */
        body {
            background-color: #040711;
            background-image: 
                linear-gradient(rgba(34, 211, 238, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(34, 211, 238, 0.03) 1px, transparent 1px),
                radial-gradient(circle at 15% 15%, rgba(6, 182, 212, 0.12) 0%, transparent 45%),
                radial-gradient(circle at 85% 75%, rgba(139, 92, 246, 0.12) 0%, transparent 45%);
            background-size: 40px 40px, 40px 40px, auto, auto;
            background-attachment: fixed;
        }

        /* Sci-Fi Glass Card */
        .cyber-glass {
            background: rgba(10, 15, 36, 0.75);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(56, 189, 248, 0.18);
            box-shadow: 0 0 30px rgba(6, 182, 212, 0.06);
        }

        /* Sci-Fi HUD Corners */
        .hud-corner {
            position: relative;
        }
        .hud-corner::before {
            content: '';
            position: absolute;
            top: -2px; left: -2px;
            width: 10px; height: 10px;
            border-top: 2px solid #22d3ee;
            border-left: 2px solid #22d3ee;
            pointer-events: none;
        }
        .hud-corner::after {
            content: '';
            position: absolute;
            bottom: -2px; right: -2px;
            width: 10px; height: 10px;
            border-bottom: 2px solid #22d3ee;
            border-right: 2px solid #22d3ee;
            pointer-events: none;
        }

        /* Neon Glows */
        .neon-glow-cyan {
            box-shadow: 0 0 25px rgba(34, 211, 238, 0.35);
        }
        .neon-text-glow {
            text-shadow: 0 0 12px rgba(34, 211, 238, 0.6);
        }

        /* Animated Scanline */
        @keyframes scanline {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(1000%); }
        }
        .scanline-effect {
            position: relative;
            overflow: hidden;
        }
        .scanline-effect::after {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; height: 40px;
            background: linear-gradient(to bottom, transparent, rgba(34, 211, 238, 0.08), transparent);
            animation: scanline 8s linear infinite;
            pointer-events: none;
        }
    </style>
</head>
<body class="font-sans text-slate-200 antialiased min-h-screen flex flex-col selection:bg-cyan-500 selection:text-black">

    <!-- CYBERNETIC HUD HEADER -->
    <header class="sticky top-0 z-40 bg-slate-950/85 backdrop-blur-xl border-b border-cyan-500/20 shadow-[0_4px_30px_rgba(0,0,0,0.5)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('customer.index') }}" class="flex items-center gap-3">
                <x-application-logo />
            </a>

            <!-- HUD Center Stats (Hidden on small) -->
            <div class="hidden lg:flex items-center gap-6 px-4 py-2 rounded-2xl bg-cyan-950/30 border border-cyan-500/20 font-mono text-xs">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 shadow-[0_0_8px_#34d399] animate-pulse"></span>
                    <span class="text-slate-400">QUANTUM CORE:</span>
                    <span class="text-emerald-400 font-bold">ONLINE [99.8%]</span>
                </div>
                <div class="h-3 w-px bg-cyan-500/30"></div>
                <div class="flex items-center gap-2 text-slate-400">
                    <i class="fa-solid fa-clock text-cyan-400"></i>
                    <span id="liveClock" class="text-cyan-300 font-bold">--:--:-- WIB</span>
                </div>
            </div>

            <!-- Auth / Admin Link -->
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-white font-mono text-xs font-bold shadow-[0_0_20px_rgba(6,182,212,0.4)] transition">
                        <i class="fa-solid fa-terminal"></i>
                        <span>COMMAND CENTER</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-2 text-slate-400 hover:text-rose-400 transition" title="Log Out">
                            <i class="fa-solid fa-power-off text-base"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl text-xs font-mono font-bold text-cyan-400 hover:text-white border border-cyan-500/30 hover:bg-cyan-500/10 transition shadow-[0_0_15px_rgba(6,182,212,0.1)]">
                        ACCESS LOGIN
                    </a>
                    <a href="{{ route('register') }}" class="hidden sm:inline-flex px-4 py-2 rounded-xl bg-gradient-to-r from-cyan-500 to-indigo-600 hover:from-cyan-400 hover:to-indigo-500 text-slate-950 font-mono text-xs font-extrabold shadow-[0_0_20px_rgba(34,211,238,0.4)] transition">
                        REGISTER UNIT
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- MAIN INTERFACE -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8 pb-36">

        <!-- NOTIFICATION ALERTS -->
        @if(session('success'))
            <div class="cyber-glass rounded-2xl border-emerald-500/40 p-4 shadow-[0_0_20px_rgba(16,185,129,0.2)] flex items-start gap-3 text-emerald-300">
                <div class="w-8 h-8 rounded-xl bg-emerald-500/20 border border-emerald-400/40 flex items-center justify-center shrink-0 mt-0.5">
                    <i class="fa-solid fa-circle-check text-emerald-400"></i>
                </div>
                <div>
                    <h4 class="font-mono font-bold text-emerald-400 text-sm">TRANSACTION TRANSMITTED // SUCCESS</h4>
                    <p class="text-xs text-emerald-300/80 mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="cyber-glass rounded-2xl border-rose-500/40 p-4 shadow-[0_0_20px_rgba(244,63,94,0.2)] flex items-start gap-3 text-rose-300">
                <div class="w-8 h-8 rounded-xl bg-rose-500/20 border border-rose-400/40 flex items-center justify-center shrink-0 mt-0.5">
                    <i class="fa-solid fa-triangle-exclamation text-rose-400"></i>
                </div>
                <div>
                    <h4 class="font-mono font-bold text-rose-400 text-sm">TRANSACTION REJECTED // ERROR</h4>
                    <p class="text-xs text-rose-300/80 mt-0.5">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- FUTURISTIC HERO BANNER -->
        <div class="relative overflow-hidden rounded-3xl cyber-glass border border-cyan-500/30 p-8 md:p-12 shadow-[0_0_40px_rgba(6,182,212,0.15)] scanline-effect hud-corner">
            <!-- Background Visuals -->
            <div class="absolute -right-16 -bottom-16 w-96 h-96 rounded-full bg-cyan-500/10 blur-3xl pointer-events-none"></div>
            <div class="absolute right-10 top-1/2 -translate-y-1/2 hidden lg:block opacity-20 pointer-events-none text-cyan-400">
                <i class="fa-solid fa-atom text-[200px] animate-[spin_40s_linear_infinite]"></i>
            </div>

            <div class="relative z-10 max-w-3xl">
                <!-- Top Tech Pill -->
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-950/70 border border-cyan-400/40 text-cyan-300 font-mono text-[11px] mb-4 shadow-[0_0_12px_rgba(34,211,238,0.2)]">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-ping"></span>
                    <span>SISTEM INFORMASI MANAJEMEN LAUNDRY</span>
                </div>

                <h1 class="text-3xl md:text-5xl font-black tracking-tight leading-tight text-white mb-4 uppercase font-tech">
                    Layanan Cuci Laundry <br class="hidden sm:inline">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-sky-300 to-indigo-400 neon-text-glow">Reguler, Ekspres & Superkilat</span>
                </h1>

                <p class="text-slate-300 text-sm md:text-base leading-relaxed mb-8 max-w-2xl font-sans">
                    Aplikasi manajemen laundry berbasis web untuk mengelola data pelanggan, pencatatan transaksi masuk, penimbangan berat (kg), serta pemantauan status pengerjaan dari Proses menjadi Selesai.
                </p>

                <!-- 4 Tech Sensor Badges Sesuai Soal Ujian -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs font-mono">
                    <div class="cyber-glass rounded-2xl p-3 border-cyan-500/20 flex items-center gap-2.5">
                        <i class="fa-solid fa-shirt text-cyan-400 text-base"></i>
                        <div>
                            <span class="text-[10px] text-slate-400 block">REGULER</span>
                            <span class="font-bold text-white">Rp 7.000/kg</span>
                        </div>
                    </div>

                    <div class="cyber-glass rounded-2xl p-3 border-cyan-500/20 flex items-center gap-2.5">
                        <i class="fa-solid fa-bolt text-amber-400 text-base"></i>
                        <div>
                            <span class="text-[10px] text-slate-400 block">EKSPRES</span>
                            <span class="font-bold text-white">Rp 12.000/kg</span>
                        </div>
                    </div>

                    <div class="cyber-glass rounded-2xl p-3 border-cyan-500/20 flex items-center gap-2.5">
                        <i class="fa-solid fa-fire-flame-curved text-purple-400 text-base"></i>
                        <div>
                            <span class="text-[10px] text-slate-400 block">SUPERKILAT</span>
                            <span class="font-bold text-white">Rp 25.000/kg</span>
                        </div>
                    </div>

                    <div class="cyber-glass rounded-2xl p-3 border-cyan-500/20 flex items-center gap-2.5">
                        <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i>
                        <div>
                            <span class="text-[10px] text-slate-400 block">NOTIFIKASI</span>
                            <span class="font-bold text-white">WHATSAPP</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM PEMESANAN CYBER -->
        <form id="orderForm" action="{{ route('customer.checkout') }}" method="POST">
            @csrf

            <!-- STEP 1: IDENTITY TERMINAL -->
            <div class="cyber-glass rounded-3xl p-6 sm:p-8 border-cyan-500/20 mb-8 hud-corner">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-2xl bg-cyan-500/10 border border-cyan-400/40 text-cyan-400 font-mono font-bold flex items-center justify-center text-sm shadow-[0_0_15px_rgba(34,211,238,0.2)]">
                        01
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-white uppercase font-mono tracking-wider flex items-center gap-2">
                            <span>TERMINAL IDENTITAS PELANGGAN</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-ping"></span>
                        </h2>
                        <p class="text-xs text-slate-400">Data nomor digunakan transmisi telemetri nota & notifikasi WhatsApp otomatis</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-mono font-bold uppercase tracking-wider text-cyan-300 mb-2">
                            [ID_NAMA] Nama Lengkap Pemesan <span class="text-rose-400">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-cyan-400">
                                <i class="fa-solid fa-id-card-clip"></i>
                            </span>
                            <input type="text" id="customer_name" name="customer_name"
                                value="{{ Auth::check() ? Auth::user()->name : old('customer_name') }}"
                                required placeholder="Contoh: Budi Santoso"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-900/80 border border-cyan-500/30 rounded-2xl text-sm font-semibold text-white placeholder-slate-500 focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 outline-none transition shadow-inner">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-mono font-bold uppercase tracking-wider text-cyan-300 mb-2">
                            [ID_CONTACT] Nomor WhatsApp / Telepon <span class="text-rose-400">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-emerald-400">
                                <i class="fa-brands fa-whatsapp text-lg"></i>
                            </span>
                            <input type="tel" id="customer_phone" name="customer_phone"
                                required placeholder="Contoh: 081234567890"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-900/80 border border-cyan-500/30 rounded-2xl text-sm font-semibold text-white placeholder-slate-500 focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 outline-none transition shadow-inner">
                        </div>
                    </div>
                </div>
            </div>

            <!-- STEP 2: CYBER MODULE SELECTION -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-2xl bg-cyan-500/10 border border-cyan-400/40 text-cyan-400 font-mono font-bold flex items-center justify-center text-sm shadow-[0_0_15px_rgba(34,211,238,0.2)]">
                        02
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-white uppercase font-mono tracking-wider">
                            PILIH MODUL PENCUCIAN QUANTUM
                        </h2>
                        <p class="text-xs text-slate-400">Atur takaran berat cucian (Kilogram) atau jumlah potong pakaian</p>
                    </div>
                </div>

                <!-- CARDS GRID -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($packages as $index => $package)
                        <div class="package-card group cyber-glass rounded-3xl border border-slate-700/60 hover:border-cyan-400 p-6 flex flex-col justify-between transition-all duration-300 hover:scale-[1.02] hover:shadow-[0_0_35px_rgba(34,211,238,0.25)] relative overflow-hidden" id="card-pkg-{{ $package->id }}">
                            
                            <!-- Neon Glow Edge -->
                            <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-cyan-400 via-sky-300 to-indigo-500 opacity-60 group-hover:opacity-100 transition"></div>

                            <div>
                                <!-- Header Module Code & Price -->
                                <div class="flex items-center justify-between mb-4">
                                    <span class="px-2.5 py-1 text-[10px] font-mono font-bold uppercase tracking-widest bg-cyan-950/60 text-cyan-300 border border-cyan-400/30 rounded-xl">
                                        MODULE #0{{ $index + 1 }}
                                    </span>
                                    <div class="text-right">
                                        <span class="text-xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-300 block font-mono">
                                            Rp {{ number_format($package->price, 0, ',', '.') }}
                                        </span>
                                        <span class="text-[10px] font-mono text-slate-400">/ KG ATAU PCS</span>
                                    </div>
                                </div>

                                <!-- Package Title & Desc -->
                                <h3 class="font-bold text-white text-base leading-snug mb-2 group-hover:text-cyan-300 transition font-tech">
                                    {{ $package->name }}
                                </h3>
                                <p class="text-xs text-slate-400 leading-relaxed mb-5 line-clamp-3">
                                    {{ $package->description }}
                                </p>

                                <!-- Sensor Details -->
                                <div class="space-y-2 py-3 border-t border-b border-cyan-500/10 text-xs font-mono mb-5">
                                    <div class="flex items-center justify-between text-slate-300">
                                        <span class="flex items-center gap-1.5 text-slate-400">
                                            <i class="fa-regular fa-clock text-cyan-400"></i>
                                            <span>DURASI:</span>
                                        </span>
                                        <span class="font-bold text-cyan-300 bg-cyan-950/60 px-2 py-0.5 rounded border border-cyan-500/20 text-[11px]">
                                            {{ $package->estimate ?? '1-2 HARI' }}
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between text-slate-300">
                                        <span class="flex items-center gap-1.5 text-slate-400">
                                            <i class="fa-solid fa-server text-purple-400"></i>
                                            <span>SLOT REAKTOR:</span>
                                        </span>
                                        @if($package->stock > 0)
                                            <span class="font-bold text-emerald-400 text-[11px]">{{ $package->stock }} KUOTA</span>
                                        @else
                                            <span class="font-bold text-rose-400 text-[11px] bg-rose-950/40 px-1.5 py-0.5 rounded border border-rose-500/30">OVERLOAD</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Futuristic Counter -->
                            <div class="bg-slate-950/70 rounded-2xl p-3 border border-cyan-500/20">
                                <label class="block text-[10px] font-mono font-bold text-cyan-400 text-center uppercase tracking-widest mb-2">
                                    TAKARAN (KG / PCS)
                                </label>

                                @if($package->stock > 0)
                                    <div class="flex items-center justify-center gap-2">
                                        <button type="button" onclick="adjustQty({{ $package->id }}, -1)" 
                                                class="w-10 h-10 rounded-xl bg-slate-900 border border-cyan-500/30 text-cyan-400 hover:text-white hover:bg-cyan-500/20 active:scale-95 transition flex items-center justify-center font-mono font-bold shadow-sm">
                                            <i class="fa-solid fa-minus text-xs"></i>
                                        </button>

                                        <input type="number" 
                                            id="qty_input_{{ $package->id }}"
                                            name="items[{{ $package->id }}]" 
                                            min="0" 
                                            max="{{ $package->stock }}" 
                                            value="0"
                                            data-name="{{ $package->name }}" 
                                            data-price="{{ $package->price }}"
                                            oninput="updateCardUI({{ $package->id }})"
                                            class="item-qty w-20 py-2 text-center font-mono font-black text-white bg-slate-900 border border-cyan-500/40 rounded-xl focus:ring-2 focus:ring-cyan-400 outline-none text-base shadow-[0_0_10px_rgba(6,182,212,0.15)]">

                                        <button type="button" onclick="adjustQty({{ $package->id }}, 1)" 
                                                class="w-10 h-10 rounded-xl bg-cyan-500 text-slate-950 hover:bg-cyan-400 font-mono font-black active:scale-95 transition flex items-center justify-center shadow-[0_0_15px_rgba(34,211,238,0.4)]">
                                            <i class="fa-solid fa-plus text-xs"></i>
                                        </button>
                                    </div>
                                @else
                                    <div class="py-2.5 text-center text-xs font-mono font-bold text-rose-400 bg-rose-950/20 rounded-xl border border-rose-500/20">
                                        REAKTOR PENUH
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- FLOATING CYBER COMMAND DOCK (BOTTOM) -->
            <div class="fixed bottom-6 inset-x-4 max-w-4xl mx-auto z-30">
                <div class="cyber-glass rounded-3xl p-4 sm:p-5 shadow-[0_0_50px_rgba(6,182,212,0.25)] border-2 border-cyan-400/40 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-4 text-left w-full sm:w-auto">
                        <div class="w-12 h-12 rounded-2xl bg-cyan-500/20 border border-cyan-400/50 text-cyan-400 flex items-center justify-center text-2xl shrink-0 shadow-[0_0_15px_rgba(34,211,238,0.3)]">
                            <i class="fa-solid fa-microchip"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-mono uppercase tracking-widest text-cyan-300 block">ESTIMASI BIAYA QUANTUM:</span>
                            <div class="flex items-baseline gap-2">
                                <span class="text-2xl sm:text-3xl font-black text-white font-mono neon-text-glow" id="barTotalPrice">Rp 0</span>
                                <span class="text-xs font-mono text-slate-400" id="barTotalQty">[0 KG TERINPUT]</span>
                            </div>
                        </div>
                    </div>

                    <button type="button" onclick="showConfirmationModal()" 
                            class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-cyan-400 via-sky-400 to-indigo-500 hover:from-cyan-300 hover:to-indigo-400 text-slate-950 font-mono font-black text-sm tracking-wider shadow-[0_0_25px_rgba(34,211,238,0.5)] active:scale-95 transition flex items-center justify-center gap-3 uppercase">
                        <span>TRANSMIT ORDER // CETAK NOTA</span>
                        <i class="fa-solid fa-satellite-dish text-base animate-pulse"></i>
                    </button>
                </div>
            </div>

            <!-- MODAL: HOLOGRAPHIC QUANTUM RECEIPT -->
            <div id="confirmModal" class="fixed inset-0 bg-slate-950/85 backdrop-blur-xl hidden items-center justify-center z-50 p-4 transition-all">
                <div class="cyber-glass rounded-3xl max-w-md w-full border-2 border-cyan-400 shadow-[0_0_60px_rgba(6,182,212,0.35)] overflow-hidden relative hud-corner">
                    
                    <!-- Top Matrix Bar -->
                    <div class="bg-gradient-to-r from-cyan-950 via-slate-900 to-indigo-950 p-6 border-b border-cyan-500/30 text-center relative">
                        <button type="button" onclick="closeConfirmationModal()" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-slate-800 text-slate-400 hover:text-white flex items-center justify-center transition">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="font-mono text-[10px] tracking-widest text-cyan-400 uppercase mb-1">
                            /// HOLOGRAPHIC TRANSMISSION RECEIPT ///
                        </div>
                        <h3 class="text-2xl font-black text-white font-tech uppercase tracking-wider">CLEANWASH QUANTUM</h3>
                        <p class="text-xs text-slate-400 font-mono">ENCRYPTED TRANSACTION NOTE</p>
                    </div>

                    <!-- Receipt Content -->
                    <div class="p-6 space-y-4 font-mono text-xs">
                        <div class="space-y-1.5 pb-4 border-b border-dashed border-cyan-500/30 text-slate-300">
                            <div class="flex justify-between">
                                <span class="text-slate-400">PEMESAN:</span>
                                <span id="modalName" class="font-bold text-cyan-300"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">WHATSAPP:</span>
                                <span id="modalPhone" class="font-bold text-emerald-400"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">TIMESTAMP:</span>
                                <span class="text-slate-300">{{ date('d-m-Y // H:i') }} WIB</span>
                            </div>
                        </div>

                        <!-- Itemized Table -->
                        <div>
                            <span class="text-[10px] uppercase tracking-widest text-cyan-400 font-bold block mb-2">RINCIAN MODUL CUCI:</span>
                            <ul id="modalItemList" class="space-y-2 max-h-48 overflow-y-auto pr-1 divide-y divide-slate-800">
                                <!-- Populated by JS -->
                            </ul>
                        </div>

                        <!-- Total Tagihan -->
                        <div class="pt-4 border-t-2 border-dashed border-cyan-500/40 flex justify-between items-center">
                            <div>
                                <span class="text-[10px] text-slate-400 uppercase block">TOTAL CHARGES:</span>
                                <span class="text-[9px] text-cyan-300">STATUS: BELUM DIBAYAR</span>
                            </div>
                            <span id="modalTotalPrice" class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-300 font-mono">Rp 0</span>
                        </div>

                        <!-- WhatsApp Auto Alert Info -->
                        <div class="p-3 rounded-2xl bg-cyan-950/40 border border-cyan-500/30 text-[11px] text-cyan-300 flex items-center gap-2.5">
                            <i class="fa-brands fa-whatsapp text-emerald-400 text-lg"></i>
                            <span>Sistem akan memancarkan telemetri status cuci langsung ke nomor WhatsApp Anda.</span>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="grid grid-cols-2 gap-3 pt-2">
                            <button type="button" onclick="closeConfirmationModal()" 
                                    class="py-3 px-4 rounded-xl border border-slate-700 hover:bg-slate-800 text-slate-300 font-mono font-bold text-xs transition">
                                ABORT
                            </button>
                            <button type="submit" 
                                    class="py-3 px-4 rounded-xl bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-300 hover:to-blue-400 text-slate-950 font-mono font-black text-xs shadow-[0_0_20px_rgba(34,211,238,0.5)] transition uppercase">
                                EXECUTE ORDER
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <!-- CYBER FOOTER -->
    <footer class="border-t border-cyan-500/20 bg-slate-950/80 py-8 text-center text-xs font-mono text-slate-500">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center gap-2">
                <span class="text-cyan-400 font-bold">CLEANWASH // QUANTUM LAUNDRY OS</span>
                <span>• REKAYASA PERANGKAT LUNAK 2026</span>
            </div>
            <p>ALL SYSTEMS OPERATIONAL. NO ANOMALIES DETECTED.</p>
        </div>
    </footer>

    <!-- SCRIPT CLOCK & LOGIKA TRANSAKSI -->
    <script>
        // Realtime Sci-Fi Clock
        function updateClock() {
            const now = new Date();
            const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }) + ' WIB';
            const clockEl = document.getElementById('liveClock');
            if (clockEl) clockEl.textContent = timeStr;
        }
        setInterval(updateClock, 1000);
        updateClock();

        function adjustQty(packageId, change) {
            const input = document.getElementById('qty_input_' + packageId);
            if (!input) return;

            let val = parseInt(input.value) || 0;
            const max = parseInt(input.getAttribute('max')) || 999;
            val = Math.max(0, Math.min(max, val + change));
            input.value = val;
            updateCardUI(packageId);
        }

        function updateCardUI(packageId) {
            const input = document.getElementById('qty_input_' + packageId);
            const card = document.getElementById('card-pkg-' + packageId);
            const val = parseInt(input.value) || 0;

            if (val > 0) {
                card.classList.add('border-cyan-400', 'shadow-[0_0_35px_rgba(34,211,238,0.35)]', 'bg-cyan-950/30');
                card.classList.remove('border-slate-700/60');
            } else {
                card.classList.remove('border-cyan-400', 'shadow-[0_0_35px_rgba(34,211,238,0.35)]', 'bg-cyan-950/30');
                card.classList.add('border-slate-700/60');
            }
            recalcTotal();
        }

        function recalcTotal() {
            const items = document.querySelectorAll('.item-qty');
            let grandTotal = 0;
            let totalQty = 0;

            items.forEach(input => {
                const qty = parseInt(input.value) || 0;
                if (qty > 0) {
                    const price = parseFloat(input.getAttribute('data-price')) || 0;
                    grandTotal += (qty * price);
                    totalQty += qty;
                }
            });

            document.getElementById('barTotalPrice').textContent = 'Rp ' + grandTotal.toLocaleString('id-ID');
            document.getElementById('barTotalQty').textContent = `[${totalQty} KG TERINPUT]`;
        }

        function showConfirmationModal() {
            const name = document.getElementById('customer_name').value.trim();
            const phone = document.getElementById('customer_phone').value.trim();

            if (!name) {
                alert('[ERROR] Harap masukkan nama identitas pelanggan!');
                document.getElementById('customer_name').focus();
                return;
            }
            if (!phone) {
                alert('[ERROR] Harap masukkan nomor WhatsApp aktif!');
                document.getElementById('customer_phone').focus();
                return;
            }

            const items = document.querySelectorAll('.item-qty');
            let itemListHtml = '';
            let grandTotal = 0;
            let hasOrder = false;

            items.forEach(input => {
                const qty = parseInt(input.value) || 0;
                if (qty > 0) {
                    hasOrder = true;
                    const name = input.getAttribute('data-name');
                    const price = parseFloat(input.getAttribute('data-price')) || 0;
                    const subtotal = qty * price;
                    grandTotal += subtotal;

                    itemListHtml += `
                        <li class="py-2.5 flex items-center justify-between">
                            <div>
                                <span class="font-bold text-white block">${name}</span>
                                <span class="text-cyan-400/80 font-mono text-[10px]">${qty} KG/PCS x Rp ${price.toLocaleString('id-ID')}</span>
                            </div>
                            <span class="font-mono font-black text-white">Rp ${subtotal.toLocaleString('id-ID')}</span>
                        </li>
                    `;
                }
            });

            if (!hasOrder) {
                alert('[ANOMALY] Silakan tentukan minimal 1 kuota modul pencucian!');
                return;
            }

            document.getElementById('modalName').textContent = name;
            document.getElementById('modalPhone').textContent = phone;
            document.getElementById('modalItemList').innerHTML = itemListHtml;
            document.getElementById('modalTotalPrice').textContent = 'Rp ' + grandTotal.toLocaleString('id-ID');

            const modal = document.getElementById('confirmModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeConfirmationModal() {
            const modal = document.getElementById('confirmModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', recalcTotal);
    </script>
</body>
</html>
