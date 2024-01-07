<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @include('partials.imports')
  <title>Page Not Found</title>
</head>
<body>
  <section class="flex items-center justify-center w-full h-screen">
    <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-16 lg:px-6">
      <div class="flex flex-col items-center justify-center max-w-screen-sm mx-auto text-center">
        <div class="p-8">
          <x-application-logo>
          </x-application-logo>
        </div>
        <h1 class="mb-4 font-extrabold tracking-tight text-blue-600 text-7xl lg:text-9xl dark:text-blue-500">404</h1>
        <p class="mb-4 text-3xl font-bold tracking-tight text-gray-900 md:text-4xl dark:text-white">Something's missing.</p>
        <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Sorry, we can't find that page. You'll find lots to explore on the home page. </p>
        <a href="/" class="inline-flex text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center  dark:focus:ring-blue-900 my-4">Back to Homepage</a>
      </div>
    </div>
  </section>
</body>
</html>
