

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
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
  body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
</style>
  <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="">
<x-nav />
    
<div id="pageLoader"
    class="fixed inset-0 z-50 flex items-center justify-center bg-white/70 backdrop-blur-sm transition-opacity duration-1000">

    <div class="h-10 w-10 animate-spin rounded-full border-4 border-blue-200 border-t-blue-600"></div>

</div>


<div id="pageContent" class="opacity-0 transition-opacity duration-500">
 <div class="max-w-7xl mx-auto px-6 py-8">
        {{ $slot }}
  </div>
</div>
   

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

<!-- component -->
<!-- Floating Button -->
@auth
    @if (Auth::user()->role === 'customer')
<button
    id="chatBtn"
    class="fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center
    rounded-full bg-blue-600 text-white shadow-xl shadow-blue-200  cursor-pointer
    transition hover:bg-blue-700">

    <i class="fa-solid fa-message text-xl"></i>

</button>


<div
    id="chatModel"
    class="hidden fixed bottom-24 right-6 z-40 h-[520px] w-[360px]
    rounded-3xl border border-blue-100 bg-white p-5 shadow-2xl">


    <!-- Header -->

    <div class="flex flex-col border-b border-blue-100 pb-4">

        <div class="flex items-center justify-between gap-3">



            <div>

                <h2 class="text-sm font-semibold text-slate-800">
                    ShipTrack AI
                </h2>

                <p class="text-xs text-slate-500">
                    Your shipment assistant
                </p>

            </div>

            <div id="chatClose" class="text-blue-600 text-2xl cursor-pointer">x</div>

        </div>

    </div>



    <!-- Chat Container -->

    <!-- Messages -->
<div id="messages" class="h-[380px] overflow-y-auto py-4">

</div>


<!-- Input -->
<div class="border-t border-blue-100 pt-4">

    <div class="flex gap-2">

        <input
            id="message"
            class="h-10 flex-1 rounded-xl border border-blue-100
            bg-blue-50 px-3 text-sm outline-none
            focus:border-blue-400"
            placeholder="Type your message">


        <button
            id="sendM"
            type="submit"
            class="flex h-10 w-10 items-center justify-center
            rounded-xl bg-blue-600 text-white cursor-pointer
            transition hover:bg-blue-700">

            <i class="fa-solid fa-paper-plane text-sm"></i>

        </button>

    </div>

</div>


</div>
    
<!-- Chat Window -->
@endif
@endauth






</body>
</html>