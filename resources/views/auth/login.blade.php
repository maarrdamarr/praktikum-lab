<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | PCM Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white text-slate-900 antialiased">
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md relative">
            <div class="mb-12">
                <a href="/" class="flex items-center gap-4 mb-8">
                    <div class="w-10 h-10 overflow-hidden rounded-lg shadow-sm">
                        <img src="{{ asset('assets/logo/eucase-logo.png') }}" alt="EUCASE" class="w-full h-full object-cover">
                    </div>
                    <span class="text-xl font-black tracking-tighter text-blue-600">PCM Lab</span>
                </a>
                <h1 class="text-4xl font-black tracking-tighter text-slate-900 mb-2">Selamat Datang</h1>
                <p class="text-slate-500 font-medium">Silakan masuk untuk melanjutkan ke dashboard.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email Institusi</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                        class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm font-medium outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all"
                        placeholder="nama@institusi.ac.id">
                    @error('email') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center px-1">
                        <label for="password" class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-blue-600 uppercase tracking-widest hover:underline">Lupa Sandi?</a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password" 
                        class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm font-medium outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all"
                        placeholder="••••••••">
                    @error('password') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center px-1">
                    <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-200 rounded focus:ring-blue-500">
                    <label for="remember_me" class="ml-3 text-xs font-bold text-slate-500 uppercase tracking-widest">Ingat Saya</label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-5 bg-blue-600 text-white font-black rounded-2xl shadow-xl shadow-blue-600/20 hover:bg-blue-700 transition-all uppercase tracking-widest text-sm">
                        Masuk ke Sistem
                    </button>
                </div>

                <p class="text-center text-xs font-bold text-slate-400 uppercase tracking-widest pt-8">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar Sekarang</a>
                </p>
            </form>

            <footer class="mt-10 text-center text-[10px] font-bold text-slate-300 uppercase tracking-widest">
                &copy; 2026 PCM Lab Ecosystem.
            </footer>
        </div>
    </div>
</body>
</html>
