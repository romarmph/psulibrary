<div>
  <section class="mt-10" wire:poll.1000ms>
    <div class="mx-auto ">
      <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
        <div class="flex items-center justify-between p-4 d">
          <div class="flex">
            <div class="relative w-full">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
              </div>
              <input wire:model.live='search' type="text" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 " placeholder="Search" required="">
            </div>
          </div>
          <div class="flex space-x-3">
            <div class="flex items-center space-x-3">
              <label class="w-40 text-sm font-medium text-gray-900">Category</label>
              <select wire:model.live='category' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                <option value="0">All</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
              <tr>
                <th scope="col" class="px-4 py-3">
                  <button class="w-full">ID Number</button>
                </th>
                <th scope="col" class="px-4 py-3">Name</th>
                <th scope="col" class="px-4 py-3">Book Title</th>
                <th scope="col" class="px-4 py-3">Book ISBN</th>
                <th scope="col" class="px-4 py-3">Category</th>
                <th scope="col" class="px-4 py-3">Quantity</th>
                <th scope="col" class="px-4 py-3">Date Issued</th>
                <th scope="col" class="px-4 py-3">Date Due</th>
                <th scope="col" class="px-4 py-3">
                  <span class="sr-only">Actions</span>
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($borrows as $borrow)
              <tr class="border-b dark:border-gray-700">

                <td class="px-4 py-3 text-lg">{{ $borrow->id_number }}</td>
                <td class="px-4 py-3 text-lg">{{ $borrow->first_name.' '.$borrow->last_name }}</td>
                <td class="px-4 py-3 text-lg">{{ $borrow->title }}</td>
                <td class="px-4 py-3 text-lg">{{ $borrow->isbn }}</td>
                <td class="px-4 py-3 text-lg">{{ $borrow->category }}</td>
                <td class="px-4 py-3 text-lg">{{ $borrow->quantity }}</td>
                <td class="px-4 py-3 text-lg">
                  {{ date('F j, Y, g:i a', strtotime($borrow->borrowed_from_date)) }}
                </td>
                <td class="px-4 py-3 text-lg">
                  {{ date('F j, Y, g:i a', strtotime($borrow->borrowed_to_date)) }}
                </td>
                <td class="px-4 py-3">
                  <a href="#" class="px-3 py-2 text-white bg-green-500 rounded-lg">
                    View
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="px-3 py-4">
          <div class="flex items-center justify-between">
            <div class="flex items-center mb-3 space-x-4">
              <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
              <select wire:model.live='perPage' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
              </select>
            </div>
            {{ $borrows->links() }}
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
