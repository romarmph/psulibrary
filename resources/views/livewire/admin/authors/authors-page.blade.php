<div class="p-4 bg-white">

  <x-slot name="header">
    <h1 class="text-2xl font-medium">Authors</h1>
  </x-slot>
  <form wire:submit.prevent="{{ strtolower($mode) }}">
  <div class="flex space-x-4">
      <input type="text" 
            name="name" 
            id="name" 
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-60 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            placeholder="Type Author name" 
            wire:model="name">
            @error('name') <span class="error">{{ $message }}</span> @enderror
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">{{ $mode }} author</button>
  </div>
  </form>
  <livewire:components.authors-table>
</div>
