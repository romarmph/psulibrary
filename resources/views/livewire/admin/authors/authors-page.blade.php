<div class="p-4 bg-white">

  <x-slot name="header">
    <h1 class="text-2xl font-medium">Authors</h1>
  </x-slot>
  <form wire:submit.prevent="{{ strtolower($mode) }}" class="mb-4">
    <div class="flex flex-col items-center space-x-4 justify-stretch md:flex-row">
      <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-60 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type Author name" wire:model="name">
      <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg">{{ $mode }} author</button>
      @error('name') <span class="error">{{ $message }}</span> @enderror
    </div>
  </form>
  <div class="p-4">
    <livewire:components.authors-table>
  </div>
</div>
