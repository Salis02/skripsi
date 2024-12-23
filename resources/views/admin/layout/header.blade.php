<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="https://almaata.ac.id/wp-content/uploads/2017/05/logo-alma-ata.jpg">
        <title>Admin | {{ $title }}</title>
        <link
          href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet"
        />
        <!-- Ubah path ini menjadi asset helper -->
        <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}" />

        <script
          src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
          defer
        ></script>
        <!-- Ubah path ini menjadi asset helper -->
        <script src="{{ asset('assets/js/init-alpine.js') }}"></script>

        <link
          rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
        />
        <script
          src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
          defer
        ></script>
        <!-- Ubah path ini menjadi asset helper -->
        <script src="{{ asset('assets/js/charts-lines.js') }}" defer></script>
        <script src="{{ asset('assets/js/charts-pie.js') }}" defer></script>
<body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        <aside
        class="z-20 hidden w-64 overflow-y-auto bg-gray-100 dark:bg-gray-800 md:block flex-shrink-0"
        >
        <div class="py-4 text-gray-500 dark:text-gray-400">
            <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="{{ route('admin.dashboard') }}"
            >
            ALMA ATA UNIVERSITY
            </a>
            
            <ul class="mt-6">
                <li class="relative px-6 py-3  {{ $active === 'Dashboard' ? 'bg-white dark:bg-gray-700 rounded-lg shadow-md' : '' }}">
                    <span
                        class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg
                        {{ $active === 'Dashboard' ? '' : 'hidden' }}"
                        aria-hidden="true"
                    ></span>
                    <a
                        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
                        {{ $active === 'Dashboard' ? 'text-purple-600 bg-purple-100 dark:bg-purple-800' : '' }}"
                        href="{{ route('admin.dashboard') }}"
                    >
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                            ></path>
                        </svg>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>
            </ul>
            <ul>
              <li class="relative text-sm px-6 py-2">
                Menu Kelola
              </li>
            </ul>
            <ul>
                <li class="relative px-6 py-3 {{ $active === 'Matkul' ? 'bg-white dark:bg-gray-700 rounded-lg shadow-md' : '' }}">
                        <span
                            class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ $active === 'Matkul' ? '' : 'hidden' }}"
                            aria-hidden="true"
                        ></span>
                    <a
                        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $active === 'Matkul' ? 'text-purple-600 bg-purple-100 dark:bg-purple-800' : '' }}"
                        href="{{ route('matkul.index') }}"
                    >
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                            ></path>
                        </svg>
                        <span class="ml-4">Kelola Mata Kuliah</span>
                    </a>
                </li>
                <li class="relative px-6 py-3  {{ $active === 'Transkrip' ? 'bg-white dark:bg-gray-700 rounded-lg shadow-md' : '' }}">
                        <span
                            class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ $active === 'Transkrip' ? '' : 'hidden' }}"
                            aria-hidden="true"
                        ></span>
                    <a
                    class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $active === 'Transkrip' ? 'text-purple-600 bg-purple-100 dark:bg-purple-800' : '' }}"
                    href="{{ route('transkrip.index') }}"
                    >
                    <svg
                        class="w-5 h-5"
                        aria-hidden="true"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                        ></path>
                    </svg>
                    <span class="ml-4">Kelola Transkrip Nilai</span>
                    </a>
                </li>
                <li class="relative px-6 py-3  {{ $active === 'rentanFuzzy' ? 'bg-white dark:bg-gray-700 rounded-lg shadow-md' : '' }}">
                  <span
                  class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ $active === 'rentanFuzzy' ? '' : 'hidden' }}"
                  aria-hidden="true"
                  ></span>
                  <a
                  class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $active === 'rentanFuzzy' ? 'text-purple-600 bg-purple-100 dark:bg-purple-800' : '' }}"
                  href="{{ route('fuzzyRange.index') }}"
                  >
                  <svg class="h-5 w-5 text-red-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="12" cy="12" r="2" />  <path d="M16.24 7.76a6 6 0 0 1 0 8.49m-8.48-.01a6 6 0 0 1 0-8.49m11.31-2.82a10 10 0 0 1 0 14.14m-14.14 0a10 10 0 0 1 0-14.14" /></svg>
                    <span class="ml-4">Kelola Fuzzy Range</span>
                    </a>
                </li>
                <li class="relative px-6 py-3 {{ $active === 'inference' ? 'bg-white dark:bg-gray-700 rounded-lg shadow-md' : '' }}">
                  <span
                      class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ $active === 'inference' ? '' : 'hidden' }}"
                      aria-hidden="true"
                  ></span>
                  <a
                      class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $active === 'inference' ? 'text-purple-600 bg-purple-100 dark:bg-purple-800' : '' }}"
                      href="{{ route('inference_rule.index') }}"
                  >
                      <svg
                          class="w-5 h-5"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                      >
                          <path
                              d="M12 8v4l3 3m-3-3H8m6 4h3a2 2 0 012 2v3a2 2 0 01-2 2H8a2 2 0 01-2-2v-3a2 2 0 012-2h3m6-8H8a2 2 0 00-2 2v1a2 2 0 002 2h6a2 2 0 002-2V6a2 2 0 00-2-2z"
                          ></path>
                      </svg>
                      <span class="ml-4">Aturan Inferensi</span>
                  </a>
                </li>
            </ul>
        </div>
        </aside>
        <!-- Mobile sidebar -->
        <!-- Backdrop -->
        <div
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
        ></div>
        <aside
        class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-gray-100 dark:bg-gray-800 md:hidden"
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20"
        @click.away="closeSideMenu"
        @keydown.escape="closeSideMenu"
        >
        <div class="py-4 text-gray-500 dark:text-gray-400">
            <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
            >
            ALMA ATA UNIVERSITY
            </a>
            <ul class="mt-6">
                <li class="relative px-6 py-3  {{ $active === 'Dashboard' ? 'bg-white dark:bg-gray-700 rounded-lg shadow-md' : '' }}">
                  <span
                  class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg
                  {{ $active === 'Dashboard' ? '' : 'hidden' }}"
                  aria-hidden="true"
                  ></span>
                  <a
                      class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100
                      {{ $active === 'Dashboard' ? 'text-purple-600 bg-purple-100 dark:bg-purple-800' : '' }}"
                      href="{{ route('admin.dashboard') }}"
                  >
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                            ></path>
                        </svg>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>
            </ul>
            <ul>
              <li class="relative text-sm px-6 py-2">
                Menu Kelola
              </li>
            </ul>
            <ul>
                <li class="relative px-6 py-3  {{ $active === 'Matkul' ? 'bg-white dark:bg-gray-700 rounded-lg shadow-md' : '' }}">
                  <span
                  class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ $active === 'Matkul' ? '' : 'hidden' }}"
                  aria-hidden="true"
                      ></span>
                  <a
                      class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $active === 'Matkul' ? 'text-purple-600 bg-purple-100 dark:bg-purple-800' : '' }}"
                      href="{{ route('matkul.index') }}"
                  >
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                            ></path>
                        </svg>
                        <span class="ml-4">Kelola Mata Kuliah</span>
                    </a>
                </li>
            <li class="relative px-6 py-3  {{ $active === 'Transkrip' ? 'bg-white dark:bg-gray-700 rounded-lg shadow-md' : '' }}">
              <span
              class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ $active === 'Transkrip' ? '' : 'hidden' }}"
              aria-hidden="true"
              ></span>
              <a
              class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $active === 'Transkrip' ? 'text-purple-600 bg-purple-100 dark:bg-purple-800' : '' }}"
              href="{{ route('transkrip.index') }}"
              >
                <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                    ></path>
                </svg>
                <span class="ml-4">Kelola Transkrip Nilai</span>
                </a>
            </li>
            <li class="relative px-6 py-3  {{ $active === 'rentanFuzzy' ? 'bg-white dark:bg-gray-700 rounded-lg shadow-md' : '' }}">
              <span
              class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ $active === 'rentanFuzzy' ? '' : 'hidden' }}"
              aria-hidden="true"
              ></span>
              <a
              class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $active === 'rentanFuzzy' ? 'text-purple-600 bg-purple-100 dark:bg-purple-800' : '' }}"
              href="{{ route('fuzzyRange.index') }}"
              >
              <svg class="h-5 w-5 text-red-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="12" cy="12" r="2" />  <path d="M16.24 7.76a6 6 0 0 1 0 8.49m-8.48-.01a6 6 0 0 1 0-8.49m11.31-2.82a10 10 0 0 1 0 14.14m-14.14 0a10 10 0 0 1 0-14.14" /></svg>
                <span class="ml-4">Kelola Fuzzy Range</span>
                </a>
            </li>
            <li class="relative px-6 py-3 {{ $active === 'inference' ? 'bg-white dark:bg-gray-700 rounded-lg shadow-md' : '' }}">
              <span
                  class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{ $active === 'inference' ? '' : 'hidden' }}"
                  aria-hidden="true"
              ></span>
              <a
                  class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $active === 'inference' ? 'text-purple-600 bg-purple-100 dark:bg-purple-800' : '' }}"
                  href="{{ route('inference_rule.index') }}"
              >
                  <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="none"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                  >
                      <path
                          d="M12 8v4l3 3m-3-3H8m6 4h3a2 2 0 012 2v3a2 2 0 01-2 2H8a2 2 0 01-2-2v-3a2 2 0 012-2h3m6-8H8a2 2 0 00-2 2v1a2 2 0 002 2h6a2 2 0 002-2V6a2 2 0 00-2-2z"
                      ></path>
                  </svg>
                  <span class="ml-4">Aturan Inferensi</span>
              </a>
            </li>
        </div>
        </aside>
        <div class="flex flex-col flex-1 w-full">
            <header class="z-10 py-4 bg-gray-100 shadow-md dark:bg-gray-800">
                <div
                  class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300"
                >
                  <!-- Mobile hamburger -->
                  <button
                    class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                    @click="toggleSideMenu"
                    aria-label="Menu"
                  >
                    <svg
                      class="w-6 h-6"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </button>
                  <div class="w-full flex justify-end">
                    <ul class="flex justify-end flex-shrink-0 space-x-6">
                      <!-- Theme toggler -->
                      <li class="flex">
                        <p class="text-md font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">Selamat datang, {{ $user->email }}</p>
                      </li>
                      <li class="flex">
                        <button
                          class="rounded-md focus:outline-none focus:shadow-outline-purple"
                          @click="toggleTheme"
                          aria-label="Toggle color mode"
                        >
                          <template x-if="!dark">
                            <svg
                              class="w-5 h-5"
                              aria-hidden="true"
                              fill="currentColor"
                              viewBox="0 0 20 20"
                            >
                              <path
                                d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                              ></path>
                            </svg>
                          </template>
                          <template x-if="dark">
                            <svg
                              class="w-5 h-5"
                              aria-hidden="true"
                              fill="currentColor"
                              viewBox="0 0 20 20"
                            >
                              <path
                                fill-rule="evenodd"
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                clip-rule="evenodd"
                              ></path>
                            </svg>
                          </template>
                        </button>
                      </li>
                      <!-- Profile menu -->
                      <li class="relative">
                        <button
                          class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                          @click="toggleProfileMenu"
                          @keydown.escape="closeProfileMenu"
                          aria-label="Account"
                          aria-haspopup="true"
                        >
                        <svg class="h-6 w-6 text-red-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />  <circle cx="12" cy="7" r="4" /></svg>
                        </button>
                        <template x-if="isProfileMenuOpen">
                          <ul
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            @click.away="closeProfileMenu"
                            @keydown.escape="closeProfileMenu"
                            class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                            aria-label="submenu"
                          >
                            <li class="flex">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                    <a
                                      class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                      href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    >
                                      <svg
                                        class="w-4 h-4 mr-3"
                                        aria-hidden="true"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                      >
                                        <path
                                          d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                                        ></path>
                                      </svg>
                                      <span>Log out</span>
                                    </a>
  
                            </li>
                          </ul>
                        </template>
                      </li>
                    </ul>
                  </div>
                </div>
              </header>
              <main class="h-full overflow-y-auto">
                <div class="container h-full dark:bg-gray-800 px-6 mx-auto grid">
                    @yield(
                        'container'
                    )
                </div>
              </main>
        </div>
    </div>
</body>
</html>
