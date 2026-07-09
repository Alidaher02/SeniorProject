

@props([
    'title' => 'Cold Chain'
])


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="">

    <x-nav />

    <main class="max-w-7xl mx-auto px-6 py-8">
        {{ $slot }}
    </main>

@session('success')

     <div 
     x-data="{show: true}"
     x-init="setTimeout(() => show= false, 3000)"
     x-show="show"
     x-transition.opacity.duration.1000ms
     class="bg-primary px-4 py-3 absolute bottom-4 right-4 rounded-lg text-xs">{{ $value }} </div>

@endsession
</body>
</html>