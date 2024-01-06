<div>
  <div class="relative flex flex-col p-4 bg-white rounded-lg shadow-md">
    <img src="{{ $book->photo_url }}" alt="{{ $book->title }}" class="object-cover w-full h-40 mb-4 rounded-md">
    <a href="{{ route('book.details', ['bookId' => $book->id]) }}">
      <h3 class="text-lg font-semibold">{{ $book->title }}</h3>
    </a>

    <p class="flex items-center justify-between mb-2 text-gray-600">ISBN: {{ $book->isbn }} <span class="p-1 text-white bg-teal-500 rounded-md">{{ $book->published_at }}</span></p>
    <p class="flex items-center gap-2 py-2 mb-2 text-gray-600">@svg('fluentui-building-factory-20', 'h-6 w-6 text-gray-400') {{ $book->publisher->name }}</p>
    <p class="overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap">{{ $book->description }}</p>

    <div class="flex items-center justify-between mt-2">

      <span class="flex items-center gap-2 font-medium text-gray-400 text-md">
        @svg('fluentui-copy-24-o', 'h-6 w-6 text-gray-400'){{ $book->available_copies }}/{{ $book->total_copies }}
      </span>

      <button class="px-2 py-2 text-white bg-blue-500 rounded-full" wire:click="addToCart({{ $book->id }})">
        @svg('fluentui-copy-add-24-o', 'h-6 w-6 text-white')
      </button>
    </div>
  </div>
</div>
