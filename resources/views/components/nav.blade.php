<div class="navbar bg-base-100 shadow-sm">
  <div class="navbar-start">
    <div class="dropdown">
      <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /> </svg>
      </div>
      <ul
        tabindex="-1"
        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
        <li><a>Home</a></li>
        <li>
          <a>Parent</a>
          <ul class="p-2">
            <li><a>Submenu 1</a></li>
            <li><a>Submenu 2</a></li>
          </ul>
        </li>
        <li><a>Item 3</a></li>
      </ul>
    </div>
    <a class="btn btn-ghost text-xl">Cold Chain</a>
  </div>
  <div class="navbar-center hidden lg:flex">
    <ul class="menu menu-horizontal px-1">
      <li><a>Home</a></li>
      <li><a>About</a></li>
    </ul>
  </div>

  @auth
  <div class="navbar-end flex items-center gap-3">
    <p>Welome, {{ Auth::user()->name }}</p>
    <form action="/logout" method="POST">
       @csrf
       @method('DELETE')
       <button type="submit" class="bg-red-600 p-3 rounded-lg">Logout</button>
    </form>
    
  </div>
      
  @endauth

  @guest
   <div class="navbar-end flex items-center gap-3">
    <a href="/login" class="">Sign In</a>
    <a href="/register" class="btn rounded-full bg-indigo-600 border-0 text-white hover:bg-indigo-700">Sign Up</a>
  </div>   
  @endguest
  
</div>