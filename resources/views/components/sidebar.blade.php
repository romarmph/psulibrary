<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
  <div class="h-full px-3 py-4 overflow-y-auto bg-white dark:bg-gray-800">
    <div class="flex justify-between">
      <a href="/" class="flex items-center ps-2.5 mb-5">
        <img src="/images/logo.png" class="h-6 me-3 sm:h-7" alt="PSU Logo" />
        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">PSU Library</span>
      </a>
      <x-dropdown align="right" width="48">
        <x-slot name="trigger">
          <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
            <div>{{ Auth::user()->name }}</div>

            <div class="ms-1">
              <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </div>
          </button>
        </x-slot>

        <x-slot name="content">
          {{-- <x-dropdown-link :href="route('profile.edit')">
            {{ __('Profile') }}
          </x-dropdown-link> --}}

          <!-- Authentication -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                              this.closest('form').submit();">
              {{ __('Log Out') }}
            </x-dropdown-link>
          </form>
        </x-slot>
      </x-dropdown>
    </div>
    <ul class="space-y-2 font-medium">
      <li>
        <x-sidebar-links route="/admin" title="Dashboard" icon="fluentui-home-16" />
      </li>
      <li>
        <x-sidebar-links route="/books" title="Books" icon="fluentui-library-20" />
      </li>
      <li>
        <x-sidebar-links route="/borrows" title="Borrows" icon="fluentui-library-20" />
      </li>
      <li>
        <x-sidebar-links route="/requests" title="Requests" icon="fluentui-clipboard-text-edit-24" />
      </li>
      <li>
        <x-sidebar-links route="/authors" title="Authors" icon="fluentui-whiteboard-24" />
      </li>
      <li>
        <x-sidebar-links route="/publishers" title="Publishers" icon="fluentui-building-factory-20" />
      </li>
      <li>
        <x-sidebar-links route="/staffs" title="Staffs" icon="fluentui-shield-person-20" />
      </li>
    </ul>
  </div>
</aside>
