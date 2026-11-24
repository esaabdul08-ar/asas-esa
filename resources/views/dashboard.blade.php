<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-cyan-950/60 border border-cyan-400/30 text-cyan-400 font-mono text-[10px] uppercase tracking-widest mb-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-ping"></span>
                    <span>LIVE TELEMETRY STREAM</span>
                </div>
                <h1 class="text-2xl font-black text-white tracking-tight flex items-center gap-2.5 font-tech uppercase">
                    <i class="fa-solid fa-satellite text-cyan-400"></i>
                    <span>REKAP TRANSAKSI LAUNDRY</span>
                </h1>
                <p class="text-xs text-slate-400 font-mono mt-0.5">Monitoring transaksi masuk, pembaruan status pengerjaan (Proses ➔ Selesai), dan laporan keuangan</p>
            </div>

            <div class="flex items-center gap-3 font-mono">
                <a href="{{ route('packages.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-900 border border-cyan-500/30 hover:border-cyan-400 text-cyan-300 rounded-xl text-xs font-bold transition shadow-[0_0_15px_rgba(6,182,212,0.1)]">
                    <i class="fa-solid fa-server text-cyan-400"></i>
                    <span>DATA LAYANAN</span>
                </a>

                <a href="{{ route('customer.index') }}" target="_blank" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-cyan-400 to-blue-500 hover:from-cyan-300 hover:to-blue-400 text-slate-950 rounded-xl text-xs font-black shadow-[0_0_25px_rgba(34,211,238,0.4)] transition uppercase">
                    <i class="fa-solid fa-cash-register text-xs"></i>
                    <span>+ INPUT TRANSAKSI BARU</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- STATUS ALERT NOTIFICATION -->
        @if(session('success'))
            <div class="cyber-glass rounded-2xl border-emerald-500/40 p-4 shadow-[0_0_20px_rgba(16,185,129,0.2)] flex items-start gap-3 text-emerald-300 font-mono">
                <div class="w-8 h-8 rounded-xl bg-emerald-500/20 border border-emerald-400/40 flex items-center justify-center shrink-0 mt-0.5">
                    <i class="fa-solid fa-circle-check text-emerald-400"></i>
                </div>
                <div>
                    <h4 class="font-bold text-emerald-400 text-sm uppercase">TELEMETRY UPDATED // PROTOCOL EXECUTED</h4>
                    <p class="text-xs text-emerald-300/80 mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- 5 FUTURISTIC KPI WIDGETS -->
        @php
            $totalOrders = $orders->count();
            $pendingOrders = $orders->filter(fn($o) => strtolower($o->status) == 'pending')->count();
            $prosesOrders = $orders->filter(fn($o) => strtolower($o->status) == 'proses')->count();
            $selesaiOrders = $orders->filter(fn($o) => in_array(strtolower($o->status), ['selesai', 'completed']))->count();
            $totalOmset = $orders->where('status', '!=', 'Batal')->sum('total_price');
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 font-mono">
            <!-- 1. Total Nota -->
            <div class="cyber-glass p-5 rounded-3xl border-cyan-500/20 hover:border-cyan-400 transition hover:shadow-[0_0_25px_rgba(6,182,212,0.2)] group">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">TOTAL NOTA</span>
                    <div class="w-8 h-8 rounded-xl bg-cyan-950/60 border border-cyan-500/30 text-cyan-400 flex items-center justify-center text-xs">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                </div>
                <div class="text-3xl font-black text-white group-hover:text-cyan-300 transition">{{ $totalOrders }}</div>
                <span class="text-[10px] text-slate-500 mt-1 block">[DATA STREAMS]</span>
            </div>

            <!-- 2. Antrean / Pending -->
            <div class="cyber-glass p-5 rounded-3xl border-amber-500/30 hover:border-amber-400 transition hover:shadow-[0_0_25px_rgba(245,158,11,0.2)] group">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-amber-400 text-[10px] font-bold uppercase tracking-widest">ANTREAN</span>
                    <div class="w-8 h-8 rounded-xl bg-amber-950/60 border border-amber-500/30 text-amber-400 flex items-center justify-center text-xs">
                        <i class="fa-solid fa-hourglass-start animate-spin"></i>
                    </div>
                </div>
                <div class="text-3xl font-black text-amber-400">{{ $pendingOrders }}</div>
                <span class="text-[10px] text-slate-500 mt-1 block">[WAITING CORE]</span>
            </div>

            <!-- 3. Sedang Dicuci / Proses -->
            <div class="cyber-glass p-5 rounded-3xl border-cyan-500/30 hover:border-cyan-300 transition hover:shadow-[0_0_25px_rgba(34,211,238,0.25)] group">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-cyan-400 text-[10px] font-bold uppercase tracking-widest">SEDANG DICUCI</span>
                    <div class="w-8 h-8 rounded-xl bg-cyan-950/60 border border-cyan-500/30 text-cyan-400 flex items-center justify-center text-xs">
                        <i class="fa-solid fa-atom animate-spin"></i>
                    </div>
                </div>
                <div class="text-3xl font-black text-cyan-300 neon-text-glow">{{ $prosesOrders }}</div>
                <span class="text-[10px] text-slate-500 mt-1 block">[NANO-CYCLES]</span>
            </div>

            <!-- 4. Selesai / Siap Ambil -->
            <div class="cyber-glass p-5 rounded-3xl border-emerald-500/30 hover:border-emerald-400 transition hover:shadow-[0_0_25px_rgba(16,185,129,0.2)] group">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-emerald-400 text-[10px] font-bold uppercase tracking-widest">SIAP AMBIL</span>
                    <div class="w-8 h-8 rounded-xl bg-emerald-950/60 border border-emerald-500/30 text-emerald-400 flex items-center justify-center text-xs">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
                <div class="text-3xl font-black text-emerald-400">{{ $selesaiOrders }}</div>
                <span class="text-[10px] text-slate-500 mt-1 block">[CYCLE FINISHED]</span>
            </div>

            <!-- 5. Total Omset -->
            <div class="col-span-2 md:col-span-1 cyber-glass p-5 rounded-3xl border-purple-500/40 hover:border-purple-300 transition hover:shadow-[0_0_30px_rgba(168,85,247,0.3)] bg-gradient-to-br from-slate-950 via-purple-950/40 to-slate-900">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-purple-300 text-[10px] font-bold uppercase tracking-widest">TOTAL OMSET</span>
                    <div class="w-8 h-8 rounded-xl bg-purple-900/40 border border-purple-400/40 text-purple-300 flex items-center justify-center text-xs">
                        <i class="fa-solid fa-coins"></i>
                    </div>
                </div>
                <div class="text-xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-300 via-pink-300 to-cyan-300 leading-tight">
                    Rp {{ number_format($totalOmset, 0, ',', '.') }}
                </div>
                <span class="text-[10px] text-slate-500 mt-1 block">[CREDITS VAULT]</span>
            </div>
        </div>

        <!-- REKAP TABLE HUD -->
        <div class="cyber-glass rounded-3xl border-cyan-500/20 overflow-hidden shadow-[0_0_40px_rgba(0,0,0,0.5)]">
            
            <!-- Filter Bar & Search Box -->
            <div class="p-5 border-b border-cyan-500/20 flex flex-col md:flex-row md:items-center md:justify-between gap-4 font-mono">
                <!-- Status Filter Tabs -->
                <div class="flex flex-wrap items-center gap-2" id="filterTabs">
                    <button type="button" onclick="filterStatus('all')" 
                            class="status-tab px-3.5 py-2 rounded-xl text-xs font-bold transition bg-cyan-500 text-slate-950 shadow-[0_0_15px_rgba(34,211,238,0.4)]" data-filter="all">
                        ALL_STREAMS ({{ $totalOrders }})
                    </button>
                    <button type="button" onclick="filterStatus('pending')" 
                            class="status-tab px-3.5 py-2 rounded-xl text-xs font-bold transition bg-slate-900 text-slate-400 hover:text-amber-300 border border-slate-800" data-filter="pending">
                        ⏳ PENDING ({{ $pendingOrders }})
                    </button>
                    <button type="button" onclick="filterStatus('proses')" 
                            class="status-tab px-3.5 py-2 rounded-xl text-xs font-bold transition bg-slate-900 text-slate-400 hover:text-cyan-300 border border-slate-800" data-filter="proses">
                        🫧 ACTIVE_WASH ({{ $prosesOrders }})
                    </button>
                    <button type="button" onclick="filterStatus('selesai')" 
                            class="status-tab px-3.5 py-2 rounded-xl text-xs font-bold transition bg-slate-900 text-slate-400 hover:text-emerald-300 border border-slate-800" data-filter="selesai">
                        ✅ COMPLETED ({{ $selesaiOrders }})
                    </button>
                </div>

                <!-- Live Search Box -->
                <div class="relative w-full md:w-80">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-cyan-400">
                        <i class="fa-solid fa-barcode text-sm"></i>
                    </span>
                    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="[SCAN NOTA // FILTER ID / NAMA]" 
                           class="w-full pl-10 pr-4 py-2 bg-slate-950/80 border border-cyan-500/30 rounded-xl text-xs font-mono text-cyan-300 placeholder-slate-600 focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 outline-none transition shadow-inner">
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse" id="ordersTable">
                    <thead>
                        <tr class="bg-slate-950/80 text-cyan-400/80 text-[10px] font-mono font-bold uppercase tracking-widest border-b border-cyan-500/20">
                            <th class="p-4 pl-6">INVOICE_HASH</th>
                            <th class="p-4">CLIENT_PROFILE // WHATSAPP</th>
                            <th class="p-4">PAYLOAD_MODULE</th>
                            <th class="p-4">CREDITS_FEE</th>
                            <th class="p-4">CYCLE_TELEMETRY</th>
                            <th class="p-4 pr-6 text-center">OVERRIDE_STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cyan-500/10 text-xs font-mono">
                        @forelse($orders as $order)
                            @php
                                $statusLower = strtolower($order->status);
                            @endphp
                            <tr class="order-row hover:bg-cyan-950/20 transition" data-status="{{ $statusLower }}">
                                <!-- Kode Nota -->
                                <td class="p-4 pl-6">
                                    <div class="flex items-center gap-2 font-bold text-white tracking-wider">
                                        <span class="w-2 h-2 rounded-full {{ $statusLower == 'selesai' ? 'bg-emerald-400 shadow-[0_0_8px_#34d399]' : ($statusLower == 'proses' ? 'bg-cyan-400 shadow-[0_0_8px_#22d3ee] animate-pulse' : 'bg-amber-400 shadow-[0_0_8px_#fbbf24]') }}"></span>
                                        <span>{{ $order->order_code }}</span>
                                    </div>
                                    <span class="text-[10px] text-slate-500 block mt-0.5">{{ $order->created_at->format('d/m/Y // H:i') }}</span>
                                </td>

                                <!-- Pelanggan & WhatsApp Relay -->
                                <td class="p-4 font-sans">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-cyan-500 to-indigo-600 text-slate-950 font-black text-xs flex items-center justify-center shrink-0 shadow-[0_0_10px_rgba(34,211,238,0.3)]">
                                            {{ strtoupper(substr($order->customer_name ?? 'C', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-white text-sm customer-name">{{ $order->customer_name }}</div>
                                            @if($order->customer_phone)
                                                <div class="flex items-center gap-2 mt-1 font-mono">
                                                    <span class="text-[11px] text-slate-400">📞 {{ $order->customer_phone }}</span>
                                                    @php
                                                        $phone = preg_replace('/[^0-9]/', '', $order->customer_phone);
                                                        if (str_starts_with($phone, '0')) {
                                                            $phone = '62' . substr($phone, 1);
                                                        }
                                                        $statusText = strtoupper($order->status);
                                                        $pesanWa = urlencode("Halo Kak {$order->customer_name}, telemetri pesanan laundry Anda (#{$order->order_code}) saat ini berstatus: [{$statusText}] di CleanWash Quantum. Total biaya: Rp " . number_format($order->total_price, 0, ',', '.') . ". Terima kasih!");
                                                    @endphp
                                                    <a href="https://wa.me/{{ $phone }}?text={{ $pesanWa }}" target="_blank"
                                                       class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-500 hover:bg-emerald-400 text-slate-950 text-[10px] font-black shadow-[0_0_12px_rgba(16,185,129,0.4)] transition"
                                                       title="Pancarkan Pesan WhatsApp">
                                                        <i class="fa-brands fa-whatsapp text-xs"></i>
                                                        <span>TRANSMIT WA</span>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- Payload Modul -->
                                <td class="p-4">
                                    <div class="space-y-1">
                                        @foreach($order->orderDetails as $detail)
                                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-slate-900 border border-cyan-500/20 rounded-lg text-slate-300 text-[11px]">
                                                <span class="text-white font-bold">{{ $detail->package->name ?? 'Paket' }}</span>
                                                <span class="text-cyan-400 font-extrabold">x{{ $detail->quantity }} KG/PCS</span>
                                                <span class="text-slate-500">(Rp {{ number_format($detail->subtotal, 0, ',', '.') }})</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>

                                <!-- Total Credits -->
                                <td class="p-4">
                                    <span class="font-black text-sm text-white block neon-text-glow">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                    <span class="text-[9px] text-cyan-400/80 uppercase">CREDIT PENDING</span>
                                </td>

                                <!-- Telemetry Status -->
                                <td class="p-4">
                                    @if($statusLower == 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-amber-950/60 text-amber-300 border border-amber-500/40 shadow-[0_0_10px_rgba(245,158,11,0.2)]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-ping"></span>
                                            <span>QUEUE_PENDING</span>
                                        </span>
                                    @elseif($statusLower == 'proses')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-cyan-950/60 text-cyan-300 border border-cyan-400/50 shadow-[0_0_15px_rgba(34,211,238,0.3)]">
                                            <i class="fa-solid fa-atom animate-spin text-[10px]"></i>
                                            <span>ACTIVE_CYCLE</span>
                                        </span>
                                    @elseif(in_array($statusLower, ['selesai', 'completed']))
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-emerald-950/60 text-emerald-300 border border-emerald-400/50 shadow-[0_0_15px_rgba(16,185,129,0.3)]">
                                            <i class="fa-solid fa-check text-[10px]"></i>
                                            <span>CYCLE_FINISHED</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-rose-950/60 text-rose-300 border border-rose-500/40">
                                            <span>{{ strtoupper($order->status) }}</span>
                                        </span>
                                    @endif
                                </td>

                                <!-- Status Control Dropdown -->
                                <td class="p-4 pr-6 text-center">
                                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" 
                                                class="text-xs font-mono font-bold rounded-xl border border-cyan-500/30 bg-slate-900 text-cyan-300 hover:border-cyan-400 py-1.5 px-3 focus:ring-2 focus:ring-cyan-400 outline-none cursor-pointer transition shadow-inner">
                                            <option value="Pending" {{ $statusLower == 'pending' ? 'selected' : '' }}>⏳ PENDING</option>
                                            <option value="Proses" {{ $statusLower == 'proses' ? 'selected' : '' }}>🫧 PROSES CUCI</option>
                                            <option value="Selesai" {{ in_array($statusLower, ['selesai', 'completed']) ? 'selected' : '' }}>✅ SELESAI</option>
                                            <option value="Batal" {{ $statusLower == 'batal' ? 'selected' : '' }}>❌ BATAL</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-16 text-center text-slate-500 font-mono">
                                    <div class="w-16 h-16 mx-auto rounded-3xl bg-slate-900 border border-cyan-500/20 flex items-center justify-center text-2xl text-cyan-400 mb-3 shadow-[0_0_20px_rgba(6,182,212,0.1)]">
                                        <i class="fa-solid fa-radar animate-pulse"></i>
                                    </div>
                                    <h4 class="font-bold text-slate-300 text-sm uppercase">NO ACTIVE TELEMETRY STREAMS</h4>
                                    <p class="text-xs text-slate-500 mt-1">Transmisikan data cucian pertama melalui Terminal Kasir.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SCRIPT FILTER TABEL -->
    <script>
        function filterStatus(status) {
            document.querySelectorAll('.status-tab').forEach(tab => {
                if (tab.getAttribute('data-filter') === status) {
                    tab.classList.add('bg-cyan-500', 'text-slate-950', 'shadow-[0_0_15px_rgba(34,211,238,0.4)]');
                    tab.classList.remove('bg-slate-900', 'text-slate-400');
                } else {
                    tab.classList.remove('bg-cyan-500', 'text-slate-950', 'shadow-[0_0_15px_rgba(34,211,238,0.4)]');
                    tab.classList.add('bg-slate-900', 'text-slate-400');
                }
            });

            document.querySelectorAll('.order-row').forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                if (status === 'all' || rowStatus === status || (status === 'selesai' && rowStatus === 'completed')) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function searchTable() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('.order-row').forEach(row => {
                const text = row.innerText.toLowerCase();
                if (text.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</x-app-layout>
