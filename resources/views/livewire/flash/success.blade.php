<div class="">
  @if (session()->has('success'))
  <div class="inline p-4 text-green-500 bg-green-200 border border-green-500 rounded-md">
    {{ session('success') }}
  </div>
  @endif
</div>
