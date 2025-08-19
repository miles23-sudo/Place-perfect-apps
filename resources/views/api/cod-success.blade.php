<x-layouts.app>
    <x-shop.section title="Payment Success">
        <div class="max-w-[710px] mx-auto text-center bg-success dark:bg-dark-secondary p-7 sm:p-10 lg:p-12">

            <div class="flex items-center justify-center mx-auto">
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M30.0099 3.76465C44.5049 3.76465 56.2601 15.5198 56.2601 30.0148C56.2601 44.5098 44.5049 56.265 30.0099 56.265C15.5149 56.265 3.75977 44.5098 3.75977 30.0148C3.75977 15.5198 15.5149 3.76465 30.0099 3.76465ZM24.5588 38.5411L18.1321 32.1091C17.0372 31.0135 17.037 29.227 18.1321 28.1317C19.2274 27.0366 21.0219 27.0435 22.1092 28.1317L26.64 32.666L37.911 21.395C39.0064 20.2997 40.7931 20.2997 41.8882 21.395C42.9835 22.4901 42.982 24.2784 41.8882 25.3721L28.6254 38.635C27.5316 39.7287 25.7433 39.7303 24.6482 38.635C24.6174 38.6042 24.5878 38.5729 24.5588 38.5411Z"
                        fill="#49B66E" />
                </svg>
            </div>
            <div class="leading-[1.2] mt-4 md:mt-6 text-2xl md:text-[32px] font-bold text-title dark:text-white">
                Order Successfully Placed
            </div>
            <div class="mt-6 text-3xl font-bold text-green-600 md:text-4xl dark:text-white">
                <b>Order #: {{ $order_number }}</b>
            </div>
            <div class="mt-3 text-base sm:text-lg text-paragraph dark:text-white">
                Your order has been successfully submitted and is currently being prepared for delivery. You will pay
                upon delivery.
            </div>
            <div class="p-4 mt-6 text-left border-l-4 rounded-lg bg-amber-50 dark:bg-amber-900/20 border-amber-400">
                <h4 class="mb-2 font-semibold text-amber-800 dark:text-amber-200">Important COD Instructions:</h4>
                <div class="space-y-1 text-sm text-amber-700 dark:text-amber-300">
                    <p>• Have the <strong>exact cash amount</strong> ready upon delivery</p>
                    <p>• Our team will call you before delivery</p>
                    <p>• You may inspect the items before payment</p>
                    <p>• Keep your order number: <strong>{{ $order_number }}</strong></p>
                </div>
            </div>
            <a href="{{ App\Filament\Customer\Resources\OrderResource::getUrl(panel: 'customer') }}"
                class="mt-4 btn btn-solid md:mt-6" data-text="View Order">
                <span>
                    View Order
                </span>
            </a>
        </div>
    </x-shop.section>
</x-layouts.app>
