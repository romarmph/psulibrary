<div class="p-4">
  <x-slot name="header">
    <h1 class="text-2xl font-medium">Borrows</h1>
  </x-slot>

  <div class="p-4 mt-4 bg-white rounded-lg">
    <div class="mb-4">
      <livewire:flash.success />
    </div>
    <livewire:components.borrows-table />
  </div>
</div>
