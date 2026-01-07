<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Lucky DevLog' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-4">
            <a href="{{ route('activities.index') }}" class="text-xl font-bold text-gray-800">
                Lucky DevLog
            </a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 py-8">
        {{ $slot }}
    </main>
</body>
</html>
