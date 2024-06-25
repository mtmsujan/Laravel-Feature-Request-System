<header class="bg-header_bg">
    <div class="container mx-auto py-3 px-3">
        <div class="header_wraper flex justify-between">
            <div class="flex text-header_text items-center gap-6">
                <a href="/" class="">
                    <img class="logo aspect-w-1.6 aspect-h-1 max-h-16 md:max-h-20 p-0" src="{{ app('logo') }}"
                        alt="Company Logo"></a>
                <a href="/">Feedback</a>
                {{-- <a href="#" class="opacity-70">Changelog</a> --}}
            </div>
            <div class="flex items-center gap-4 text-header_text">
                <a href="/" rel="nofollow noopener" class="hidden min-768:flex gap-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-[15px]">
                        <title>Link</title>
                        <path d="M208 352h-64a96 96 0 010-192h64M304 160h64a96 96 0 010 192h-64M163.29 256h187.42"
                            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="36"></path>
                    </svg>
                    <span class="text-sm">
                        <span>Back to</span>
                        Roadmap
                    </span>
                </a>

                <!-- User -->
                <div class="user">
                    <!-- Modal toggle -->
                    <button class="profile text-header_text"
                        @if (auth()->user()?->is_admin) data-dropdown-toggle="dropdownAvatar"
                       @else
                       data-modal-target="top-left-modal"
                        data-modal-toggle="top-left-modal" @endif
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                            class="ionicon w-[30px] fill-header_text cursor-pointer">
                            <title>Person Circle</title>
                            <path
                                d="M258.9 48C141.92 46.42 46.42 141.92 48 258.9c1.56 112.19 92.91 203.54 205.1 205.1 117 1.6 212.48-93.9 210.88-210.88C462.44 140.91 371.09 49.56 258.9 48zm126.42 327.25a4 4 0 01-6.14-.32 124.27 124.27 0 00-32.35-29.59C321.37 329 289.11 320 256 320s-65.37 9-90.83 25.34a124.24 124.24 0 00-32.35 29.58 4 4 0 01-6.14.32A175.32 175.32 0 0180 259c-1.63-97.31 78.22-178.76 175.57-179S432 158.81 432 256a175.32 175.32 0 01-46.68 119.25z">
                            </path>
                            <path
                                d="M256 144c-19.72 0-37.55 7.39-50.22 20.82s-19 32-17.57 51.93C191.11 256 221.52 288 256 288s64.83-32 67.79-71.24c1.48-19.74-4.8-38.14-17.68-51.82C293.39 151.44 275.59 144 256 144z">
                            </path>
                        </svg>
                    </button>
                    @if (auth()->user()?->is_admin)
                        <!-- Dropdown menu -->
                        <div id="dropdownAvatar"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <div class="px-4 py-3 text-sm text-gray-900 dark:text-header_text">
                                <div>{{ auth()->user()?->name }}</div>
                                <div class="font-medium">{{ auth()->user()?->email }}</div>
                            </div>
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownUserAvatarButton">
                                {{-- <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-header_text">Dashboard</a>
                        </li> --}}
                                <li>
                                    <a href="{{ route('settings') }}"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-header_text">Settings</a>
                                </li>
                            </ul>
                            <div class="py-2">
                                <form action="{{ route('logout') }}" method="get">
                                    <button
                                        class="w-full text-start block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-header_text">Sign
                                        out</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
