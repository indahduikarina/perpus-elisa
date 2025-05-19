<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Perpustakaan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --pink-light: #ffe4ec;
      --pink-medium: #ff85a2;
      --pink-dark: #e5517a;
    }
  </style>
</head>
<body class="bg-[var(--pink-light)] flex items-center justify-center min-h-screen">
  <div class="bg-white rounded-2xl shadow-lg max-w-4xl w-full m-4 overflow-hidden md:flex">
    <!-- Gambar -->
    <div class="w-full md:w-1/2 h-48 md:h-auto bg-cover bg-center"
         style="background-image: url('https://i.pinimg.com/736x/b1/26/95/b1269520afa5d4715d821f8b850ad9c3.jpg');">
    </div>

    <!-- Form Register -->
    <div class="w-full md:w-1/2 p-8">
      <h2 class="text-3xl font-bold text-[var(--pink-dark)] text-center mb-4">Daftar Akun</h2>
      <p class="text-center text-[var(--pink-medium)] mb-6">Isi formulir untuk mendaftar dan bergabung dengan perpustakaan.</p>

      <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Nama -->
        <div>
          <label for="name" class="block text-[var(--pink-dark)] mb-1">Nama Lengkap</label>
          <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[var(--pink-medium)]" />
          @error('name')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-[var(--pink-dark)] mb-1">Email</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[var(--pink-medium)]" />
          @error('email')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-[var(--pink-dark)] mb-1">Password</label>
          <input id="password" type="password" name="password" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[var(--pink-medium)]" />
          @error('password')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div>
          <label for="password_confirmation" class="block text-[var(--pink-dark)] mb-1">Konfirmasi Password</label>
          <input id="password_confirmation" type="password" name="password_confirmation" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[var(--pink-medium)]" />
          @error('password_confirmation')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Button + Link -->
        <div class="flex justify-between items-center mt-4">
          <a href="{{ route('login') }}" class="text-sm text-[var(--pink-medium)] hover:underline">Sudah punya akun?</a>
          <button type="submit" class="bg-[var(--pink-medium)] text-white px-4 py-2 rounded-lg hover:bg-[var(--pink-dark)] transition">Daftar</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
