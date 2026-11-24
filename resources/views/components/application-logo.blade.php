<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-3 group']) }}>
    <!-- Cyber Holographic Icon -->
    <div class="relative flex items-center justify-center">
        <div class="absolute -inset-1 bg-gradient-to-r from-cyan-500 to-indigo-600 rounded-2xl blur-md opacity-75 group-hover:opacity-100 transition duration-500 group-hover:scale-110"></div>
        <div class="relative w-11 h-11 rounded-2xl bg-slate-950 border border-cyan-400/50 flex items-center justify-center text-cyan-400 shadow-inner">
            <svg class="w-6 h-6 animate-[spin_12s_linear_infinite]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <circle cx="12" cy="12" r="9" stroke-width="1.5" stroke-dasharray="4 2" class="opacity-70"></circle>
                <circle cx="12" cy="12" r="5" stroke-width="2" class="stroke-cyan-400"></circle>
                <path d="M12 2v3M12 19v3M2 12h3M19 12h3" stroke-width="2" stroke-linecap="round"></path>
            </svg>
            <div class="absolute w-2 h-2 rounded-full bg-cyan-400 shadow-[0_0_8px_#22d3ee]"></div>
        </div>
    </div>

    <!-- Futuristic Typography -->
    <div class="flex flex-col text-left">
        <div class="flex items-center gap-2">
            <span class="font-black text-xl tracking-wider text-white uppercase font-mono">CLEAN<span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-sky-300 to-indigo-400">WASH</span></span>
            <span class="px-1.5 py-0.5 text-[9px] font-mono font-bold tracking-widest bg-cyan-500/10 text-cyan-400 border border-cyan-500/30 rounded">QUANTUM</span>
        </div>
        <span class="text-[9px] font-mono tracking-widest text-slate-400 uppercase">AERO-NANO WASH SYSTEM // 2088</span>
    </div>
</div>
