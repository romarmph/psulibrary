<div id="card" wire:key='cart-item{{ $book->id }}' class="flex items-center justify-between gap-12 my-8">
  <div class="flex gap-2">
    <img src="{{ $book->photo_url }}" alt="" class="object-cover w-24 h-24 rounded-lg">
    <div class="flex-1 details">
      <p class="flex items-center gap-4 text-xl font-bold text-gray-700">{{ $book->title }}<span class="p-1 text-xs text-white bg-teal-400 rounded-md">{{ $book->published_at }}</span></p>
      <p class="flex items-center gap-4 text-lg font-bold text-gray-500">@svg('fluentui-barcode-scanner-24-o', 'h-6 w-6 text-gray-400') {{ $book->isbn }}</p>
      <p class="flex items-center gap-4 text-sm text-gray-500">@svg('fluentui-building-factory-20-o', 'h-4 w-4 text-gray-400') {{ $book->publisher }}</p>
      <p class="flex items-center gap-4 text-sm text-gray-500">@svg('fluentui-tag-20-o', 'h-4 h-4 text-gray-400') {{ $book->category }}</p>

    </div>
  </div>

  <div class="flex items-center gap-4">
    <div class="flex items-center justify-center gap-4 text-center quantity w-28">
      <button class="px-3 py-1 text-white bg-gray-500 rounded-lg hover:bg-gray-600 active:bg-gray-700" wire:click='$dispatch(decrease-quantity", {bookId: {{ $book->id }}})'>-</button>
      <p class="px-4 py-2 bg-gray-100 rounded-lg">{{ $book->quantity }}</p>
      <button class="px-3 py-1 text-white bg-gray-500 rounded-lg hover:bg-gray-600 active:bg-gray-700" wire:click='increaseQuantity({{ $book->id }})'>+</button>
    </div>
    <div class="w-20 text-sm text-gray-400">
      <button class="px-4 py-2 text-white rounded-lg " wire:click='removeFromCart({{ $book->id }})'>@svg('fluentui-delete-28-o', 'h-6 w-6 text-gray-400')</button>
    </div>
  </div>
</div>
