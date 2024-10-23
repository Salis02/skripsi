<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-r bg-[#1B75BB] flex items-center justify-center min-h-screen">
    <div class=" bg-white rounded-lg shadow-md p-10 w-[500px]">
        <img src="{{ asset('img/images.png') }}" alt="" class="mx-auto mb-3">
        <h1 class="text-3xl font-bold text-center text-[#499cbf] mb-8">LOGIN</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-[#499cbf] mb-2">Email</label>
                    <input class="w-full p-3 rounded-md bg-[#e1f2f7] border border-[#e1f2f7] focus:outline-none focus:ring-2 focus:ring-[#499cbf]" type="email" name="email" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="block text-[#499cbf] mb-2">Password</label>
                    <input class="w-full p-3 rounded-md bg-[#e1f2f7] border border-[#e1f2f7] focus:outline-none focus:ring-2 focus:ring-[#499cbf]" type="password" name="password" required>
                </div>
                <button type="submit" class="w-full py-3 bg-[#499cbf] text-white rounded-md text-center">Login</button>
            </form>
            <p class="text-center text-[#499cbf] mt-6">2024, Universitas Alma Ata</p>
    </div>
</body>
</html>
