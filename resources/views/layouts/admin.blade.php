<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  @livewireStyles

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">

  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- Alpine Plugins -->
  <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

  <!-- Alpine Core -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <!-- Scripts -->

  <link rel="stylesheet" href="{{ asset('build/assets/app-b2b172a9.css') }}">
  <link rel="stylesheet" href="{{ asset('build/assets/app-f3e22746.css') }}">

  <script src="{{ asset('build/assets/app-7e0e1771.js') }}"></script>

  @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body class="font-sans antialiased">
  <div class="flex flex-col sm:flex-row">
    <x-sidebar />
    <div>
      <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 text-sm text-gray-500 rounded-lg ms-3 sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path clip-rule="evenodd" fill-rule="evenod" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
      </button>
    </div>
    <div class="flex-1 max-w-full min-h-screen bg-gray-50 dark:bg-gray-900 sm:ps-64">
      <!-- Page Heading -->
      @if (isset($header))
      <header class="p-4">
        <div class="px-4 py-6 mx-auto bg-white rounded sm:px-6 lg:px-8 dark:bg-gray-800">
          {{ $header }}
        </div>
      </header>
      @endif
      <!-- Page Content -->
      <main class="min-w-full">
        {{ $slot }}
      </main>
    </div>
  </div>
  </div>

  @livewireScripts
  @livewire('wire-elements-modal')
</body>
</html>
