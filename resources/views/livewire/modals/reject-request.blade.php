<div>
  <div class="flex flex-col items-center justify-center p-8 text-center bg-white rounded-lg">
    @svg('fluentui-warning-24', 'h-24 w-24 text-red-400')
    <h1 class="mb-8 text-lg font-bold">Are you sure you want to reject this request?</h1>
    <div class="flex gap-4 justify-stretch">
      <button wire:click="$dispatch('closeModal')">No, do not delete</button>
      <button wire:click="rejectRequest({{ $request_id }})" class="p-4 text-center text-white bg-red-500 rounded-lg">Yes, continue</button>
    </div>
  </div>
</div>
