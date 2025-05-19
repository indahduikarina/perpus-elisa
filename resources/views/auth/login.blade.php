<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Perpustakaan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --pink-light: #ffe4ec;
      --pink-medium: #ff85a2;
      --pink-dark: #e5517a;
    }
  </style>
</head>
<body class="bg-[var(--pink-light)] flex items-center justify-center min-h-screen px-4">
  <div class="bg-white rounded-2xl shadow-lg max-w-4xl w-full overflow-hidden flex flex-col md:flex-row md:min-h-[500px]">
    
    <!-- Gambar -->
    <div class="w-full md:w-1/2 h-48 md:h-auto bg-cover bg-center"
         style="background-image: url('https://i.pinimg.com/736x/b1/26/95/b1269520afa5d4715d821f8b850ad9c3.jpg');">
    </div>

    <!-- Form Login -->
    <div class="w-full md:w-1/2 p-6 sm:p-8 flex flex-col justify-center">
      <h2 class="text-3xl font-bold text-[var(--pink-dark)] text-center mb-4 sm:mb-6">Login Perpustakaan</h2>
      <p class="text-center text-[var(--pink-medium)] mb-6 sm:mb-8 px-2 sm:px-0">Selamat datang kembali! Silakan login untuk melanjutkan.</p>

      @if (session('status'))
        <div class="mb-4 text-green-600 font-medium text-center">
            {{ session('status') }}
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}" class="space-y-4 px-2 sm:px-0">
        @csrf

        <!-- Email -->
        <div>
          <label for="email" class="block text-[var(--pink-dark)] mb-1 text-sm sm:text-base">Email</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[var(--pink-medium)] text-sm sm:text-base" />
          @error('email')
            <p class="text-xs sm:text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-[var(--pink-dark)] mb-1 text-sm sm:text-base">Password</label>
          <input id="password" type="password" name="password" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[var(--pink-medium)] text-sm sm:text-base" />
          @error('password')
            <p class="text-xs sm:text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center text-sm sm:text-base">
          <input id="remember_me" type="checkbox" name="remember" class="text-[var(--pink-dark)] mr-2" />
          <label for="remember_me" class="text-[var(--pink-dark)]">Ingat Saya</label>
        </div>

        <!-- Button + Forgot Password -->
        <div class="flex flex-col sm:flex-row justify-between items-center mt-4 gap-2 sm:gap-0">
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-sm text-[var(--pink-medium)] hover:underline whitespace-nowrap">Lupa Password?</a>
          @endif
          <button type="submit" class="bg-[var(--pink-medium)] text-white px-6 py-2 rounded-lg hover:bg-[var(--pink-dark)] transition w-full sm:w-auto">Login</button>
        </div>
      </form>

      <div class="text-center mt-6 text-sm text-[var(--pink-dark)] px-2 sm:px-0">
        Belum punya akun? <a href="{{ route('register') }}" class="underline hover:text-[var(--pink-medium)]">Daftar di sini</a>
      </div>
    </div>
  </div>
</body>
</html>
