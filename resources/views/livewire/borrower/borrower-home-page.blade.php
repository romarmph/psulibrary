<div class="bg-gray-5-">
  <x-slot name="header">
    <div class="flex items-center">
      <a href="/borrower" class="me-4">
        <img src="/images/logo.png" alt="PSU logo" class="h-8">
      </a>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Pangasinan State University Library') }}
      </h2>
    </div>
  </x-slot>


  <div class="p-4 sm:p-8">
    <h1 class="mb-4 text-2xl font-semibold text-gray-800">
      Welcome {{ $user->first_name }}!
    </h1>

    <div class="grid grid-cols-2 gap-4 mb-4">
      <x-borrower-home-button iconColor="white" title="Browse Books" route="/borrower/books/" icon="fluentui-library-20" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" />
      <x-borrower-home-button iconColor="white" title="My Borrowed Books" route="#" icon="fluentui-book-clock-20" class="text-white bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" />
    </div>
  </div>


</div>
