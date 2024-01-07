<div>
  <div class="grid grid-cols-1 gap-4 mb-4 lg:grid-cols-2 xl:grid-cols-4">
    <livewire:components.dashboard-card :icon="'fluentui-book-20'" :iconBgColor="'bg-blue-500'" :iconColor="'text-white'" :title="'Total Books'" :value="$totalUniqueBooks" />
    <livewire:components.dashboard-card :icon="'fluentui-book-coins-20'" :iconBgColor="'bg-green-500'" :iconColor="'text-white'" :title="'Total Book Copies'" :route="''" :value="$totalBookCopies" />
    <livewire:components.dashboard-card :icon="'fluentui-book-clock-20'" :iconBgColor="'bg-red-500'" :iconColor="'text-white'" :title="'Available Book Copies'" :value="$totalBooksAvailable" />
    <livewire:components.dashboard-card :icon="'fluentui-book-question-mark-20'" :iconBgColor="'bg-gray-500'" :iconColor="'text-white'" :title="'Total Unreturned Books'" :route="''" :value="$totalUnreturnedBooks" />
    {{-- <livewire:components.dashboard-card :icon="'fluentui-book-theta-20'" :iconBgColor="'bg-purple-500'" :iconColor="'text-white'" :title="'Total Copies Issued Borrowers'" :route="''" :value="$totalBooksIssued" /> --}}
    <livewire:components.dashboard-card :icon="'fluentui-person-link-24'" :iconBgColor="'bg-orange-500'" :iconColor="'text-white'" :title="'Total Borrowers'" :route="''" :value="$totalBorrowersWithUnreturnedBooks" />
    <livewire:components.dashboard-card :icon="'fluentui-book-exclamation-mark-20'" :iconBgColor="'bg-teal-500'" :iconColor="'text-white'" :title="'Books Due Today'" :route="''" :value="$totalBooksDueToday" />
    <livewire:components.dashboard-card :icon="'fluentui-person-clock-20'" :iconBgColor="'bg-yellow-500'" :iconColor="'text-white'" :title="'Borrowers Due Today'" :route="''" :value="$totalBorrowersWithBooksDueToday" />
  </div>
</div>
