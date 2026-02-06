<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard')</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('logo/logo.png') }}">

  <meta content="" name="description">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta content="" name="keywords">

  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap"
    rel="stylesheet">

  {{-- ziggy --}}
  {{-- @routes --}}

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
