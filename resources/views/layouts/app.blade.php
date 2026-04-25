<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard - STT DSM' }}</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans antialiased">
    
    <x-sidebar />

    <div class="pl-64 min-h-screen flex flex-col">
        
        <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-8">
            <h2 class="text-xl font-bold text-gray-800">Dashboard</h2>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500">Halo, Admin</span>
                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-700 font-bold border border-emerald-200">
                    A
                </div>
            </div>
        </header>

        <main class="p-8">
            {{ $slot }}
        </main>
    </div>

</body>
</html>