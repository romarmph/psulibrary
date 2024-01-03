<div class="">
  @if (session()->has('message'))
  <div class="inline p-4 text-green-500 bg-green-200 border border-green-500 rounded-md">
    {{ session('message') }}
  </div>
  @endif
</div>
