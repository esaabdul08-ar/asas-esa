<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CLEANWASH') }} // AUTHENTICATION TERMINAL</title>

        <!-- Google Fonts: Space Grotesk, Outfit, JetBrains Mono -->
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
            body {
                background-color: #040711;
                background-image: 
                    linear-gradient(rgba(34, 211, 238, 0.03) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(34, 211, 238, 0.03) 1px, transparent 1px),
                    radial-gradient(circle at 50% 50%, rgba(6, 182, 212, 0.12) 0%, #03050c 100%);
                background-size: 32px 32px, 32px 32px, auto;
            }
            .cyber-glass {
                background: rgba(10, 15, 36, 0.85);
                backdrop-filter: blur(24px);
                border: 1px solid rgba(56, 189, 248, 0.3);
                box-shadow: 0 0 50px rgba(6, 182, 212, 0.15);
            }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-200 antialiased min-h-screen flex items-center justify-center p-4 selection:bg-cyan-500 selection:text-black">
        <div class="w-full max-w-md">
            <!-- Top Branding -->
            <div class="text-center mb-8">
                <a href="/" class="inline-block hover:scale-105 transition duration-300">
                    <x-application-logo class="w-auto h-12 justify-center" />
                </a>
                <div class="inline-flex items-center gap-2 mt-4 px-3 py-1 rounded-full bg-cyan-950/70 border border-cyan-500/30 text-cyan-400 font-mono text-[10px] uppercase tracking-widest">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-ping"></span>
                    <span>SECURE ACCESS PORTAL</span>
                </div>
            </div>

            <!-- Card Box -->
            <div class="cyber-glass rounded-3xl p-8 border border-cyan-500/30 shadow-[0_0_50px_rgba(6,182,212,0.2)]">
                {{ $slot }}
            </div>

            <p class="text-center font-mono text-[11px] text-slate-500 mt-6 uppercase tracking-wider">
                © {{ date('Y') }} CLEANWASH QUANTUM • SECURE ENCRYPTED SESSION
            </p>
        </div>
    </body>
</html>
