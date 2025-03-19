<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', 'sans-serif';
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gradient-to-b from-white to-blue-100 flex items-center justify-center min-h-screen">
    <div class="text-center">
        <h1 class="text-5xl font-bold text-gray-800">Selamat Datang!</h1>
        <p class="text-gray-600 font-semibold text-2xl">Klik untuk melanjutkan...</p>

        <div class="mt-6 flex flex-col md:flex-row justify-center gap-4">
            <a href="{{ url('/dashboard') }}"
                class="bg-yellow-400 text-blue-950 font-bold px-6 py-3 rounded-lg shadow-lg text-lg flex items-center gap-2 border-b-4 border-l-2 border-r-2 border-t-2 border-blue-950 hover:bg-yellow-500 transition">
                Login sebagai Admin
            </a>
            <a href="{{ url('/formpanels') }}"
                class="bg-slate-100 text-blue-950 font-bold px-6 py-3 rounded-lg shadow-lg text-lg flex items-center gap-2 border-b-4 border-l-2 border-r-2 border-t-2 border-blue-950 hover:bg-slate-300 transition">
                Masuk sebagai User
            </a>
        </div>
    </div>

</body>

</html>
