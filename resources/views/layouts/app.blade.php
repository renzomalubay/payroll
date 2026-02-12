@include('partials.header')

<body class="bg-slate-100 text-slate-200">

  <div class="flex h-screen overflow-hidden">
    <aside class="hidden md:flex flex-col w-64 bg-slate-900 text-white">
      @include('partials.nav')
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto">
      <header class="bg-white shadow-sm h-16 flex items-center justify-between px-8">
        <h1 class="text-xl font-semibold text-gray-800">Payroll System</h1>
        <div class="flex items-center space-x-4">
          <span class="text-sm text-gray-600 italic">Welcome, {{ auth()->user()->name ?? 'Admin' }}</span>
          <img class="w-8 h-8 rounded-full border" src="https://ui-avatars.com/api/?name=Admin" alt="User">
        </div>
      </header>

      @yield('content')
    </main>
  </div>

  @stack('scripts')

</body>

</html>
