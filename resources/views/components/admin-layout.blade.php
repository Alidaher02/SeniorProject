<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashborad</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="">

@include('components.sidebar')


<main class="ml-64 min-h-screen bg-slate-50 p-5">

{{ $slot }}
    

</main>
</body>
</html>