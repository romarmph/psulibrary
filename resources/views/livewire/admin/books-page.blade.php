<div class="p-4">

  <x-slot name="header">
    <h1 class="text-2xl font-medium">Books</h1>
  </x-slot>
  <livewire:components.books-quick-info>
    <div class="flex justify-between">
      <a href="/books/create" class="px-4 py-2 text-white bg-blue-500 rounded-lg">Add Book</a>
      <livewire:flash.success>
    </div>
    <div class="mt-4">
      <livewire:components.books-table />
    </div>
</div>
