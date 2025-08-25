<div class="relative z-50 bg-white header-area default-header dark:bg-title">
    <div class="sticky py-2 text-sm text-center text-white top-0w-full bg-primary">
        As of today, our service is available around
        <span class="font-semibold">Valenzuela, Metro Manila</span>.
    </div>
    <div class="container-fluid">
        <div class="flex items-center justify-between gap-x-6 max-w-[1720px] mx-auto relative py-[10px] sm:py-4 lg:py-0">
            <a href="{{ route('home') }}" class="block cursor-pointer" aria-label="Furnixar">
                <img src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name') }}"
                    class="w-[120px] sm:w-[200px] filter dark:invert dark:brightness-0 dark:contrast-100">
            </a>
            <div
                class="main-menu absolute z-50 w-full lg:w-auto top-full left-0 lg:static bg-white dark:bg-title lg:bg-transparent lg:dark:bg-transparent px-5 sm:px-[30px] py-[10px] sm:py-5 lg:px-0 lg:py-0">
                <ul class="text-lg leading-none text-title dark:text-white lg:flex lg:gap-[30px]">
                    <li>
                        <a href="{{ route('home') }}"
                            class="sub-menu-item @if (request()->routeIs('home')) active @endif">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('shop') }}"
                            class="sub-menu-item @if (request()->routeIs('shop')) active @endif">Shop</a>
                    </li>
                    <li>
                        <a href="{{ route('contact-us') }}"
                            class="sub-menu-item @if (request()->routeIs('contact-us')) active @endif">Contact Us</a>
                    </li>
                    <li class="lg:hidden">
                        <a href="{{ route('auth.login') }}">
                            @auth('customer')
                                {{ auth('customer')->user()->name }}
                            @else
                                Login
                            @endauth
                        </a>
                    </li>
                </ul>
            </div>
            <div class="flex items-center gap-4 sm:gap-6">
                <a href="{{ route('auth.login') }}"
                    class="hidden text-lg leading-none transition-all duration-300 text-title dark:text-white hover:text-primary lg:block">
                    @auth('customer')
                        {{ auth('customer')->user()->name }}
                    @else
                        Login
                    @endauth
                </a>
                <a href="{{ route('customer.wishlist') }}" class="relative hdr_wishList_btn">
                    <livewire:components.layouts.includes.header-wishlist />
                </a>
                <a href="{{ route('customer.cart') }}" class="relative">
                    <livewire:components.layouts.includes.header-cart />
                </a>
                <button class="hamburger">
                    <svg class="stroke-current text-title dark:text-white" width="40" viewBox="0 0 100 100">
                        <path class="line line1"
                            d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
                        <path class="line line2" d="M 20,50 H 80" />
                        <path class="line line3"
                            d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
                    </svg>
                </button>

                <div class="w-[1px] bg-title/20 dark:bg-white/20 h-7 hidden sm:block"></div>
                <label class="order-first cursor-pointer switcher sm:order-last">
                    <input class="hidden" type="checkbox">
                    <img class="moon w-[22px] sm:w-7" src="{{ asset('sites/img/icon/simple-sun.svg') }}"
                        alt="moon">
                    <img class="sun w-[22px] sm:w-7" src="{{ asset('sites/img/icon/simple-light.svg') }}"
                        alt="sun">
                </label>
            </div>
        </div>
    </div>
</div>
