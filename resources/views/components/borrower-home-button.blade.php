<a href="{{ $route }}">
  <div {{ $attributes->merge(['class' => 'flex items-center justify-center h-64 gap-4 border-2 rounded-lg']) }}>
    @svg( $icon , 'w-10', ['style' => 'color: '.$iconColor])
    <p class="text-2xl dark:text-gray-500">
      {{ $title }}
    </p>
  </div>
</a>
