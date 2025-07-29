<div class="header-area default-header relative z-50 bg-white dark:bg-title">
    <div class="container-fluid">
        <div class="flex items-center justify-between gap-x-6 max-w-[1720px] mx-auto relative py-[10px] sm:py-4 lg:py-0">
            <a href="{{ route('home') }}" class="cursor-pointer block" aria-label="Furnixar">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo"
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
                        <a href="{{ route('filament.customer.auth.login') }}">Login</a>
                    </li>
                </ul>
            </div>
            <div class="flex items-center gap-4 sm:gap-6">
                <a href="{{ route('filament.customer.auth.login') }}"
                    class="text-lg leading-none text-title dark:text-white transition-all duration-300 hover:text-primary hidden lg:block">Login</a>
                <a href="#" class="relative">
                    <span
                        class="absolute w-[22px] h-[22px] bg-secondary -top-[10px] -right-[11px] rounded-full flex items-center justify-center text-xs leading-none text-white">14</span>
                    <svg class="fill-current text-title dark:text-white w-[22px] sm:w-[25px]" viewBox="0 0 25 21"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17.9005 0.591797C15.9541 0.591797 14.2479 1.45969 12.9662 3.10171C12.7953 3.3207 12.6429 3.53979 12.5079 3.75198C12.3728 3.53974 12.2205 3.3207 12.0496 3.10171C10.7679 1.45969 9.06162 0.591797 7.11524 0.591797C3.43837 0.591797 0.808594 3.67049 0.808594 7.36477C0.808594 11.589 4.27071 15.5701 12.0343 20.2733C12.1798 20.3614 12.3439 20.4055 12.5079 20.4055C12.6719 20.4055 12.8359 20.3615 12.9815 20.2733C20.7451 15.5702 24.2072 11.589 24.2072 7.36482C24.2072 3.67246 21.5795 0.591797 17.9005 0.591797ZM19.9642 12.6247C18.3479 14.4281 15.9055 16.327 12.5079 18.4205C9.11029 16.327 6.66784 14.4281 5.05155 12.6247C3.42654 10.8115 2.63661 9.09096 2.63661 7.36482C2.63661 4.70487 4.43419 2.41981 7.11524 2.41981C8.48059 2.41981 9.64476 3.01346 10.5754 4.1843C11.3196 5.12066 11.6332 6.08754 11.6354 6.09444C11.7544 6.47626 12.108 6.73634 12.5079 6.73634C12.9079 6.73634 13.2614 6.47631 13.3805 6.09444C13.3834 6.08521 13.6875 5.14849 14.4072 4.22644C15.3429 3.02762 16.5183 2.41976 17.9005 2.41976C20.5844 2.41976 22.3792 4.70702 22.3792 7.36477C22.3792 9.09092 21.5892 10.8114 19.9642 12.6247Z" />
                    </svg>
                </a>
                <a href="#" class="relative">
                    <span
                        class="absolute w-[22px] h-[22px] bg-secondary -top-[10px] -right-[11px] rounded-full flex items-center justify-center text-xs leading-none text-white">22</span>
                    <svg class="fill-current text-title dark:text-white w-[18px] sm:w-[19px]" viewBox="0 0 19 23"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17.8284 5.7238H15.2408C14.9035 2.85886 12.4608 0.628906 9.50675 0.628906C6.55269 0.628906 4.11002 2.85886 3.7727 5.7238H1.18509C0.716102 5.7238 0.335938 6.10397 0.335938 6.57295V21.518C0.335938 21.987 0.716102 22.3671 1.18509 22.3671H17.8284C18.2974 22.3671 18.6776 21.987 18.6776 21.518V6.57295C18.6776 6.10397 18.2974 5.7238 17.8284 5.7238ZM9.50675 2.3272C11.5228 2.3272 13.2014 3.79857 13.5257 5.7238H5.48777C5.81214 3.79857 7.4907 2.3272 9.50675 2.3272ZM16.9793 20.6688H2.03424V7.4221H3.73253V9.96955C3.73253 10.4385 4.1127 10.8187 4.58168 10.8187C5.05067 10.8187 5.43083 10.4385 5.43083 9.96955V7.4221H13.5827V9.96955C13.5827 10.4385 13.9628 10.8187 14.4318 10.8187C14.9008 10.8187 15.281 10.4385 15.281 9.96955V7.4221H16.9793V20.6688Z" />
                    </svg>
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
                <label class="switcher cursor-pointer order-first sm:order-last">
                    <input class="hidden" type="checkbox">
                    <img class="moon w-[22px] sm:w-7" src="{{ asset('sites/img/icon/simple-sun.svg') }}" alt="moon">
                    <img class="sun w-[22px] sm:w-7" src="{{ asset('sites/img/icon/simple-light.svg') }}"
                        alt="sun">
                </label>
            </div>
        </div>
    </div>
</div>
