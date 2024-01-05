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

  <div class="p-8 ">
    <a href="/borrower/" class="flex items-center gap-4">
      <span>@svg('fluentui-arrow-left-20', 'h-4 w-4')</span>
      <span>Back</span>
    </a>
  </div>

  <div class="grid grid-cols-2 gap-2 p-2 md:gap-4 lg:gap-8 md:grid-cols-3 lg:grid-cols-5">
    @foreach($books as $book)
    <div>
      <a href="{{ route('book.details', ['bookId' => $book->id]) }}">
        <div class="relative flex flex-col p-4 bg-white rounded-lg shadow-md">
          <img src="{{ $book->photo_url }}" alt="{{ $book->title }}" class="object-cover w-full h-40 mb-4 rounded-md">
          <h3 class="text-lg font-semibold">{{ $book->title }}</h3>
          <p class="mb-2 text-gray-600">ISBN: {{ $book->isbn }}</p>
          <p class="overflow-hidden text-gray-700 text-ellipsis whitespace-nowrap">{{ $book->description }}</p>
          <div class="flex-grow"></div> <!-- Pushes the following content to the bottom -->
          <div class="flex items-center justify-between mt-2">
            <span class="text-lg font-bold text-blue-500">Available Copies: {{ $book->available_copies }}</span>
            <a href="{{ route('book.borrow', ['bookId' => $book->id]) }}" class="px-2 py-2 text-white bg-blue-500 rounded-lg">Borrow</a>
          </div>
        </div>
      </a>
    </div>

    @endforeach
  </div>


  <div class="px-4 py-4 my-8">
    {{ $books->links() }}
  </div>


</div>
