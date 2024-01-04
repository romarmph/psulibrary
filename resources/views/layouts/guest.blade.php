<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  <link rel="stylesheet" href="{{ asset('build/assets/app-b2b172a9.css') }}">
  <link rel="stylesheet" href="{{ asset('build/assets/app-f3e22746.css') }}">

  <script src="{{ asset('build/assets/app-7e0e1771.js') }}"></script>
</head>
<body class="font-sans antialiased text-gray-900">
  <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0 dark:bg-gray-900">


    <div class="flex flex-col items-center justify-center w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md dark:bg-gray-800 sm:rounded-lg">
      {{ $slot }}
    </div>
  </div>
</body>
</html>
