<!DOCTYPE html>
<html lang="en"  class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://almaata.ac.id/wp-content/uploads/2017/05/logo-alma-ata.jpg">
    <title>Welcome</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite('resources/css/app.css')
</head>
<body class="bg-[#0a1c29] flex items-center justify-center min-h-screen">
    <div class=" bg-white rounded-lg shadow-md p-10 w-[500px]">
        <img src="{{ asset('img/images.png') }}" alt="" class="mx-auto mb-3">
        <div class=" text-center text-[#499cbf] mb-8">
            <h1 class="text-4xl font-bold text-[#499cbf] mb-8">SELAMAT DATANG!</h1>
            <p class="text-xl text-[#499cbf] mb-8 mt-10">INGIN REKOMENDASI KRS?</p>
            <a href="/login" class="mt-5 px-10 my-2 py-2 bg-[#499cbf] text-white rounded font-bold">LOGIN</a>
    </div>
    </div>
</body>
