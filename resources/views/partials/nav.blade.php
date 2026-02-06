<div class="p-6 text-2xl font-bold border-b border-slate-800">
  HR Portal
</div>
<nav class="flex-1 p-4 space-y-2">
  <a href="#" class="flex items-center space-x-3 bg-blue-600 p-3 rounded-lg transition">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
      </path>
    </svg>
    <span>Dashboard</span>
  </a>
  <a href="#"
    class="flex items-center space-x-3 text-slate-400 hover:text-white hover:bg-slate-800 p-3 rounded-lg transition">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
      </path>
    </svg>
    <span>Employees</span>
  </a>
</nav>
<div class="p-4 border-t border-slate-800">
  <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button class="flex items-center space-x-3 text-red-400 hover:text-red-300 w-full p-3 transition">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
      </svg>
      <span>Logout</span>
    </button>
  </form>
</div>
