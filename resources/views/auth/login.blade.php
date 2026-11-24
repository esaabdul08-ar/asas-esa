<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 font-mono text-xs text-cyan-300" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5 font-mono">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs uppercase tracking-widest text-cyan-300 font-bold mb-1.5">
                [USER_ID] ALAMAT EMAIL
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-cyan-400">
                    <i class="fa-solid fa-envelope text-xs"></i>
                </span>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       placeholder="admin@gmail.com"
                       class="w-full pl-10 pr-4 py-3 bg-slate-900/90 border border-cyan-500/30 rounded-xl text-xs font-mono text-white placeholder-slate-600 focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 outline-none transition shadow-inner">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-rose-400 font-mono" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs uppercase tracking-widest text-cyan-300 font-bold mb-1.5">
                [CIPHER_KEY] KATA SANDI
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-cyan-400">
                    <i class="fa-solid fa-key text-xs"></i>
                </span>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       placeholder="••••••••"
                       class="w-full pl-10 pr-4 py-3 bg-slate-900/90 border border-cyan-500/30 rounded-xl text-xs font-mono text-white placeholder-slate-600 focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 outline-none transition shadow-inner">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-rose-400 font-mono" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between text-xs text-slate-400">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember" 
                       class="rounded border-cyan-500/30 bg-slate-900 text-cyan-500 focus:ring-cyan-400 focus:ring-offset-slate-950">
                <span class="ms-2 font-mono text-[11px]">REMEMBER SESSION</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-[11px] text-cyan-400/80 hover:text-cyan-300 font-mono transition" href="{{ route('password.request') }}">
                    RESET CIPHER?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" 
                    class="w-full py-3.5 rounded-xl bg-gradient-to-r from-cyan-400 via-sky-400 to-indigo-500 hover:from-cyan-300 hover:to-indigo-400 text-slate-950 font-mono font-black text-xs tracking-wider shadow-[0_0_25px_rgba(34,211,238,0.4)] active:scale-95 transition uppercase flex items-center justify-center gap-2">
                <i class="fa-solid fa-lock-open text-xs"></i>
                <span>AUTHENTICATE & ENTER</span>
            </button>
        </div>

        <!-- Quick Credentials Hint for Examiner Sesuai Soal Ujian (PDF) -->
        <div class="mt-6 pt-4 border-t border-cyan-500/20 text-[11px] font-mono text-slate-400 bg-cyan-950/20 p-3 rounded-xl border border-cyan-500/10">
            <span class="text-cyan-400 font-bold block mb-1">AKUN PENGUJIAN UJIAN (ROLE MULTI-USER):</span>
            <div class="flex justify-between text-slate-300">
                <span>1. Role Admin:</span>
                <span class="font-bold text-white">admin@gmail.com / password</span>
            </div>
            <div class="flex justify-between text-slate-300 mt-1">
                <span>2. Role Kasir:</span>
                <span class="font-bold text-white">kasir@gmail.com / password</span>
            </div>
            <div class="flex justify-between text-slate-400 mt-1">
                <span>3. Pelanggan:</span>
                <span>user@gmail.com / password</span>
            </div>
        </div>
    </form>
</x-guest-layout>
