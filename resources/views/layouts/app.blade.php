<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CLEANWASH') }} // COMMAND CENTER</title>

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
                    linear-gradient(rgba(34, 211, 238, 0.02) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(34, 211, 238, 0.02) 1px, transparent 1px),
                    radial-gradient(circle at 10% 10%, rgba(6, 182, 212, 0.08) 0%, transparent 40%),
                    radial-gradient(circle at 90% 80%, rgba(139, 92, 246, 0.08) 0%, transparent 40%);
                background-size: 32px 32px, 32px 32px, auto, auto;
                background-attachment: fixed;
            }
            .cyber-glass {
                background: rgba(10, 15, 36, 0.75);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(56, 189, 248, 0.18);
                box-shadow: 0 0 30px rgba(6, 182, 212, 0.05);
            }
            .neon-text-glow {
                text-shadow: 0 0 12px rgba(34, 211, 238, 0.6);
            }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-200 antialiased min-h-screen flex flex-col selection:bg-cyan-500 selection:text-black">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-slate-950/70 border-b border-cyan-500/20 backdrop-blur-md">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 py-8">
                {{ $slot }}
            </main>

            <!-- Cyber Footer -->
            <footer class="bg-slate-950/80 border-t border-cyan-500/20 py-6 text-center text-xs font-mono text-slate-500">
                <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <span class="text-cyan-400 font-bold">CLEANWASH // QUANTUM CONTROL CORE</span>
                        <span>• OPERATING AT OPTIMAL TELEMETRY</span>
                    </div>
                    <p>© {{ date('Y') }} REKAYASA PERANGKAT LUNAK (RPL) 2026. ENCRYPTED.</p>
                </div>
            </footer>
        </div>
    </body>
</html>
