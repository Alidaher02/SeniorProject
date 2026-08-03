<x-layout title='Login'>

<div class="flex h-[700px] w-full">


    <div class="w-full flex flex-col items-center justify-center">

        <form class="md:w-96 w-80 flex flex-col items-center justify-center" action="/login" method="POST">
            @csrf
            <h2 class="text-4xl text-gray-900 font-medium">Sign In</h2>

            <div class="flex items-center gap-4 w-full my-5">
                <div class="w-full h-px bg-gray-300/90"></div>
                <p class="w-full text-nowrap text-sm text-gray-500/90">Please sign in to continue</p>
                <div class="w-full h-px bg-gray-300/90"></div>
            </div>

            

            <div class="flex items-center w-full bg-transparent border border-gray-300/60 h-12 rounded-full overflow-hidden pl-6 gap-2">
                <svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 .55.571 0H15.43l.57.55v9.9l-.571.55H.57L0 10.45zm1.143 1.138V9.9h13.714V1.69l-6.503 4.8h-.697zM13.749 1.1H2.25L8 5.356z" fill="#6B7280"/>
                </svg>
                <input name="email" type="email" placeholder="Enter your Email" class="bg-transparent text-gray-500/80 placeholder-gray-500/80 outline-none text-sm w-full h-full" required>                 
            </div>

            <div class="flex items-center mt-6 w-full bg-transparent border border-gray-300/60 h-12 rounded-full overflow-hidden pl-6 gap-2">
                <svg width="13" height="17" viewBox="0 0 13 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 8.5c0-.938-.729-1.7-1.625-1.7h-.812V4.25C10.563 1.907 8.74 0 6.5 0S2.438 1.907 2.438 4.25V6.8h-.813C.729 6.8 0 7.562 0 8.5v6.8c0 .938.729 1.7 1.625 1.7h9.75c.896 0 1.625-.762 1.625-1.7zM4.063 4.25c0-1.406 1.093-2.55 2.437-2.55s2.438 1.144 2.438 2.55V6.8H4.061z" fill="#6B7280"/>
                </svg>
                <input name="password" type="password" placeholder="Enter Your Password" class="bg-transparent text-gray-500/80 placeholder-gray-500/80 outline-none text-sm w-full h-full" required>
            </div>

            <x-forms.error name="password" />


            <button type="submit" class="mt-5 w-full h-11 rounded-full text-white bg-blue-600 hover:opacity-90 transition-opacity">
                Login
            </button>
            <p class="text-gray-500/90 text-sm mt-4">Don’t have an account? <a class="text-indigo-500 hover:underline" href="/register">Sign up</a></p>
       <div class="my-5 flex items-center gap-3">
    <div class="h-px bg-gray-300 flex-1"></div>
    <span class="text-gray-400 text-sm">OR</span>
    <div class="h-px bg-gray-300 flex-1"></div>
</div>


<a href="{{ route('google.login') }}"
   class="w-full flex items-center justify-center gap-3 
          bg-white text-gray-800 
          border border-gray-300
          py-3 rounded-xl
          font-semibold
          hover:bg-gray-100
          transition">

    <svg class="w-5 h-5" viewBox="0 0 24 24">
        <path fill="#4285F4" d="M21.35 12.23c0-.78-.07-1.54-.22-2.27H12v4.3h5.25a4.5 4.5 0 0 1-1.95 2.95v2.45h3.16c1.85-1.7 2.89-4.2 2.89-7.43z"/>
        <path fill="#34A853" d="M12 21.5c2.7 0 4.97-.9 6.63-2.44l-3.16-2.45c-.88.6-2 1-3.47 1-2.67 0-4.93-1.8-5.74-4.22H3v2.52A10 10 0 0 0 12 21.5z"/>
        <path fill="#FBBC05" d="M6.26 13.39a6 6 0 0 1 0-3.78V7.09H3a10 10 0 0 0 0 9.82l3.26-2.52z"/>
        <path fill="#EA4335" d="M12 6.4c1.55 0 2.94.53 4.04 1.57l3.03-3.03C16.96 3.35 14.7 2.5 12 2.5A10 10 0 0 0 3 7.09l3.26 2.52C7.07 8.2 9.33 6.4 12 6.4z"/>
    </svg>

    Continue with Google

</a>
        </form>
    </div>
</div>

</x-layout>    



