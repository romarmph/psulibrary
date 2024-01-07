<div class="p-4">

  <x-slot name="header">
    <h1 class="text-2xl font-medium">Borrow Request</h1>
  </x-slot>
  <div class="p-4 bg-white rounded-lg">
    <h2 class="text-xl text-gray-600">Borrower Info</h2>
    <hr class="my-4" />
    <div class="flex gap-8">
      <img src="{{ $borrower->photo_url }}" alt="" class="object-cover w-48 h-48 p-4 border border-gray-200 rounded-full">
      <div class="flex flex-col gap-3">
        <p class="text-2xl font-bold text-gray-800">{{ $borrower->first_name }} {{ $borrower->last_name }}</p>
        <div class="flex gap-4">
          <p class="text-lg text-gray-500">
            @svg('fluentui-mail-20-o', 'w-8 h-8 text-gray-400 inline-block mr-2')
            {{ $borrower->email }}
          </p>
          <p class="text-lg text-gray-500">
            @svg('fluentui-phone-20-o', 'w-8 h-8 text-gray-400 inline-block mr-2')
            {{ $borrower->phone_number }}
          </p>
        </div>
        <p class="text-lg text-gray-500">
          @svg('fluentui-location-20-o', 'w-8 h-8 text-gray-400 inline-block mr-2')
          {{ $borrower->address }}
        </p>
        <p class="text-lg text-gray-500">
          @svg('fluentui-hat-graduation-20-o', 'w-8 h-8 text-gray-400 inline-block mr-2')
          {{ $borrower->course }}
        </p>
        <p class="text-lg text-gray-500">
          @svg('fluentui-building-multiple-20-o', 'w-8 h-8 text-gray-400 inline-block mr-2')
          {{ $borrower->department }}
        </p>
      </div>
    </div>
    <h2 class="my-4 text-xl text-gray-600">Requested Books</h2>
    <hr class="my-4">
    <div>
      <div class="flex items-center justify-between gap-3 mb-4">
        <p class="flex-1 text-sm text-gray-400">BOOK DETAILS</p>
        <p class="w-20 text-sm text-center text-gray-400">QUANTITY</p>
      </div>
      @foreach ($requestedBooks as $book)
      <livewire:components.requested-book-card :book="$book">

        @endforeach
    </div>
    <hr class="my-4" />
    <div class="flex items-center justify-end gap-4 p-4">
      <button class="px-4 py-2 font-bold text-gray-500 bg-white rounded-lg hover:bg-gray-200 active:bg-gray-300 text-normal" wire:click="$dispatch('openModal', { component: 'modals.reject-request', arguments: { request_id: {{ $book->request_id }} }})">
        Reject
      </button>
      <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-600 active:bg-blue-700 text-normal" wire:click="$dispatch('openModal', { component: 'modals.release-books', arguments: { request_id: {{ $book->request_id }} }})">
        Release
      </button>
    </div>
  </div>

</div>
