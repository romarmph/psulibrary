<div id="card" wire:key='requested-book{{ $book->id }}' class="flex items-center justify-between gap-12 my-8">
  <div class="flex gap-2">
    <img src="{{ $book->photo_url }}" alt="" class="object-cover w-24 h-24 rounded-lg">
    <div class="flex-1 details">
      <p class="flex items-center gap-4 text-xl font-bold text-gray-700">{{ $book->title }}<span class="p-1 text-xs text-white bg-teal-400 rounded-md">{{ $book->published_at }}</span></p>
      <p class="flex items-center gap-4 text-lg font-bold text-gray-500">@svg('fluentui-barcode-scanner-24-o', 'h-6 w-6 text-gray-400') {{ $book->isbn }}</p>
      <p class="flex items-center gap-4 text-sm text-gray-500">@svg('fluentui-building-factory-20-o', 'h-4 w-4 text-gray-400') {{ $book->publisher }}</p>
      <p class="flex items-center gap-4 text-sm text-gray-500">@svg('fluentui-tag-20-o', 'h-4 h-4 text-gray-400') {{ $book->category }}</p>

    </div>
  </div>
  <p class="w-20 px-4 py-2 text-center bg-gray-100 rounded-lg">{{ $book->quantity }}</p>

</div>
