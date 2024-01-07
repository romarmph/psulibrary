<div>
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
  <div class="max-w-5xl p-4 mx-auto">
    <div class="flex items-center justify-between">
      <h1 class="text-3xl font-bold text-gray-800">My Cart</h1>
      <p class="text-xl text-gray-600">{{ $cartCount }} Books</p>
    </div>
    <hr class="my-4" />
    <div class="flex items-center justify-between gap-3 mb-4">
      <p class="flex-1 text-sm text-gray-400">BOOK DETAILS</p>
      <p class="text-sm text-center text-gray-400 w-28">QUANTITY</p>
      <p class="text-sm text-gray-400 w-28"></p>
    </div>
    <div class="">
      @if($books->isEmpty())

      <div class="flex items-center justify-center h-64">
        <p class="text-2xl font-bold text-gray-400">No books in cart</p>
      </div>

      @endif
      @foreach ($books as $book)
      <div id="card" wire:key='cart-item{{ $book->id }}' class="flex items-center justify-between gap-12 my-6">
        <div class="flex-1 details">
          <p class="text-xl font-bold text-gray-700">{{ $book->title }}</p>
          <p class="flex items-center gap-4 text-sm text-gray-500">@svg('fluentui-building-factory-20-o', 'h-4 w-4 text-gray-400') {{ $book->publisher }}</p>
          <p class="flex items-center gap-4 text-sm text-gray-500">@svg('fluentui-tag-20-o', 'h-4 h-4 text-gray-400') {{ $book->category }}</p>
        </div>
        <div class="flex items-center justify-center gap-4 text-center quantity w-28">
          <button class="px-3 py-1 text-white bg-gray-500 rounded-lg hover:bg-gray-600 active:bg-gray-700" wire:click='decreaseQuantity({{ $book->id }})'>-</button>
          <p class="px-4 py-2 bg-gray-100 rounded-lg">{{ $book->quantity }}</p>
          <button class="px-3 py-1 text-white bg-gray-500 rounded-lg hover:bg-gray-600 active:bg-gray-700" wire:click='increaseQuantity({{ $book->id }})'>+</button>
        </div>
        <div class="w-20 text-sm text-gray-400">
          <button class="px-4 py-2 text-white rounded-lg " wire:click='removeFromCart({{ $book->id }})'>@svg('fluentui-delete-28-o', 'h-6 w-6 text-gray-400')</button>
        </div>
      </div>
      @endforeach
    </div>
    <hr class="my-4" />
    <div class="flex items-center justify-between">
      <p class="text-xl font-bold text-gray-800">Total</p>
      <p class="text-xl font-bold text-gray-800">4</p>
    </div>
    <div class="flex items-center justify-between mt-4">
      <a href="/borrower/books" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-600 active:bg-gray-700">Look for more books</a>
      <a href="/borrower/request" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 active:bg-blue-700">Request</a>
    </div>
  </div>

</div>
