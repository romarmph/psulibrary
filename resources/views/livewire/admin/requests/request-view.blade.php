<div class="p-4">

  <x-slot name="header">
    <h1 class="text-2xl font-medium">Borrow Request</h1>
  </x-slot>
  <div class="p-4 bg-white rounded-lg">
    <h2 class="text-xl text-gray-600">Borrower Info</h2>
    <hr class="my-4" />
    <img src="{{ $borrower->photo_url }}" alt="" class="object-cover w-48 h-48 p-4 border border-gray-200 rounded-full">
    <div class="flex flex-col gap-3">
      <p class="text-xl font-bold text-gray-800">{{ $borrower->first_name }}</p>
      <p class="text-sm text-gray-500">{{ $borrower->email }}</p>
      <p class="text-sm text-gray-500">{{ $borrower->phone_number }}</p>
    </div>
    <h2 class="my-4 text-xl text-gray-600">Requested Books</h2>
    <hr class="my-4">
    <div>
      <div class="flex items-center justify-between gap-3 mb-4">
        <p class="flex-1 text-sm text-gray-400">BOOK DETAILS</p>
        <p class="w-20 text-sm text-center text-gray-400">QUANTITY</p>
        <p class="text-sm text-gray-400 w-28"></p>
      </div>
      @foreach ($requestedBooks as $book)
      <livewire:components.cart-item-card :book="$book" />
      @endforeach
    </div>
  </div>

</div>
