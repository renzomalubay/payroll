<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <div class="flex justify-center mb-6">
      <div class="bg-blue-600 p-3 rounded-full shadow-md">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
          </path>
        </svg>
      </div>
    </div>

    <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">Welcome Back</h2>

    <form action="{{ route('login') }}" method="POST">
      @csrf

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">Email Address</label>
        <input
          class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('email') border-red-500 @enderror"
          type="email" name="email" id="email" value="{{ old('email') }}" placeholder="you@example.com"
          required>

        @error('email')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <div class="flex justify-between mb-2">
          <label class="block text-gray-700 text-sm font-semibold" for="password">Password</label>
          <a href="#" class="text-sm text-blue-600 hover:underline">Forgot?</a>
        </div>
        <input
          class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('password') border-red-500 @enderror"
          type="password" name="password" id="password" placeholder="••••••••" required>

        @error('password')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit"
        class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300">
        Login
      </button>
    </form>

    <div class="relative flex py-5 items-center">
      <div class="flex-grow border-t border-gray-300"></div>
      <span class="flex-shrink mx-4 text-gray-400 text-sm">or</span>
      <div class="flex-grow border-t border-gray-300"></div>
    </div>

  </div>

</body>

</html>
