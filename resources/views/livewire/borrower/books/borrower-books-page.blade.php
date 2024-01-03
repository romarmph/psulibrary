<div class="bg-gray-5-">
  <x-slot name="header">
    <div class="flex items-center gap-4">
      <a href="/borrower" class="">
        <img src="/images/logo.png" alt="PSU logo" class="h-8">
      </a>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Pangasinan State University Library') }}
      </h2>
    </div>
  </x-slot>

  <div class="p-8 ">
    <a href="/borrower/" class="flex items-center gap-4">
      <span>@svg('fluentui-arrow-left-20', 'h-4 w-4')</span>
      <span>Back</span>
    </a>
  </div>

  <div class="p-8">
    {{-- Content here --}}
  </div>

</div>
