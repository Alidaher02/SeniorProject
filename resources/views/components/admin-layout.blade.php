<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashborad</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="">



<div id="pageLoader"
    class="fixed inset-0 z-50 flex items-center justify-center bg-white/70 backdrop-blur-sm transition-opacity duration-1000">

    <div class="h-10 w-10 animate-spin rounded-full border-4 border-blue-200 border-t-blue-600"></div>

</div>


<div id="pageContent" class="opacity-0 transition-opacity duration-500">
@include('components.sidebar')
<main class="ml-64 min-h-screen bg-slate-50 p-5">

{{ $slot }}
    

</main>

</div>


</body>
</html>