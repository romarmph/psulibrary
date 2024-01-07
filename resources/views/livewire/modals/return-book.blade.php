<div>
  <div class="flex flex-col items-center justify-center p-8 text-center bg-white rounded-lg">
    @svg('fluentui-checkmark-circle-12-o', 'h-24 w-24 text-green-400')
    <h1 class="mb-8 text-lg font-bold">Are you sure you want to return this book?</h1>
    <div class="flex gap-4 justify-stretch">
      <button wire:click="$dispatch('closeModal')">No, do not return</button>
      <button wire:click="returnBook" class="p-4 text-center text-white bg-green-500 rounded-lg">Yes, continue</button>
    </div>
  </div>
</div>
