<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Perpustakaan - Selamat Datang</title>
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

    <!-- Konten -->
    <div class="w-full md:w-1/2 p-8 flex flex-col items-center justify-center">
      <h2 class="text-3xl font-semibold text-[var(--pink-dark)] mb-2">Selamat Datang</h2>
      <p class="text-[var(--pink-medium)] mb-6 text-center">Silakan pilih salah satu untuk masuk atau mendaftar</p>

      <div class="space-y-4 w-full">
        <a href="{{ route('login') }}" class="block w-full text-center bg-[var(--pink-medium)] text-white py-2 rounded-lg hover:bg-[var(--pink-dark)] transition">
          Login
        </a>
        <a href="{{ route('register') }}" class="block w-full text-center border border-[var(--pink-medium)] text-[var(--pink-dark)] py-2 rounded-lg hover:bg-[var(--pink-light)] transition">
          Register
        </a>
      </div>
    </div>
  </div>
</body>
</html>
