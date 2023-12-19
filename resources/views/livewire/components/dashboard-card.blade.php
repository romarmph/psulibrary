<div class="flex flex-col justify-between p-4 bg-white rounded-lg h-44">
  <div class="flex justify-between">
    <p class="text-2xl font-medium text-gray-400">{{ $title }}</p>
    @if($route)
    <a href="{{ $route }}" class="flex gap-2 text-gray-400">
      <i>View</i> @svg('fluentui-arrow-right-16-o', 'h-6 w-6 text-gray-400')
    </a>
    @endif
  </div>
  <div class="flex items-center justify-between">
    <div class="p-4 {{ $iconBgColor }} rounded-full">
      @svg('fluentui-book-20', 'h-10 w-10 '.$iconColor)
    </div>
    <p class="text-5xl font-extrabold text-gray-600">{{ $value }}</p>
  </div>
</div>
