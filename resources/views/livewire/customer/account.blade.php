<div>
    <x-shop.section title="Account">
        <div
            class="max-w-[1720px] mx-auto flex items-start gap-8 md:gap-12 2xl:gap-24 flex-col md:flex-row my-profile-navtab">

            @include('livewire.customer.include.sidebar')

            <div class="w-full overflow-auto md:w-auto md:flex-1">
                <form class="w-full max-w-[951px] bg-[#F8F8F9] dark:bg-dark-secondary p-5 sm:p-8 lg:p-[50px]"
                    wire:submit="submitProfile">
                    <div class="flex flex-col items-start gap-5 lg:flex-row sm:gap-6">
                        <div class="grid w-full gap-5 sm:gap-6 lg:w-1/2">
                            <div>
                                <label
                                    class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                                    Name<span class="text-sm text-red-500 dark:text-red-400">*</span>
                                </label>
                                <input
                                    class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                                    type="text" placeholder="Enter your name" wire:model.lazy="name">
                                @error('name')
                                    <div class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <label
                                    class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                                    Email<span class="text-sm text-red-500 dark:text-red-400">*</span>
                                </label>
                                <input
                                    class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                                    type="email" placeholder="Enter your email" wire:model.lazy="email">
                                @error('email')
                                    <div class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="grid w-full gap-5 sm:gap-6 lg:w-1/2">
                            <div>
                                <label
                                    class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                                    Phone Number<span class="text-sm text-red-500 dark:text-red-400">*</span>
                                </label>
                                <input
                                    class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300 appearance-none"
                                    type="tel" placeholder="Type your phone number" wire:model.lazy="phone_number">
                                @error('phone_number')
                                    <div class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-8 md:mt-12">
                        <button type="submit" class="btn btn-solid" data-text="Save Change">
                            <span>Save Change</span>
                        </button>
                    </div>
                </form>

                <form class="w-full max-w-[951px] bg-[#F8F8F9] dark:bg-dark-secondary p-5 sm:p-8 lg:p-[50px] mt-3"
                    wire:submit="submitAddress">
                    <div class="flex flex-col items-start gap-5 sm:gap-6">
                        <div class="w-full">
                            <label
                                class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                                Address <span class="text-sm text-red-500 dark:text-red-400">*</span>
                            </label>
                            <input
                                class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                                type="address" placeholder="Enter your address" wire:model.lazy="address">
                            @error('address')
                                <div class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label
                                class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                                Location <span class="text-sm text-gray-500">(Drag the pin to your location)</span>
                            </label>
                            <div id="map" class="h-96 w-full" wire:ignore></div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-8 md:mt-12">
                        <button type="submit" class="btn btn-solid" data-text="Save Change">
                            <span>Save Change</span>
                        </button>
                    </div>
                </form>

                <form class="w-full max-w-[951px] bg-[#F8F8F9] dark:bg-dark-secondary p-5 sm:p-8 lg:p-[50px] mt-3"
                    wire:submit="resetPassword">
                    <div class="flex flex-col items-start gap-5 lg:flex-row sm:gap-6">
                        <div class="grid w-full gap-5 sm:gap-6 lg:w-1/2">
                            <div>
                                <label
                                    class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                                    Old Password
                                </label>
                                <input
                                    class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300"
                                    type="password" placeholder="* * * * * * * *" wire:model="old_password"
                                    autocomplete>
                                @error('old_password')
                                    <div class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="grid w-full gap-5 sm:gap-6 lg:w-1/2">
                            <div>
                                <label
                                    class="block mb-2 text-base leading-none md:text-lg text-title dark:text-white sm:mb-3">
                                    New Password
                                </label>
                                <input
                                    class="w-full h-12 md:h-14 bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-title dark:text-white focus:border-primary p-4 outline-none duration-300 appearance-none"
                                    type="password" placeholder="* * * * * * * *" wire:model="new_password"
                                    autocomplete>
                                @error('new_password')
                                    <div class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-8 md:mt-12">
                        <button type="submit" class="btn btn-solid" data-text="Save Change">
                            <span>Save Change</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
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
            key: "AIzaSyCPLob2osj6xKDVQkMBxjWOaeJTuKtVmEI",
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
                    <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
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
                    <div class="bg-red-100 dark:bg-red-400 p-4 rounded">
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
