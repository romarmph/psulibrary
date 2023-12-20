<div class="relative overflow-x-auto sm:rounded-lg">
  <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
    <caption class="p-5 text-2xl font-semibold text-left text-gray-900 bg-white rtl:text-right dark:text-white dark:bg-gray-800">
      Recently Borrowed Books
      <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
        List of recently borrowed books.
      </p>
      <form class="max-w-md my-4">
        <label for="recent-borrow-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
          <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
          </div>
          <input type="search" id="recent-borrow-search" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search books" required>
          <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Search
          </button>
        </div>
      </form>
    </caption>

    <thead class="text-xs text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-6 py-3 hover:bg-gray-100">
          ID No.
        </th>
        <th scope="col" class="px-6 py-3 hover:bg-gray-100">
          Name
        </th>
        <th scope="col" class="px-6 py-3 hover:bg-gray-100">
          Book ISBN
        </th>
        <th scope="col" class="px-6 py-3 hover:bg-gray-100">
          Book Title
        </th>
        <th scope="col" class="px-6 py-3 hover:bg-gray-100">
          Quantity
        </th>
        <th scope="col" class="px-6 py-3 hover:bg-gray-100">
          Date
        </th>
        <th class="hover:bg-gray-100"></th>
      </tr>
    </thead>
    <tbody>
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100">
        <td class="px-6 py-4 ">
          1
        </td>
        <td class="px-6 py-4">
          Silver
        </td>
        <td class="px-6 py-4">
          Laptop
        </td>
        <td class="px-6 py-4">
          $2999
        </td>
        <td class="px-6 py-4">
          8
        </td>
        <td class="px-6 py-4">
          8
        </td>
        <td class="text-center">
          <a href="" class="px-2 py-2 text-center text-white bg-blue-500 rounded-md hover:bg-blue-600">View</a>
          <a href="" class="px-2 py-2 text-center text-white bg-green-500 rounded-md hover:bg-green-600">Return</a>
        </td>
      </tr>
    </tbody>
  </table>
</div>
