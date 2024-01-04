<div class="p-4">
  <x-slot name="header">
    <h1 class="text-2xl font-medium">Book</h1>
  </x-slot>
  <section class="bg-white rounded-lg dark:bg-gray-900">
    <div class="max-w-2xl p-4 mx-auto ">
      <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">{{ $mode }} book</h2>
      <form wire:submit.prevent="{{ strtolower($mode) }}">
        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
          <div class="col-span-2 sm:col-span-1">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ISBN</label>
            <input type="text" name="isbn" id="isbn" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type book ISBN" wire:model="isbn">
            @error('isbn') <span class="error">{{ $message }}</span> @enderror
          </div>
          <div class="col-span-2 sm:col-span-1">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Book title" wire:model="title">
            @error('title') <span class="error">{{ $message }}</span> @enderror
          </div>
          <div class="col-span-2">
            @if(is_string($image))
            <img src="{{ $image }}" alt="">
            @else
            @if($image)
            <img src="{{ $image->temporaryUrl() }}" alt="">

            @endif
            @endif
            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
            <input type="file" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" accept="image/png, image/jpeg" wire:model="image">
            @error('image') <span class="error">{{ $message }}</span> @enderror
          </div>

          <div class="col-span-2 sm:col-span-1">
            <label for="copies" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Copies</label>
            <input type="number" name="copies" id="copies" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" wire:model="copies">
            @error('copies') <span class="error">{{ $message }}</span> @enderror
          </div>
          <div class="col-span-2 sm:col-span-1">
            <label for="published_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Published at</label>
            <input type="text" name="published_at" id="published_at" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Year published" wire:model="published_at">
            @error('published_at') <span class="error">{{ $message }}</span> @enderror
          </div>
          <div class="col-span-2 sm:col-span-1">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
            <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="category">
              <option disabled>Select category</option>
              @foreach ($categories as $category )
              <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
            @error('category') <span class="error">{{ $message }}</span> @enderror
          </div>
          <div class="flex items-end w-full gap-4">
            <div class="flex-1">
              <label for="publisher" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publisher</label>
              <select id="publisher" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="publisher">
                <option selected="">Select publisher</option>
                @foreach ($publishers as $publisher )
                <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                @endforeach
              </select>
              @error('publisher') <span class="error">{{ $message }}</span> @enderror
            </div>
            <button type="button" wire:click="$dispatch('openModal', { component: 'modals.create-publisher-form' })" class="flex items-center gap-1">@svg('fluentui-add-square-24', 'h-12 w-12 text-blue-500')</button>
          </div>
          <div class="col-span-2 ">
            <div class="flex-1">
              <div class="flex items-end justify-between">
                <label for="author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Author</label>
                <button type="button" wire:click="$dispatch('openModal', { component: 'modals.create-author-form' })" class="flex items-center gap-1">@svg('fluentui-add-square-24', 'h-12 w-12 text-blue-500')</button>
              </div>
              <div wire:ignore>
                <select wire:model="selectedAuthors" multiple id="authorDropDown" style="padding: 24px; " class="w-full p-4 rounded-lg">
                  <option disabled>Select Author</option>
                  @foreach ($authors as $author)
                  <option value="{{ $author->id }}">{{ $author->name }}</option>
                  @endforeach
                </select>
                @error('author') <span class="error">{{ $message }}</span> @enderror
              </div>
            </div>
          </div>



          <div class="col-span-2">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
            <textarea id="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your description here" wire:model="description"></textarea>
            @error('description') <span class="error">{{ $message }}</span> @enderror
          </div>
        </div>
        <a href="/books" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-gray-700 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-blue-800">
          Cancel
        </a>
        <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
          {{ $mode }} book
        </button>
      </form>
    </div>
  </section>


  @script()
  <script>
    $(document).ready(function() {


      $('#authorDropDown').select2();
      $('#authorDropDown').on('change', function() {
        let data = $(this).val();
        @this.selectedAuthors = data;
      });
    });

  </script>
  @endscript
</div>
