<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Irrigoo | Smart IoT Irrigation Ecosystem</title>
    <!-- Google Fonts via Bunny (privacy friendly) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800|outfit:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <!-- Tailwind CSS v3 + basic plugin-like utilities via CDN but we also extend with custom layer for advanced effects -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Override Tailwind theme to match high-end design (custom configuration via tailwind.config style) -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'heading': ['Outfit', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fade-up': 'fadeUp 0.9s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards',
                        'fade-down': 'fadeDown 0.7s ease-out forwards',
                        'pulse-slow': 'pulseSlow 8s ease-in-out infinite',
                        'pulse-slower': 'pulseSlower 12s ease-in-out infinite',
                        'float': 'floatAnim 6s ease-in-out infinite',
                        'glow': 'glowPulse 3s ease-in-out infinite',
                        'scale-subtle': 'scaleSubtle 0.5s ease-out forwards',
                        'shimmer': 'shimmer 2s infinite',
                        'tilt-3d': 'tilt3d 8s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeUp: {
                            '0%': { opacity: '0', transform: 'translateY(32px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        fadeDown: {
                            '0%': { opacity: '0', transform: 'translateY(-24px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        pulseSlow: {
                            '0%, 100%': { transform: 'scale(1)', opacity: '0.3' },
                            '50%': { transform: 'scale(1.2)', opacity: '0.5' },
                        },
                        pulseSlower: {
                            '0%, 100%': { transform: 'scale(1)', opacity: '0.2' },
                            '50%': { transform: 'scale(1.3)', opacity: '0.4' },
                        },
                        floatAnim: {
                            '0%, 100%': { transform: 'translateY(0px) rotate(0deg)' },
                            '50%': { transform: 'translateY(-15px) rotate(2deg)' },
                        },
                        glowPulse: {
                            '0%, 100%': { boxShadow: '0 0 8px rgba(52,211,153,0.4), 0 0 20px rgba(20,184,166,0.2)' },
                            '50%': { boxShadow: '0 0 25px rgba(52,211,153,0.7), 0 0 40px rgba(20,184,166,0.4)' },
                        },
                        scaleSubtle: {
                            '0%': { transform: 'scale(0.98)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' },
                        },
                        shimmer: {
                            '0%': { backgroundPosition: '-200% 0' },
                            '100%': { backgroundPosition: '200% 0' },
                        },
                        tilt3d: {
                            '0%, 100%': { transform: 'perspective(1200px) rotateX(2deg) rotateY(-2deg)' },
                            '50%': { transform: 'perspective(1200px) rotateX(-1deg) rotateY(3deg)' },
                        }
                    },
                    backgroundSize: {
                        '200%': '200%',
                    },
                    boxShadow: {
                        'inner-glow': 'inset 0 0 15px rgba(52,211,153,0.2)',
                        'neon': '0 0 20px rgba(52,211,153,0.5)',
                        'neon-teal': '0 0 25px rgba(45,212,191,0.4)',
                        'glass': '0 8px 32px rgba(0,0,0,0.2)',
                    },
                    backdropBlur: {
                        xl: '24px',
                    },
                }
            }
        }
    </script>
    <style>
        /* Additional micro fixes for Tailwind overrides and smooth scroll behavior */
        html { scroll-behavior: smooth; }
        body { background-color: #030712; }
        .bg-noise {
            background-image: radial-gradient(rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .text-balance { text-wrap: balance; }
        .perspective-1200 { perspective: 1200px; }
        .transform-3d { transform-style: preserve-3d; }
        .rotate-x-6 { transform: rotateX(6deg); }
        .group:hover .group-hover\:rotate-x-0 { transform: rotateX(0deg); }
        .card-3d {
            transition: transform 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1), box-shadow 0.3s;
        }
        .card-3d:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 40px -12px rgba(0,0,0,0.5), 0 0 0 1px rgba(52,211,153,0.3);
        }
        .glow-text {
            text-shadow: 0 0 12px rgba(52,211,153,0.5);
        }
        .hover-glow:hover {
            box-shadow: 0 0 28px rgba(52,211,153,0.6);
        }
        /* disable default focus ring but keep accessibility */
        :focus-visible { outline: 2px solid #2dd4bf; outline-offset: 2px; border-radius: 8px; }
    </style>
</head>
<body class="antialiased bg-gray-950 text-white overflow-x-hidden selection:bg-emerald-500/70 selection:text-white bg-noise">

    <!-- Ambient Animated Blobs (Tailwind only with keyframes) -->
    <div class="fixed inset-0 z-[-2] overflow-hidden pointer-events-none">
        <div class="absolute top-[-20%] left-[-15%] w-[70%] h-[70%] bg-emerald-600/20 rounded-full blur-[130px] animate-pulse-slow"></div>
        <div class="absolute bottom-[-15%] right-[-10%] w-[60%] h-[60%] bg-teal-600/20 rounded-full blur-[120px] animate-pulse-slower"></div>
        <div class="absolute top-[30%] right-[15%] w-[40%] h-[40%] bg-blue-600/15 rounded-full blur-[100px] animate-pulse-slow" style="animation-delay: -2s;"></div>
        <div class="absolute bottom-[20%] left-[10%] w-[45%] h-[45%] bg-emerald-500/10 rounded-full blur-[90px] animate-pulse-slower" style="animation-delay: -4s;"></div>
    </div>

    <!-- Navbar with glassmorphism -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-gray-900/50 backdrop-blur-xl border-b border-white/10 shadow-lg" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20 md:h-24">
                <!-- Logo + brand -->
                <div class="flex items-center gap-3 group cursor-pointer">
                    <div class="relative">
                        <div class="absolute -inset-1 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full blur-md opacity-70 group-hover:opacity-100 transition duration-500"></div>
                        <svg class="relative w-10 h-10 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                        </svg>
                    </div>
                    <span class="font-heading font-extrabold text-2xl tracking-tight bg-gradient-to-r from-emerald-200 via-teal-300 to-emerald-200 bg-clip-text text-transparent">Irrigoo</span>
                </div>

                <!-- Desktop Links -->
                <div class="hidden md:flex items-center space-x-9">
                    <a href="/" class="text-emerald-400 font-semibold border-b-2 border-emerald-400/50 pb-1 transition-all">Home</a>
                    <a href="/about" class="text-gray-300 hover:text-white font-medium transition-all duration-300 hover:scale-105">About</a>
                    <a href="/contact" class="text-gray-300 hover:text-white font-medium transition-all duration-300 hover:scale-105">Contact</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-gray-200 hover:text-white font-semibold transition px-3 py-2 rounded-full hover:bg-white/5">Log in</a>
                    <a href="{{ route('register') }}" class="relative overflow-hidden group bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-gray-900 font-bold px-6 py-2.5 rounded-full transition-all duration-300 transform hover:scale-105 shadow-[0_0_18px_rgba(52,211,153,0.5)]">
                        Get Started
                        <span class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative pt-36 pb-24 lg:pt-48 lg:pb-36 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-500/10 backdrop-blur-sm border border-emerald-500/30 text-emerald-300 font-semibold text-sm mb-8 animate-fade-down">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-80"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                Next-Gen Agriculture is Here
            </div>

            <!-- Headline -->
            <h1 class="font-heading text-5xl md:text-7xl lg:text-8xl font-black tracking-tight mb-8 leading-[1.15] animate-fade-up">
                Smart Irrigation.<br/>
                <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-sky-400 bg-clip-text text-transparent animate-pulse">Intelligent Yield.</span>
            </h1>
            
            <p class="max-w-2xl mx-auto text-lg md:text-xl text-gray-300 mb-12 animate-fade-up leading-relaxed [animation-delay:150ms] text-balance">
                Connect your farm, automate water management with precision IoT devices, and collaborate with expert service providers — all from a unified, breathtaking platform.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-5 animate-fade-up [animation-delay:300ms]">
                <a href="{{ route('register') }}" class="group relative w-full sm:w-auto px-8 py-4 text-lg font-bold text-gray-900 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full hover:shadow-neon transition-all duration-300 hover:-translate-y-1 flex items-center justify-center gap-2">
                    Join the Platform
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
                <a href="#features" class="w-full sm:w-auto px-8 py-4 text-lg font-semibold text-white bg-white/5 backdrop-blur-md border border-white/20 rounded-full hover:bg-white/10 hover:border-emerald-400/40 transition-all duration-300 hover:-translate-y-1">
                    Discover Features
                </a>
            </div>
            
            <!-- 3D Dashboard Preview with tilt effect & glassmorphism -->
            <div class="mt-24 relative mx-auto w-full max-w-5xl perspective-1200 animate-fade-up [animation-delay:500ms]">
                <div class="absolute -inset-3 bg-gradient-to-r from-emerald-500/30 to-teal-500/20 blur-3xl rounded-3xl"></div>
                <div class="relative group/card transform-gpu transition-all duration-700 hover:rotate-x-0 rotate-x-6 hover:scale-[1.02] origin-center">
                    <div class="bg-gray-900/70 backdrop-blur-2xl rounded-2xl border border-white/20 shadow-2xl overflow-hidden transition-all duration-500">
                        <!-- MacOS style top bar -->
                        <div class="h-9 bg-gray-800/80 border-b border-white/15 flex items-center px-5 gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-500/90 shadow-inner"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500/90"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500/90"></div>
                            <div class="ml-4 text-[11px] text-gray-400 font-mono">Irrigoo Cloud Dashboard</div>
                        </div>
                        <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2 space-y-5">
                                <div class="flex justify-between items-center">
                                    <div class="h-6 bg-white/10 rounded-lg w-28 animate-pulse"></div>
                                    <div class="h-6 bg-emerald-500/30 rounded-full w-20 backdrop-blur-sm"></div>
                                </div>
                                <!-- Chart mock -->
                                <div class="h-44 bg-gradient-to-br from-emerald-500/10 to-teal-500/5 border border-white/10 rounded-xl p-3 flex items-end gap-2">
                                    <div class="w-1/5 h-3/4 bg-emerald-400/40 rounded-t-md"></div>
                                    <div class="w-1/5 h-full bg-teal-400/60 rounded-t-md"></div>
                                    <div class="w-1/5 h-2/3 bg-emerald-400/30 rounded-t-md"></div>
                                    <div class="w-1/5 h-5/6 bg-teal-300/50 rounded-t-md"></div>
                                    <div class="w-1/5 h-2/5 bg-emerald-500/40 rounded-t-md"></div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="h-20 bg-white/5 rounded-xl border border-white/5 flex items-center justify-center backdrop-blur-sm">
                                        <div class="text-emerald-300 text-xs font-mono">Soil Moisture: 68%</div>
                                    </div>
                                    <div class="h-20 bg-white/5 rounded-xl border border-white/5 flex items-center justify-center backdrop-blur-sm">
                                        <div class="text-teal-300 text-xs font-mono">Flow Rate: 2.4 m³/h</div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-5">
                                <div class="h-28 bg-white/5 rounded-xl backdrop-blur-sm border border-white/10 p-3">
                                    <div class="text-xs text-gray-400">Active Devices</div>
                                    <div class="text-2xl font-bold text-emerald-300">12 IoT sensors</div>
                                </div>
                                <div class="h-36 bg-gradient-to-br from-blue-500/10 to-emerald-500/10 rounded-xl border border-white/10 p-3">
                                    <div class="text-xs text-gray-300">Next watering</div>
                                    <div class="text-xl font-semibold text-white">07:30 AM</div>
                                    <div class="w-full bg-white/10 h-1.5 rounded-full mt-2"><div class="w-3/4 bg-emerald-400 h-1.5 rounded-full"></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 text-xs text-gray-400 bg-black/30 px-4 py-1 rounded-full backdrop-blur-md">Live preview — real-time agri intelligence</div>
            </div>
        </div>
    </main>

    <!-- Features Section (Ecosystem Cards) -->
    <section id="features" class="py-28 relative border-t border-white/5 bg-gray-900/30 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 md:mb-24">
                <h2 class="font-heading text-4xl md:text-6xl font-extrabold bg-gradient-to-r from-white via-emerald-200 to-teal-300 bg-clip-text text-transparent mb-5">A Complete Ecosystem</h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto font-light">Unified platform for every stakeholder in the modern agricultural cycle.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-10">
                <!-- Farmer Card -->
                <div class="group card-3d bg-white/5 backdrop-blur-lg border border-white/10 rounded-3xl p-8 transition-all duration-500 hover:bg-white/10 hover:border-emerald-500/30 shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500/30 to-emerald-600/20 rounded-2xl flex items-center justify-center mb-7 text-emerald-400 group-hover:scale-110 transition-transform duration-300 shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold font-heading text-white mb-3">For Farmers</h3>
                    <p class="text-gray-400 leading-relaxed">Real-time water usage monitoring, remote IoT device control, and instant service requests tailored to your crop & soil conditions.</p>
                    <div class="mt-6 flex items-center text-emerald-400 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-all">Explore tools →</div>
                </div>

                <!-- Provider Card -->
                <div class="group card-3d bg-white/5 backdrop-blur-lg border border-white/10 rounded-3xl p-8 transition-all duration-500 hover:bg-white/10 hover:border-blue-500/30 shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500/30 to-sky-600/20 rounded-2xl flex items-center justify-center mb-7 text-blue-400 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold font-heading text-white mb-3">For Providers</h3>
                    <p class="text-gray-400 leading-relaxed">Offer specialized IoT irrigation services, manage incoming maintenance requests, and expand your agribusiness footprint.</p>
                    <div class="mt-6 flex items-center text-blue-400 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-all">Join network →</div>
                </div>

                <!-- Manufacturer Card -->
                <div class="group card-3d bg-white/5 backdrop-blur-lg border border-white/10 rounded-3xl p-8 transition-all duration-500 hover:bg-white/10 hover:border-purple-500/30 shadow-lg">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500/30 to-fuchsia-600/20 rounded-2xl flex items-center justify-center mb-7 text-purple-400 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold font-heading text-white mb-3">For Manufacturers</h3>
                    <p class="text-gray-400 leading-relaxed">Register cutting-edge IoT devices, track deployment analytics, and power the smart farming revolution with your hardware.</p>
                    <div class="mt-6 flex items-center text-purple-400 text-sm font-semibold opacity-0 group-hover:opacity-100 transition-all">Integrate now →</div>
                </div>
            </div>

            <!-- Additional feature stats row (minimal but enhances trust) -->
            <div class="mt-28 flex flex-wrap justify-center gap-8 md:gap-16 border-t border-white/10 pt-12">
                <div class="text-center"><div class="text-3xl font-black text-emerald-400">10K+</div><div class="text-gray-400 text-sm">Connected Hectares</div></div>
                <div class="text-center"><div class="text-3xl font-black text-teal-400">98%</div><div class="text-gray-400 text-sm">Water Efficiency</div></div>
                <div class="text-center"><div class="text-3xl font-black text-sky-400">24/7</div><div class="text-gray-400 text-sm">IoT Monitoring</div></div>
                <div class="text-center"><div class="text-3xl font-black text-emerald-300">150+</div><div class="text-gray-400 text-sm">Service Providers</div></div>
            </div>
        </div>
    </section>

    <!-- Footer section with simple gradient and links -->
    <footer class="border-t border-white/10 py-12 bg-black/40 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-6 text-center text-gray-400 text-sm">
            <div class="flex justify-center gap-8 mb-6">
                <a href="#" class="hover:text-emerald-400 transition">Privacy</a>
                <a href="#" class="hover:text-emerald-400 transition">Terms</a>
                <a href="#" class="hover:text-emerald-400 transition">Support</a>
            </div>
            <div class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5 text-emerald-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                <span>© 2025 Irrigoo — Cultivating the future with intelligent irrigation.</span>
            </div>
        </div>
    </footer>

    <!-- small script to handle navbar blur on scroll optional, no extra styling needed -->
    <script>
        (function() {
            const navbar = document.getElementById('navbar');
            if(navbar) {
                window.addEventListener('scroll', () => {
                    if(window.scrollY > 20) {
                        navbar.classList.add('bg-gray-900/80', 'backdrop-blur-xl', 'shadow-xl');
                        navbar.classList.remove('bg-gray-900/50');
                    } else {
                        navbar.classList.add('bg-gray-900/50');
                        navbar.classList.remove('bg-gray-900/80');
                    }
                });
            }
        })();
    </script>
</body>
</html>