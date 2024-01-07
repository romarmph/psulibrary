<div class="p-4">
    <x-slot name="header">
        <h1 class="text-2xl font-medium">Staffs</h1>
    </x-slot>
    <section class="bg-white rounded-lg dark:bg-gray-900">
        <div class="max-w-2xl p-4 mx-auto ">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">{{ $mode }} staffs</h2>
            <form wire:submit.prevent="{{ strtolower($mode) }}">
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="first_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Firstname</label>
                        <input type="text" name="first_name" id="first_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Firstname" wire:model="first_name">
                        @error('first_name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="last_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lastname</label>
                        <input type="text" name="last_name" id="last_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Lastname" wire:model="last_name">
                        @error('last_name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="id_number"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Id Number</label>
                        <input type="text" name="id_number" id="id_number"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Id Number" wire:model="id_number">
                        @error('id_number') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Email" wire:model="email">
                        @error('email') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="phone_number"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Phone Number" wire:model="phone_number">
                        @error('phone_number') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <input type="text" name="address" id="address"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Address" wire:model="address">
                        @error('address') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1"">
                        @if(is_string($image))
                            <img src="{{ $image }}" alt="">
                        @else
                            @if($image)
                                <img src="{{ $image->temporaryUrl() }}" alt="">
                            @endif
                        @endif
                        <label for="image"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                        <input type="file" name="image" id="image"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg h-12 focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="0" accept="image/png, image/jpeg" wire:model="image">
                        @error('image') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg h-12 focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Password" wire:model="password">
                        @error('password') <span class="error">{{ $message }}</span> @enderror
                    </div>

                </div>
                <a href="/staffs"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-gray-700 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-blue-800">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                    {{ $mode }} staff
                </button>
            </form>
        </div>
    </section>
</div>
