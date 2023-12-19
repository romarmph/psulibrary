<div class="p-4">
  <x-slot name="header">
    <h1 class="text-2xl font-medium">Dashboard</h1>
  </x-slot>
  <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 xl:grid-cols-4">
    <livewire:components.dashboard-card :iconBgColor="'bg-blue-500'" :iconColor="'text-white'" :title="'Total Books'" :route="'#'" :value="'100'" />
    <div class="bg-red-400 h-44"></div>
    <div class="bg-red-400 h-44"></div>
    <div class="bg-red-400 h-44"></div>
  </div>
</div>
