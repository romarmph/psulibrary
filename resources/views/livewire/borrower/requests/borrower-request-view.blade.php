<div class="bg-red-5-">
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

  <div class="px-12 mt-4">
    <div class="flex items-center gap-4">
      <a href="/borrower/requested" class="flex items-center gap-4">
        <span>@svg('fluentui-arrow-left-20', 'h-4 w-4')</span>
        <span>Back</span>
      </a>
      <h2 class="my-4 text-xl text-gray-600">Requested Books</h2>
    </div>
    <hr class="my-4">
    <div>
      <div class="flex items-center justify-between gap-3 mb-4">
        <p class="flex-1 text-sm text-gray-400">BOOK DETAILS</p>
        <p class="w-20 text-sm text-center text-gray-400">QUANTITY</p>
      </div>
      @foreach ($requestedBooks as $book)
      <livewire:components.requested-book-card :book="$book" />
      @endforeach
    </div>
    <hr class="my-4" />
    <div class="flex items-center justify-end gap-4 p-4">
      <button class="px-4 py-2 font-bold text-white bg-red-500 rounded-lg hover:bg-red-600 active:bg-red-700 text-normal" wire:click="$dispatch('openModal', { component: 'modals.cancel-request', arguments: { request_id: {{ $book->request_id }} }})">
        Cancel
      </button>
    </div>
  </div>







</div>
