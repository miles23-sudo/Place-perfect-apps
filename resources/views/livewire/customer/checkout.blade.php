<div>
    <x-shop.section title="Checkout">
        <form class="max-w-[1220px] mx-auto grid lg:grid-cols-2 gap-[30px] lg:gap-[70px]" wire:submit="processCheckout">
            <div
                class="bg-[#FAFAFA] dark:bg-dark-secondary p-[30px] md:p-[40px] lg:p-[50px] border border-[#17243026] border-opacity-15 rounded-xl">
                <h4 class="font-semibold leading-none text-xl md:text-2xl mb-6 md:mb-[30px]">
                    Billing Information
                </h4>
                <div class="grid gap-5 md:gap-6">
                    <div>
                        <label class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                            Name<span class="text-sm text-red-500 dark:text-red-400">*</span>
                        </label>
                        <input
                            class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                            type="text" placeholder="Enter your name" wire:model="name">
                        @error('name')
                            <div class="mt-1 text-sm text-red-600 dark:text-red-400">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                            Email<span class="text-sm text-red-500 dark:text-red-400">*</span>
                        </label>
                        <input
                            class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                            type="email" placeholder="Enter your email address" wire:model="email">
                        @error('email')
                            <div class="mt-1 text-sm text-red-600 dark:text-red-400">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                            Phone Number<span class="text-sm text-red-500 dark:text-red-400">*</span>
                        </label>
                        <input
                            class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                            type="tel" placeholder="Type your phone number" wire:model="phone_number">
                        @error('phone_number')
                            <div class="mt-1 text-sm text-red-600 dark:text-red-400">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                            Address<span class="text-sm text-red-500 dark:text-red-400">*</span>
                        </label>
                        <input
                            class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                            type="text" placeholder="Your full address" wire:model="address">
                        @error('address')
                            <div class="mt-1 text-sm text-red-600 dark:text-red-400">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                            Location <span class="text-sm text-gray-500">(Drag the pin to your location)</span>
                        </label>
                        <div id="map" class="w-full h-96" wire:ignore></div>
                    </div>
                    <div>
                        <label class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                            Additional Notes
                        </label>
                        <textarea
                            class="w-full h-[120px] bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                            placeholder="Type your note" wire:model="additional_notes"></textarea>
                        @error('additional_notes')
                            <div class="mt-1 text-sm text-red-600 dark:text-red-400">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div>
                <div
                    class="bg-[#FAFAFA] dark:bg-dark-secondary pt-[30px] md:pt-[40px] lg:pt-[50px] px-[30px] md:px-[40px] lg:px-[50px] pb-[30px] border border-[#17243026] border-opacity-15 rounded-xl">
                    <h4 class="mb-6 text-xl font-semibold leading-none md:text-2xl md:mb-10">
                        Product Information
                    </h4>
                    <div class="grid gap-5 mg:gap-6">
                        @foreach ($this->cartItems as $item)
                            <div class="flex items-center justify-between gap-5">
                                <div class="flex flex-wrap items-center gap-3 md:gap-4 lg:gap-6 cart-product">
                                    <div class="w-16 sm:w-[70px] flex-none">
                                        <img src="{{ asset('storage/' . $item->product->images[0]) }}" alt="product">
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="text-lg font-medium leading-none">
                                            {{ $item->product->productCategory->name }}</h6>
                                        <h5 class="mt-2 text-xl font-semibold leading-none">
                                            <a href="#">{{ $item->product->name }}</a>
                                        </h5>
                                    </div>
                                </div>
                                <h6 class="text-lg font-bold leading-none">{{ $item->quantity }} x ₱{{ $item->price }}
                                </h6>
                            </div>
                        @endforeach
                    </div>
                    <div
                        class="flex flex-col justify-end w-full pt-6 mt-6 ml-auto mr-0 text-right border-t border-bdr-clr dark:border-bdr-clr-drk">
                        <div
                            class="flex flex-wrap justify-between text-base font-medium sm:text-lg text-title dark:text-white">
                            <span>Sub Total:</span>
                            <span>₱{{ $this->cartItems->sum('total') }}</span>
                        </div>
                    </div>
                    <div
                        class="flex flex-col justify-end w-full pt-6 mt-6 ml-auto mr-0 text-right border-t border-bdr-clr dark:border-bdr-clr-drk">
                        <div
                            class="flex flex-wrap justify-between text-base font-medium sm:text-lg text-title dark:text-white">
                            <span>Shipping Fee</span>
                            <span>₱{{ $this->shippingFee }}</span>
                        </div>
                    </div>
                    <div class="pt-6 mt-6 border-t border-bdr-clr dark:border-bdr-clr-drk">
                        <div class="flex flex-wrap justify-between text-2xl font-semibold leading-none md:text-3xl">
                            <span>Total:</span>
                            <span>₱{{ $this->overallTotal }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-7 md:mt-12">
                    <h4 class="mb-6 text-xl font-semibold leading-none md:text-2xl md:mb-10">
                        Payment Method<span class="text-sm text-red-500 dark:text-red-400">*</span>
                    </h4>
                    <div class="flex flex-wrap gap-5 mb-5 sm:gap-8 md:gap-12">
                        @foreach ($payment_modes as $mode)
                            <div>
                                <label class="flex items-center gap-[10px] categoryies-iteem">
                                    <input class="hidden appearance-none" type="radio" name="payment-mode"
                                        wire:model.lazy="payment_mode" value="{{ $mode }}">
                                    <span
                                        class="flex items-center justify-center w-4 h-4 duration-300 border rounded-full border-title dark:border-white">
                                        <svg class="duration-300 opacity-0" width="8" height="8"
                                            viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="10" height="10" rx="5" fill="#BB976D" />
                                        </svg>
                                    </span>
                                    <span
                                        class="sm:text-lg text-title dark:text-white block sm:leading-none transform translate-y-[3px] select-none">
                                        {{ $mode->getLabel() }}
                                    </span>
                                </label>
                                <p class="ml-6 text-[15px] leading-none mt-2">
                                    {{ $mode->getDescription() }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                    @error('payment_mode')
                        <div class="mt-1 text-sm text-red-600 dark:text-red-400">
                            {{ $message }}
                        </div>
                    @enderror

                    @if (\App\Enums\OrderPaymentMode::Online->value == $payment_mode)
                        <div
                            class="bg-[#FAFAFA] dark:bg-dark-secondary pt-6 md:pt-10 lg:pt-12 px-6 md:px-10 lg:px-12 pb-6 border border-[#17243026] border-opacity-15 rounded-xl">
                            <h4 class="mb-6 text-xl font-semibold leading-none md:text-2xl md:mb-10">
                                Select & Upload Payment Proof <span
                                    class="text-sm text-red-500 dark:text-red-400">*</span>
                            </h4>

                            <div class="grid gap-4 sm:grid-cols-2">
                                @foreach ($payment_channels as $channel)
                                    <label class="block cursor-pointer">
                                        <input type="radio" name="payment_channel" value="{{ $channel['name'] }}"
                                            class="sr-only peer" wire:model='payment_channel' />
                                        <div
                                            class="group relative flex items-center gap-3 sm:gap-4 p-3 sm:p-4 rounded-lg sm:rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm hover:shadow-md transition-all duration-200 ease-in-out hover:border-[#bb976d]/50 dark:hover:border-[#bb976d]/50 hover:bg-gray-50 dark:hover:bg-gray-750 peer-checked:border-[#bb976d] peer-checked:bg-[#bb976d] peer-checked:text-white peer-checked:shadow-lg peer-focus:ring-2 peer-focus:ring-[#bb976d]/20">
                                            <img src="{{ asset('storage/' . $channel['logo']) }}"
                                                alt="{{ $channel['name'] }}"
                                                class="w-8 h-8 rounded-md sm:w-10 sm:h-10 object-containflex-shrink-0">
                                            <div class="flex-1 min-w-0">
                                                <p
                                                    class="text-sm font-semibold text-gray-900 truncate sm:text-base dark:text-gray-100 peer-checked:text-white">
                                                    {{ $channel['name'] }}
                                                </p>
                                                <p
                                                    class="text-xs text-gray-600 truncate sm:text-sm dark:text-gray-200 peer-checked:text-white/90">
                                                    {{ $channel['account_number'] }}
                                                </p>
                                            </div>

                                            <div
                                                class="flex items-center justify-center flex-shrink-0 w-4 h-4 border-2 border-gray-300 rounded-full sm:w-5 sm:h-5 dark:border-gray-600 peer-checked:border-white peer-checked:bg-white">
                                                <div
                                                    class="w-2 h-2 rounded-full bg-[#bb976d] opacity-0 peer-checked:opacity-100 transition-opacity duration-200">
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @error('payment_channel')
                                <div class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mt-5" x-data="{ fileName: '' }">
                                <input type="file" wire:model="payment_proof" accept="image/*" class="hidden"
                                    id="payment_proof" @change="fileName = $event.target.files[0]?.name"
                                    wire:model='payment_proof' />
                                <label for="payment_proof"
                                    class="flex flex-col items-center justify-center w-full p-4 border border-gray-300 border-dashed rounded-lg cursor-pointer">
                                    <span class="text-gray-600 dark:text-gray-400" x-show="!fileName">
                                        Upload Payment Proof
                                    </span>
                                    <span class="font-medium text-gray-800 dark:text-gray-400" x-show="fileName"
                                        x-text="fileName"></span>
                                </label>
                                <div wire:loading wire:target="payment_proof">Uploading...</div>
                                @error('payment_proof')
                                    <div class="mt-1 text-sm text-red-600 dark:text-red-400">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                    @endif

                    <div class="flex flex-wrap gap-3 mt-4 md:mt-6">
                        <a href="{{ route('customer.cart') }}" class="btn btn-outline" data-text="Back to Cart">
                            <span>Back to Cart</span>
                        </a>
                        <button type="submit"
                            class="btn btn-sm btn-theme-solid !text-white hover:!text-primary before:!z-[-1]"
                            wire:loading.attr="disabled" wire:target="processCheckout, payment_proof">
                            <p class="m-0" wire:loading.remove wire:target="processCheckout">
                                Proceed Checkout
                            </p>
                            <p class="m-0" wire:loading wire:target="processCheckout">
                                Processing...
                            </p>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </x-shop.section>
</div>
@script
    <script>
        (g => {
            var h, a, k, p = "The Google Maps JavaScript API",
                c = "google",
                l = "importLibrary",
                q = "__ib__",
                m = document,
                b = window;
            b = b[c] || (b[c] = {});
            var d = b.maps || (b.maps = {}),
                r = new Set,
                e = new URLSearchParams,
                u = () => h || (h = new Promise(async (f, n) => {
                    await (a = m.createElement("script"));
                    e.set("libraries", [...r] + "");
                    for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                    e.set("callback", c + ".maps." + q);
                    a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                    d[q] = f;
                    a.onerror = () => h = n(Error(p + " could not load."));
                    a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                    m.head.append(a)
                }));
            d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(
                () => d[l](f, ...n))
        })
        ({
            key: "{{ config('filament-google-maps.key') }}",
            v: "weekly"
        });

        async function initMap() {
            const {
                Map,
                InfoWindow
            } = await google.maps.importLibrary("maps");
            const {
                AdvancedMarkerElement
            } = await google.maps.importLibrary("marker");
            const geocoder = new google.maps.Geocoder();

            const hasExistingLocation = {{ $latitude && $longitude && $address ? 'true' : 'false' }};

            const defaultLocation = {
                lat: {{ $latitude ?? 14.682824 }},
                lng: {{ $longitude ?? 120.981573 }}
            };

            const map = new Map(document.getElementById('map'), {
                center: defaultLocation,
                zoom: 17,
                mapId: '4504f8b37365c3d0',
            });

            const infoWindow = new InfoWindow();
            let draggableMarker = new AdvancedMarkerElement({
                map,
                position: defaultLocation,
                gmpDraggable: true
            });

            function geocodeLatLng(geocoder, lat, lng) {
                geocoder.geocode({
                    location: {
                        lat,
                        lng
                    }
                }, (results, status) => {
                    if (status === "OK" && results[0]) {
                        const address = results[0].formatted_address;

                        infoWindow.close();
                        infoWindow.setContent(`
                    <div class="p-4 bg-white rounded shadow dark:bg-gray-800">
                        <strong>Address:</strong><br>
                        ${address}<br><br>
                        <strong>Coordinates:</strong><br>
                        ${lat.toFixed(6)}, ${lng.toFixed(6)}
                    </div>
                `);
                        infoWindow.setPosition({
                            lat,
                            lng
                        });
                        infoWindow.open(map, draggableMarker);

                        $wire.set('address', address);
                        $wire.set('latitude', lat);
                        $wire.set('longitude', lng);

                        console.log('Address:', address);
                        console.log('Coordinates:', lat, lng);
                    } else {
                        console.log("Geocoding failed:", status);

                        infoWindow.close();
                        infoWindow.setContent(`
                    <div class="p-4 bg-red-100 rounded dark:bg-red-400">
                        <strong>Location:</strong><br>
                        ${lat.toFixed(6)}, ${lng.toFixed(6)}<br>
                        <em>Address not found</em>
                    </div>
                `);
                        infoWindow.setPosition({
                            lat,
                            lng
                        });
                        infoWindow.open(map, draggableMarker);
                    }
                });
            }

            function setCurrentLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            const pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude,
                            };

                            map.setCenter(pos);
                            draggableMarker.position = pos;
                            geocodeLatLng(geocoder, pos.lat, pos.lng);
                        },
                        () => {
                            console.log("Geolocation failed, using default location");
                            geocodeLatLng(geocoder, defaultLocation.lat, defaultLocation.lng);
                        }
                    );
                } else {
                    console.log("Browser doesn't support geolocation");
                    geocodeLatLng(geocoder, defaultLocation.lat, defaultLocation.lng);
                }
            }

            draggableMarker.addListener('dragend', () => {
                const position = draggableMarker.position;
                geocodeLatLng(geocoder, position.lat, position.lng);
            });

            // 👇 Only auto-fetch current location if no saved address/lat/lng
            if (!hasExistingLocation) {
                setCurrentLocation();
            } else {
                // still show info window for saved location
                geocodeLatLng(geocoder, defaultLocation.lat, defaultLocation.lng);
            }
        }

        initMap();
    </script>
@endscript
