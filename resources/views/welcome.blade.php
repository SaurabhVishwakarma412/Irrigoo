<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Irrigoo - Smart IoT Irrigation</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|outfit:400,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="antialiased bg-gray-900 text-white overflow-x-hidden selection:bg-emerald-500 selection:text-white">

    <!-- Ambient Background -->
    <div class="fixed inset-0 z-[-1] bg-gray-900">
        <div class="absolute top-[-20%] left-[-10%] w-[50%] h-[50%] bg-emerald-600/30 blur-[150px] rounded-full animate-pulse" style="animation-duration: 8s;"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-teal-600/20 blur-[120px] rounded-full animate-pulse" style="animation-duration: 12s;"></div>
        <div class="absolute top-[40%] right-[20%] w-[30%] h-[30%] bg-blue-600/20 blur-[100px] rounded-full animate-pulse" style="animation-duration: 10s;"></div>
    </div>

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-gray-900/60 backdrop-blur-lg border-b border-white/10" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center gap-3">
                    <div class="relative">
                        <div class="absolute -inset-1 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full blur opacity-75"></div>
                        <svg class="relative w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                        </svg>
                    </div>
                    <span class="font-heading font-bold text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 to-teal-200">Irrigoo</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-emerald-400 font-medium transition-colors">Home</a>
                    <a href="/about" class="text-gray-300 hover:text-white transition-colors">About</a>
                    <a href="/contact" class="text-gray-300 hover:text-white transition-colors">Contact</a>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-medium text-white bg-white/10 hover:bg-white/20 px-5 py-2.5 rounded-full transition-all duration-300 backdrop-blur-md border border-white/10 shadow-[0_0_15px_rgba(255,255,255,0.1)]">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white font-medium transition-colors">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="font-medium text-gray-900 bg-gradient-to-r from-emerald-400 to-teal-400 hover:from-emerald-300 hover:to-teal-300 px-6 py-2.5 rounded-full transition-all duration-300 transform hover:scale-105 shadow-[0_0_20px_rgba(52,211,153,0.4)]">Get Started</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-medium text-sm mb-8 animate-[fade-in-down_1s_ease-out]">
                <span class="flex h-2 w-2 relative">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                Next-Gen Agriculture is Here
            </div>

            <h1 class="font-heading text-5xl md:text-7xl lg:text-8xl font-bold tracking-tight mb-8 leading-tight animate-[fade-in-up_1s_ease-out]">
                Smart Irrigation.<br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-blue-400">Intelligent Yield.</span>
            </h1>
            
            <p class="max-w-2xl mx-auto text-xl text-gray-300 mb-12 animate-[fade-in-up_1.2s_ease-out]">
                Connect your farm, manage water usage automatically with IoT devices, and collaborate with top-tier service providers—all from a single, stunning platform.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-[fade-in-up_1.4s_ease-out]">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 text-lg font-semibold text-gray-900 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full hover:from-emerald-300 hover:to-teal-300 transform hover:-translate-y-1 hover:shadow-[0_10px_30px_rgba(52,211,153,0.4)] transition-all duration-300">
                    Join the Platform
                </a>
                <a href="#features" class="w-full sm:w-auto px-8 py-4 text-lg font-semibold text-white bg-white/5 border border-white/10 rounded-full hover:bg-white/10 transform hover:-translate-y-1 transition-all duration-300 backdrop-blur-sm">
                    Discover Features
                </a>
            </div>
            
            <!-- Dashboard Preview Graphic -->
            <div class="mt-20 relative mx-auto w-full max-w-5xl perspective-1000 animate-[fade-in-up_1.6s_ease-out]">
                <div class="absolute -inset-1 bg-gradient-to-b from-emerald-500 to-transparent opacity-20 blur-2xl"></div>
                <div class="relative bg-gray-900/80 backdrop-blur-xl rounded-2xl border border-white/10 shadow-2xl overflow-hidden transform rotate-x-12 scale-95 transition-transform duration-700 hover:rotate-x-0 hover:scale-100">
                    <div class="h-8 bg-gray-800/80 border-b border-white/10 flex items-center px-4 gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
                    </div>
                    <div class="p-6 grid grid-cols-3 gap-6 opacity-80">
                        <div class="col-span-2 space-y-4">
                            <div class="h-8 bg-white/5 rounded-lg w-1/3"></div>
                            <div class="h-48 bg-gradient-to-tr from-emerald-500/20 to-teal-500/5 border border-white/5 rounded-xl"></div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="h-24 bg-white/5 rounded-xl"></div>
                                <div class="h-24 bg-white/5 rounded-xl"></div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="h-32 bg-white/5 rounded-xl"></div>
                            <div class="h-48 bg-white/5 rounded-xl"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-gray-900/50 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="font-heading text-3xl md:text-5xl font-bold mb-6">A Complete Ecosystem</h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">Designed for every participant in the modern agricultural cycle.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="group bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-8 hover:bg-white/10 transition-all duration-500 hover:-translate-y-2">
                    <div class="w-14 h-14 bg-emerald-500/20 rounded-2xl flex items-center justify-center mb-6 text-emerald-400 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 font-heading text-white">For Farmers</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Track precise water usage, toggle IoT devices remotely, and request local maintenance services tailored to your crop type.
                    </p>
                </div>
                <!-- Card 2 -->
                <div class="group bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-8 hover:bg-white/10 transition-all duration-500 hover:-translate-y-2">
                    <div class="w-14 h-14 bg-blue-500/20 rounded-2xl flex items-center justify-center mb-6 text-blue-400 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 font-heading text-white">For Providers</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Offer specialized IoT-based irrigation services, manage incoming requests, and grow your local agricultural service business.
                    </p>
                </div>
                <!-- Card 3 -->
                <div class="group bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-8 hover:bg-white/10 transition-all duration-500 hover:-translate-y-2">
                    <div class="w-14 h-14 bg-purple-500/20 rounded-2xl flex items-center justify-center mb-6 text-purple-400 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 font-heading text-white">For Manufacturers</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Register cutting-edge IoT devices on the platform, track their deployment, and supply the backbone of smart farming.
                    </p>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
