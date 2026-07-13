

@props([
    'title' => 'Cold Chain'
])


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
<style>
  body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
</style>
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
     role="alert" class="alert alert-success text-white border-0 bg-green-600 px-4 py-3 absolute bottom-4 right-4 rounded-lg text-xs"
     x-data="{show: true}"
     x-init="setTimeout(() => show= false, 3000)"
     x-show="show"
     x-transition.opacity.duration.1000ms
     >
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span>{{ $value }}</span>
</div>

@endsession
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</body>
</html>