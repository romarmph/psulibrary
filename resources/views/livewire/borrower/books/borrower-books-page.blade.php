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

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 p-8">
    @foreach($books as $book)
        <div class="relative bg-white p-4 rounded-lg shadow-md flex flex-col">
            <img src="{{ $book->photo_url }}" alt="{{ $book->title }}" class="w-full h-40 object-cover mb-4">
            <h3 class="text-lg font-semibold">{{ $book->title }}</h3>
            <p class="text-gray-600 mb-2">ISBN: {{ $book->isbn }}</p>
            <p class="text-gray-700">{{ $book->description }}</p>
            
            <div class="flex-grow"></div> <!-- Pushes the following content to the bottom -->
            
            <div class="mt-2 flex justify-between items-center">
                <span class="text-lg font-bold text-blue-500">Available Copies: {{ $book->available_copies }}</span>
                <div class="flex space-x-2">
                    <a href="{{ route('book.borrow', ['bookId' => $book->id]) }}" class="px-2 py-2 text-white bg-blue-500 rounded-lg">Borrow</a>
                    <a href="{{ route('book.details', ['bookId' => $book->id]) }}" class="px-2 py-2 text-white bg-green-500 rounded-lg">View</a>
                </div>
            </div>
        </div>
    @endforeach
</div>


<div class="mt-8 px-4 pb-4">
    {{ $books->links() }}
</div>


</div>
