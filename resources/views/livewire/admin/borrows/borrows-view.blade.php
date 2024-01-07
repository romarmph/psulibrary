<div class="p-4">
  <x-slot name="header">
    <h1 class="text-2xl font-medium">Borrow Details</h1>
  </x-slot>

  <div class="p-4 bg-white rounded-lg">
    <div class="mb-4">
      <livewire:flash.success />
    </div>
    <div>
      <h2 class="text-xl text-gray-600">Borrower Info</h2>
      <hr class="my-4" />
      <div class="flex gap-8">
        <img src="{{ $user->photo_url }}" alt="" class="object-cover w-48 h-48 p-4 border border-gray-200 rounded-full">
        <div class="flex flex-col gap-3">
          <p class="text-2xl font-bold text-gray-800">{{ $user->first_name }} {{ $user->last_name }}</p>
          <div class="flex gap-4">
            <p class="text-lg text-gray-500">
              @svg('fluentui-mail-20-o', 'w-8 h-8 text-gray-400 inline-block mr-2')
              {{ $user->email }}
            </p>
            <p class="text-lg text-gray-500">
              @svg('fluentui-phone-20-o', 'w-8 h-8 text-gray-400 inline-block mr-2')
              {{ $user->phone_number }}
            </p>
          </div>
          <p class="text-lg text-gray-500">
            @svg('fluentui-location-20-o', 'w-8 h-8 text-gray-400 inline-block mr-2')
            {{ $user->address }}
          </p>
          <p class="text-lg text-gray-500">
            @svg('fluentui-hat-graduation-20-o', 'w-8 h-8 text-gray-400 inline-block mr-2')
            {{ $user->course }}
          </p>
          <p class="text-lg text-gray-500">
            @svg('fluentui-building-multiple-20-o', 'w-8 h-8 text-gray-400 inline-block mr-2')
            {{ $user->department }}
          </p>
        </div>
      </div>
      <h2 class="text-xl text-gray-600">Borrowed Books</h2>
      <hr class="my-4" />
      <livewire:components.borrows-view-books-table borrowId="{{ $borrowId }}" />
    </div>
  </div>
</div>
