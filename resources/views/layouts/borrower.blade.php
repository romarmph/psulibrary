<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

  @include('partials.imports')
</head>
<body class="font-sans antialiased">

  @if (isset($header))
  <header class="fixed top-0 z-50 flex items-center justify-between w-full mt-0 bg-white shadow dark:bg-gray-800">
    <div class="px-4 py-6">
      {{ $header }}
    </div>
    <div class="flex items-center gap-4">
      <div x-data="{ open: false }" @book-added.window="open = true; setTimeout(() => open = false, 1000);">
        <button x-show="open" class="p-2 text-green-600 bg-green-200 border border-green-600 rounded-lg animate-pulse">Book Added to Cart</button>
      </div>

      <livewire:components.cart-button />

      <div class="flex gap-4">
        <a href="/borrower/books">Books</a>
        <a href="/borrower/requested">My Requested Books</a>
        <a href="/borrower/borrowed">My Borrowed Books</a>
      </div>
      <x-dropdown align="right" width="48">
        <x-slot name="trigger">
          <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
            <div>{{ Auth::user()->id_number }}</div>
            <div class="ms-1">
              <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </div>
          </button>
        </x-slot>
        <x-slot name="content">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                              this.closest('form').submit();">
              {{ __('Log Out') }}
            </x-dropdown-link>
          </form>
        </x-slot>
      </x-dropdown>
    </div>
  </header>
  @endif

  <main class="mt-24">
    {{ $slot }}
  </main>

  @livewireScripts
  @livewire('wire-elements-modal')
</body>
</html>
