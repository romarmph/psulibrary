@php
$active = 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700';
$iconColor = 'text-gray-400 dark:text-gray-300';

if(strpos($route,request()->route()->uri ) !== false) {
$active = 'bg-blue-600 text-white';
$iconColor = 'text-white';
}

@endphp
<a href="{{ $route }}" class="flex items-center p-2 rounded-lg {{ $active }}">
  @svg($icon, 'h-6 w-6 '.$iconColor)
  <span class="ms-3">{{ $title }}</span>
</a>
