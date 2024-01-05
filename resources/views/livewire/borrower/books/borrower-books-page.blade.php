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

  <div class="flex justify-between px-8 mt-4">
    <a href="/borrower/" class="flex items-center gap-4">
      <span>@svg('fluentui-arrow-left-20', 'h-4 w-4')</span>
      <span>Back</span>
    </a>
    <div class="flex gap-4">
      <div class="w-96">
        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Search</label>
        <input type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search by Title or ISBN" wire:model.live='search'>
      </div>
      <div class="w-64">
        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select category</label>
        <select wire:model.live="category" name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option value="" wire:click="resetFilters()">All</option>
          @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="w-28">
        <label for="published_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select year</label>
        <select wire:model.live="publishedAt" name="published_at" id="published_at" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option value="" wire:click="resetFilters()">All</option>
          @foreach ($publishing_years as $year)
          <option value="{{ $year }}">{{ $year }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  <div class="grid grid-cols-2 gap-2 px-2 mt-4 lg:px-8 md:gap-4 lg:gap-8 md:grid-cols-3 lg:grid-cols-5">
    @if($books->isEmpty())
    <section class="bg-white col-span-full dark:bg-gray-900">
      <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-16 lg:px-6">
        <div class="max-w-screen-sm mx-auto text-center">
          @svg('fluentui-book-question-mark-20-o', 'h-32 w-32 mx-auto text-gray-400 dark:text-gray-500')
          <p class="mb-4 text-3xl font-bold tracking-tight text-gray-900 md:text-4xl dark:text-white">Oopps...</p>
          <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Sorry, we can't find the book you're looking for. You'll find lots of book to explore, continue searching. </p>

        </div>
      </div>
    </section>
    @endif

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
