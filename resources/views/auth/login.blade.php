<x-guest-layout>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <div class="px-8 pt-12">
    <a href="/">
      <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
    </a>
  </div>
  <h1 class="p-4 text-3xl font-black text-blue-600">
    PSU Library
  </h1>

  <form method="POST" action="{{ route('login') }}" class="w-full">
    @csrf

    <!-- Email Address -->
    <div>
      <x-input-label for="id_number" :value="__('ID Number')" />
      <x-text-input id="id_number" class="block w-full mt-1" type="text" name="id_number" :value="old('id_number')" required autofocus autocomplete="username" />
      <x-input-error :messages="$errors->get('id_number')" class="mt-2" />
    </div>
    <!-- Password -->
    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')" />

      <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="w-full mt-4 text-center">
      <x-primary-button class="w-full p-4 text-center">
        {{-- {{ __('Log in') }} --}}
        <p class="w-full p-2 text-center">Login</p>
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>
