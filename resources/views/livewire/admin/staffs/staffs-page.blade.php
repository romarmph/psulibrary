<div class="p-4">

  <x-slot name="header">
    <h1 class="text-2xl font-medium">Staffs</h1>
  </x-slot>
  <div class="flex justify-between">
    <a href="/staffs/create" class="px-4 py-2 text-white bg-blue-500 rounded-lg">Add Staff</a>
    <livewire:flash.success>
  </div>
  <div class="mt-4">
    <livewire:components.staffs-table />
  </div>
</div>
