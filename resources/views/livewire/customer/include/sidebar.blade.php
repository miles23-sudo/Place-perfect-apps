<div class="w-full md:w-[200px] lg:w-[300px] flex-none">
    <ul
        class="flex flex-col justify-center text-base leading-none divide-y dark:divide-paragraph text-title dark:text-white sm:text-lg lg:text-xl">
        <li class="pb-3 pl-6 lg:pb-6 lg:pl-12 @if (request()->routeIs('customer.account')) active text-primary @endif">
            <a class="duration-300 hover:text-primary" href="{{ route('customer.account') }}">Account</a>
        </li>
        <li class="py-3 pl-6 lg:py-6 lg:pl-12 @if (request()->routeIs('customer.order')) active text-primary @endif">
            <a class="duration-300 hover:text-primary" href="{{ route('customer.order') }}">Order</a>
        </li>
        <li class="py-3 pl-6 lg:py-6 lg:pl-12 @if (request()->routeIs('customer.wishlist')) active text-primary @endif">
            <a class="duration-300 hover:text-primary" href="{{ route('customer.wishlist') }}">Wishlist</a>
        </li>
        <li class="pt-3 pl-6 lg:pt-6 lg:pl-12">
            <livewire:auth.logout />
        </li>
    </ul>
</div>
