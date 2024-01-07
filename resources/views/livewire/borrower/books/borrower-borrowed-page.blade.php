<div class="bg-gray-5-">
  <x-slot name="header">
    <div class="flex items-center gap-4">
      <a href="/borrower" class="">
        <img src="/images/logo.png" alt="PSU logo" class="h-8">
      </a>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Pangasinan State University Library') }}
      </h2>
    </div>
  </x-slot>

  <div class="p-12">
    <h1 class="my-4 text-2xl font-medium">My Borrowed Books</h1>
    <hr class="my-4" />
    <div class="p-4">
      <livewire:borrower.borrowed-books-table>
    </div>
  </div>
</div>
