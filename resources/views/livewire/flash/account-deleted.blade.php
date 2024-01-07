<div class="">
  @if (session()->has('account_deleted'))
  <div class="inline p-4 text-red-500 bg-red-200 border border-red-500 rounded-md">
    {{ session('account_deleted') }}
  </div>
  @endif
</div>
