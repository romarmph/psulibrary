<div class="p-4">
  <x-slot name="header">
    <h1 class="text-2xl font-medium">Dashboard</h1>
  </x-slot>
  <div class="grid grid-cols-1 gap-4 mb-4 lg:grid-cols-2 xl:grid-cols-4">
    <livewire:components.dashboard-card :icon="'fluentui-book-20'" :iconBgColor="'bg-blue-500'" :iconColor="'text-white'" :title="'Total Books'" :route="'#'" :value="'100'" />
    <livewire:components.dashboard-card :icon="'fluentui-book-coins-20'" :iconBgColor="'bg-green-500'" :iconColor="'text-white'" :title="'Current Books'" :route="''" :value="'75'" />
    <livewire:components.dashboard-card :icon="'fluentui-book-clock-20'" :iconBgColor="'bg-red-500'" :iconColor="'text-white'" :title="'Total Borrowed Books'" :route="'#'" :value="'25'" />
    <livewire:components.dashboard-card :icon="'fluentui-person-clock-20'" :iconBgColor="'bg-purple-500'" :iconColor="'text-white'" :title="'Total Borrowers'" :route="''" :value="'13'" />
  </div>
  <livewire:components.recent-borrows-table />
</div>
