<style>
    .custom-style {
        color: white;
        transition: color 0.3s ease-in-out;
    }

    .custom-style:hover {
        color: yellow;
    }

    .nav-link-container {
        padding: 0.1rem 0.5rem;
        /* Adjusted padding values */
        border-radius: 0.375rem;
        transition: background-color 0.3s ease-in-out;
    }

    .nav-link-container:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>



<nav x-data="{ open: false }" class="text-black bg-green-600 border-b">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex mr-4 items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('img/logo1.png') }}" class="block h-12 w-auto" alt=" {{ Auth::user()->name }}">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs(['dashboard', 'admin.userShow', 'admin.userEdit', 'admin.users'])" class="custom-style nav-link-container">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('messenger')" :active="request()->routeIs('messenger')" class="custom-style nav-link-container">
                        {{ __('Messenger') }}
                    </x-nav-link>

                    @if(Auth::user()->type == 'user')
                    <x-nav-link :href="route('admin.reportCreate')" :active="request()->routeIs(['admin.reportCreate', 'admin.reportShow', 'admin.reportEdit'])" class="custom-style nav-link-container">
                        {{ __('Complains') }}
                    </x-nav-link>
                    @endif

                    @if(Auth::user()->type == 'admin')
                    <x-nav-link :href="route('admin.reports')" :active="request()->routeIs(['admin.reports', 'admin.reportShow', 'admin.reportEdit', 'admin.reportCreate'])" class="custom-style nav-link-container">
                        {{ __('Complains') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.advertisement')" :active="request()->routeIs(['admin.advertisement', 'admin.advertisementShow', 'admin.advertisementEdit'])" class="custom-style nav-link-container">
                        {{ __('Advertisements') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.events')" :active="request()->routeIs(['admin.events', 'admin.eventsShow', 'admin.eventsEdit'])" class="custom-style nav-link-container">
                        {{ __('Events') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.news')" :active="request()->routeIs(['admin.news', 'admin.newsShow', 'admin.newsEdit'])" class="custom-style nav-link-container">
                        {{ __('News') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.statistics')" :active="request()->routeIs(['admin.statistics', 'admin.statisticsShow', 'admin.statisticsEdit'])" class="custom-style nav-link-container">
                        {{ __('Statistics') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.logs')" :active="request()->routeIs(['admin.logs', 'admin.logsShow', 'admin.logsEdit'])" class="custom-style nav-link-container">
                        {{ __('User Logs') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black bg-white hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <img class="h-6 w-6 rounded-full mr-1" src="{{ asset('img/man.png') }}" alt="{{ Auth::user()->name }}">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="nav-link">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                    this.closest('form').submit();" class="nav-link">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-link">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('messenger')" :active="request()->routeIs('messenger')" class="nav-link">
                {{ __('Messenger') }}
            </x-responsive-nav-link>

            @if(Auth::user()->type == 'user')
            <x-responsive-nav-link :href="route('admin.reportCreate')" :active="request()->routeIs(['admin.reportCreate', 'admin.reportShow', 'admin.reportEdit'])" class="nav-link">
                {{ __('Complains') }}
            </x-responsive-nav-link>
            @endif

            @if(Auth::user()->type == 'admin')
            <x-responsive-nav-link :href="route('admin.reports')" :active="request()->routeIs(['admin.reports', 'admin.reportShow', 'admin.reportEdit', 'admin.reportCreate'])" class="nav-link">
                {{ __('Complains') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.advertisement')" :active="request()->routeIs(['admin.advertisement', 'admin.advertisementShow', 'admin.advertisementsEdit'])" class="nav-link">
                {{ __('Advertisements') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.events')" :active="request()->routeIs(['admin.events', 'admin.eventsShow', 'admin.eventsEdit'])" class="nav-link">
                {{ __('Events') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.news')" :active="request()->routeIs(['admin.news', 'admin.newsShow', 'admin.newsEdit'])" class="nav-link">
                {{ __('News') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.statistics')" :active="request()->routeIs(['admin.statistics', 'admin.statisticsShow', 'admin.statisticsEdit'])" class="nav-link">
                {{ __('Statistics') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.logs')" :active="request()->routeIs(['admin.logs', 'admin.logsShow', 'admin.logsEdit'])" class="nav-link">
                {{ __('User Logs') }}
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="nav-link">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();" class="nav-link">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>