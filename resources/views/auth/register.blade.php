<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PCM Lab | Daftar Akun</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        .glass {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .bg-pattern {
            background-color: #020617;
            background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.05) 1px, transparent 0);
            background-size: 40px 40px;
        }
    </style>
</head>
<body class="bg-pattern h-full flex items-center justify-center p-6 text-slate-300 antialiased font-sans">

    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="flex flex-col items-center mb-8">
            <a href="/" class="flex items-center gap-3 mb-4 group">
                <div class="w-12 h-12 bg-gradient-to-tr from-cyan-500 to-violet-500 rounded-2xl flex items-center justify-center font-bold text-white text-xl shadow-2xl group-hover:scale-110 transition-transform">N</div>
                <span class="text-3xl font-extrabold text-white tracking-tighter italic">PCM <span class="text-cyan-500">Lab</span></span>
            </a>
            <p class="text-slate-500 font-medium text-center px-8">Bergabunglah dengan ekosistem digital laboratorium modern</p>
        </div>

        <!-- Register Card -->
        <div class="glass p-10 rounded-[3rem] shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-violet-500 via-cyan-500 to-violet-500"></div>
            
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div class="space-y-2">
                    <label for="name" class="text-xs font-bold text-slate-500 uppercase tracking-widest ml-4">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-violet-500/50 transition-all"
                        placeholder="Nama Lengkap Anda">
                    @if($errors->has('name'))
                        <p class="text-xs text-rose-500 mt-1 ml-4">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="text-xs font-bold text-slate-500 uppercase tracking-widest ml-4">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-violet-500/50 transition-all"
                        placeholder="nama@gmail.com">
                    @if($errors->has('email'))
                        <p class="text-xs text-rose-500 mt-1 ml-4">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="text-xs font-bold text-slate-500 uppercase tracking-widest ml-4">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-violet-500/50 transition-all"
                        placeholder="••••••••">
                    @if($errors->has('password'))
                        <p class="text-xs text-rose-500 mt-1 ml-4">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="text-xs font-bold text-slate-500 uppercase tracking-widest ml-4">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white focus:outline-none focus:ring-2 focus:ring-violet-500/50 transition-all"
                        placeholder="••••••••">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-4 mt-4 bg-white text-slate-900 font-extrabold rounded-2xl hover:bg-violet-500 hover:text-white transition-all shadow-xl hover:shadow-violet-500/20 active:scale-95">
                    DAFTAR SEKARANG
                </button>
            </form>

            <div class="mt-10 pt-8 border-t border-white/5 text-center">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-widest">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-cyan-500 hover:text-cyan-400 transition-colors ml-2">Log in</a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center text-[10px] text-slate-600 font-bold uppercase tracking-[0.3em]">
            &copy; {{ date('Y') }} PCM Lab Management System
        </div>
    </div>

</body>
</html>
