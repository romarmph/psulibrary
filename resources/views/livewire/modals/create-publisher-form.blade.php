<div>
  <section class="bg-white dark:bg-gray-900">
    <div class="max-w-2xl p-4">
      <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new publisher</h2>
      <form wire:submit.prevent="createPublisher">
        <div class="grid gap-4 ">
          <div class="sm:col-span-2">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publisher Name</label>
            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type publisher name" required="" wire:model="name">
            @error('name') <span class="error">{{ $message }}</span> @enderror
          </div>
        </div>
        <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-gray-700 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-800" wire:click="$dispatch('closeModal')">
          Cancel
        </button>
        <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
          Add publisher
        </button>

      </form>
    </div>
  </section>
</div>
