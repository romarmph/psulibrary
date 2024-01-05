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

  <div class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="max-w-screen-lg w-full p-8 bg-white rounded-md shadow-md">
        <div class="flex flex-col sm:flex-row">
            <div class="flex-shrink-0 w-full sm:w-64 mb-4 sm:mb-0">
                <img src="{{ $book->photo_url }}" alt="{{ $book->title }}" class="w-full h-96 object-cover rounded-md">
            </div>

            <div class="w-full sm:ml-4 flex flex-col flex-grow">
                <h2 class="text-2xl font-semibold mb-4">{{ $book->title }}</h2>

                <p class="text-gray-600"><strong>ISBN:</strong> {{ $book->isbn }}</p>
                <p class="text-gray-600"><strong>Published At:</strong> {{ $book->published_at }}</p>

                <p class="text-gray-700 mt-4">{{ $book->description }}</p>


                <div class="flex-grow"></div> <!-- Pushes the following content to the bottom -->
            
                <div class="mt-2 flex justify-between items-center">
                    <span class="text-lg font-bold text-blue-500">Available Copies: {{ $book->available_copies }}</span>
                    <div class="flex space-x-2">
                        <a href="/borrower/books" class="px-2 py-2 text-white bg-gray-500 rounded-lg">Back</a>
                        <a href="{{ route('book.borrow', ['bookId' => $book->id]) }}" class="px-2 py-2 text-white bg-blue-500 rounded-lg">Borrow</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>