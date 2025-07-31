<div>
    <x-shop.section :title="$this->product->name">
        <div class="max-w-[1720px] mx-auto flex justify-between gap-10 flex-col lg:flex-row" wire:ignore>
            <div class="w-full lg:w-[58%]">
                <div class="relative product-dtls-wrapper">
                    <button
                        class="absolute top-5 left-0 p-2 bg-[#E13939] text-lg leading-none text-white font-medium z-50">-10%</button>
                    <div class="product-dtls-slider ">
                        <div><img src="{{ asset('sites/img/gallery/product-detls/product-01.jpg') }}" class="w-full"
                                alt="product"></div>
                        <div><img src="{{ asset('sites/img/gallery/product-detls/product-02.jpg') }}" alt="product">
                        </div>
                        <div><img src="{{ asset('sites/img/gallery/product-detls/product-03.jpg') }}" alt="product">
                        </div>
                        <div><img src="{{ asset('sites/img/gallery/product-detls/product-04.jpg') }}" alt="product">
                        </div>
                        <div><img src="{{ asset('sites/img/gallery/product-detls/product-01.jpg') }}" alt="product">
                        </div>
                        <div><img src="{{ asset('sites/img/gallery/product-detls/product-02.jpg') }}" alt="product">
                        </div>
                    </div>
                    <div class="product-dtls-nav">
                        <div><img src="{{ asset('sites/img/gallery/product-detls/product-01.jpg') }}" alt="product">
                        </div>
                        <div><img src="{{ asset('sites/img/gallery/product-detls/product-02.jpg') }}" alt="product">
                        </div>
                        <div><img src="{{ asset('sites/img/gallery/product-detls/product-03.jpg') }}" alt="product">
                        </div>
                        <div><img src="{{ asset('sites/img/gallery/product-detls/product-04.jpg') }}" alt="product">
                        </div>
                        <div><img src="{{ asset('sites/img/gallery/product-detls/product-01.jpg') }}" alt="product">
                        </div>
                        <div><img src="{{ asset('sites/img/gallery/product-detls/product-02.jpg') }}" alt="product">
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:max-w-[635px] w-full">
                <div class="pb-4 sm:pb-6 border-b border-bdr-clr dark:border-bdr-clr-drk">
                    <h2 class="font-semibold leading-none md:text-4xl">
                        {{ $this->product->name }}
                    </h2>
                    <div class="flex gap-4 items-center mt-[15px]">
                        <span class="text-2xl sm:text-3xl text-primary leading-none block">
                            {{ $this->product->price_with_currency_symbol }}
                        </span>
                    </div>

                    <p class="sm:text-lg mt-5 md:mt-7">
                        {!! str($this->product->short_description)->markdown() !!}
                    </p>
                </div>
                <div class="py-4 sm:py-6 border-b border-bdr-clr dark:border-bdr-clr-drk" data-aos="fade-up"
                    data-aos-delay="200" x-data="{ quantity: 1 }">
                    <div class="inc-dec flex items-center gap-2">
                        <button type="button"
                            class="w-8 h-8 bg-[#E8E9EA] dark:bg-dark-secondary flex items-center justify-center"
                            @click="quantity = quantity > 1 ? quantity - 1 : 1">
                            <svg class="fill-current text-title dark:text-white" width="14" height="2"
                                viewBox="0 0 14 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.4361 0.203613H12.0736L7.81774 0.203615H13.8729V1.80309H7.81774L3.50809 1.80309H1.87053L6.18017 1.80309H0.125V0.203615H6.18017L10.4361 0.203613Z" />
                            </svg>
                        </button>
                        <input
                            class="w-6 h-auto outline-none bg-transparent text-base mg:text-lg leading-none text-title dark:text-white text-center"
                            type="number" x-model.number="quantity">
                        <button type="button"
                            class="w-8 h-8 bg-[#E8E9EA] dark:bg-dark-secondary flex items-center justify-center"
                            @click="quantity++">
                            <svg class="fill-current text-title dark:text-white" width="14" height="14"
                                viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.18017 0.110352H7.81774V6.16553H13.8729V7.76501H7.81774V13.8963H6.18017V7.76501H0.125V6.16553H6.18017V0.110352Z" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex gap-4 mt-4 sm:mt-6">
                        <button type="button"
                            class="btn btn-sm btn-theme-solid !text-white hover:!text-primary before:!z-[-1]"
                            @click="$wire.set('quantity', quantity); $wire.call('addToCart', quantity)">
                            <p class="m-0" wire:loading.remove wire:target="addToCart">
                                Add to Cart
                            </p>
                            <p class="m-0" wire:loading wire:target="addToCart">
                                Adding...
                            </p>
                        </button>
                        <button type="button" class="btn btn-outline" data-text="Add to Wishlist">
                            <span>Add to Wishlist</span>
                        </button>
                        <button type="button" class="btn btn-outline" data-text="View in AR">
                            <span>View in AR</span>
                        </button>
                    </div>
                </div>
                <div class="py-4 sm:py-6 border-b border-bdr-clr dark:border-bdr-clr-drk" data-aos="fade-up"
                    data-aos-delay="300">
                    <div class="flex gap-x-12 gap-y-3 flex-wrap">
                        <h6 class="leading-none font-medium text-lg">Category : Chair</h6>
                    </div>
                    <div class="flex gap-x-12 lg:gap-x-24 gap-y-3 flex-wrap mt-5 sm:mt-10">
                        <div class="flex gap-[10px] items-center">
                            <h6 class="leading-none font-medium text-lg">Size :</h6>
                            <div class="flex gap-[10px]">
                                <label class="product-size">
                                    <input class="appearance-none hidden" type="radio" name="size" checked>
                                    <span
                                        class="w-6 h-6 flex items-center justify-center pt-[2px] text-sm leading-none bg-[#E8E9EA] dark:bg-dark-secondary text-title dark:text-white duration-300">S</span>
                                </label>
                                <label class="product-size">
                                    <input class="appearance-none hidden" type="radio" name="size">
                                    <span
                                        class="w-6 h-6 flex items-center justify-center pt-[2px] text-sm leading-none bg-[#E8E9EA] dark:bg-dark-secondary text-title dark:text-white duration-300">M</span>
                                </label>
                                <label class="product-size">
                                    <input class="appearance-none hidden" type="radio" name="size">
                                    <span
                                        class="w-6 h-6 flex items-center justify-center pt-[2px] text-sm leading-none bg-[#E8E9EA] dark:bg-dark-secondary text-title dark:text-white duration-300">L</span>
                                </label>
                                <label class="product-size">
                                    <input class="appearance-none hidden" type="radio" name="size">
                                    <span
                                        class="w-6 h-6 flex items-center justify-center pt-[2px] text-sm leading-none bg-[#E8E9EA] dark:bg-dark-secondary text-title dark:text-white duration-300">XL</span>
                                </label>
                            </div>
                        </div>
                        <div class="flex gap-[10px] items-center">
                            <h6 class="leading-none font-medium text-lg">Color :</h6>
                            <div class="flex gap-[10px] items-center">
                                <label class="product-color">
                                    <input class="appearance-none hidden" type="radio" name="color">
                                    <span
                                        class="border border-[#D68553] flex rounded-full border-opacity-0 duration-300 p-1">
                                        <span class="w-4 h-4 rounded-full bg-[#D68553] flex"></span>
                                    </span>
                                </label>
                                <label class="product-color">
                                    <input class="appearance-none hidden" type="radio" name="color" checked>
                                    <span
                                        class="border border-[#61646E] flex rounded-full border-opacity-0 duration-300 p-1">
                                        <span class="w-4 h-4 rounded-full bg-[#61646E] flex"></span>
                                    </span>
                                </label>
                                <label class="product-color">
                                    <input class="appearance-none hidden" type="radio" name="color">
                                    <span
                                        class="border border-[#E9E3DC] flex rounded-full border-opacity-0 duration-300 p-1">
                                        <span class="w-4 h-4 rounded-full bg-[#E9E3DC] flex"></span>
                                    </span>
                                </label>
                                <label class="product-color">
                                    <input class="appearance-none hidden" type="radio" name="color">
                                    <span
                                        class="border border-[#9A9088] flex rounded-full border-opacity-0 duration-300 p-1">
                                        <span class="w-4 h-4 rounded-full bg-[#9A9088] flex"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-4 sm:py-6 border-b border-bdr-clr dark:border-bdr-clr-drk" data-aos="fade-up"
                    data-aos-delay="400">
                    <h4 class="font-medium leading-none text-2xl">Tags :</h4>
                    <div class="flex flex-wrap gap-[10px] md:gap-[15px] mt-5 md:mt-6">
                        <a class="btn btn-theme-outline btn-xs" href="#"
                            data-text="Chair"><span>Chair</span></a>
                        <a class="btn btn-theme-outline btn-xs" href="#" data-text="Art & Paint"><span>Art
                                & Paint</span></a>
                        <a class="btn btn-theme-outline btn-xs" href="#"
                            data-text="Mirror"><span>Mirror</span></a>
                        <a class="btn btn-theme-outline btn-xs" href="#"
                            data-text="Table"><span>Table</span></a>
                        <a class="btn btn-theme-outline btn-xs" href="#" data-text="Lamp"><span>Lamp</span></a>
                    </div>
                </div>
            </div>
    </x-shop.section>

    {{-- Description --}}
    <div class="s-py-50">
        <div class="container-fluid">
            <div class="max-w-[985px] mx-auto">
                <div class="product-dtls-navtab  border-y border-bdr-clr dark:border-bdr-clr-drk">
                    <ul id="user-nav-tabs"
                        class=" text-title dark:text-white text-base sm:text-lg lg:text-xl flex leading-none gap-3 sm:gap-6 md:gap-12 lg:gap-24 justify-between sm:justify-start max-w-md sm:max-w-full">
                        <li role="presentation"
                            class="py-3 sm:py-5 lg:6 relative before:absolute before:w-full before:h-[1px] before:bg-title before:top-full before:left-0 before:duration-300 dark:before:bg-white before:opacity-0 active ">
                            <a class="duration-300 hover:text-primary" href="#c1">Description</a>
                        </li>
                        <li role="presentation"
                            class="py-3 sm:py-5 lg:6 relative before:absolute before:w-full before:h-[1px] before:bg-title before:top-full before:left-0 before:duration-300 dark:before:bg-white before:opacity-0">
                            <a class="duration-300 hover:text-primary" href="#c2">Vendor Info</a>
                        </li>
                        <li role="presentation"
                            class="py-3 sm:py-5 lg:6 relative before:absolute before:w-full before:h-[1px] before:bg-title before:top-full before:left-0 before:duration-300 dark:before:bg-white before:opacity-0">
                            <a class="duration-300 hover:text-primary" href="#c3">Review</a>
                        </li>
                        <li role="presentation"
                            class="py-3 sm:py-5 lg:6 relative before:absolute before:w-full before:h-[1px] before:bg-title before:top-full before:left-0 before:duration-300 dark:before:bg-white before:opacity-0">
                            <a class="duration-300 hover:text-primary" href="#c4">Shipping</a>
                        </li>
                    </ul>
                </div>
                <div id="content" class="mt-5 sm:mt-8 lg:mt-12 mx-0 sm:mr-5 md:mr-8 lg:mr-12">
                    <div id="content1">
                        <p class="sm:text-lg">Crafted with plush cushioning and ergonomic design, it offers
                            unparalleled comfort for lounging or reading. Its timeless style seamlessly blends with any
                            decor, while the sturdy construction ensures durability for years to come. Whether you're
                            unwinding after a long day or enjoying a leisurely weekend, this chair provides the perfect
                            retreat.</p>
                        <ul class="mt-4 sm:mt-6 grid gap-4 sm:gap-5 sm:text-lg leading-none">
                            <li>Leather : From Japan</li>
                            <li>Brand : Navana</li>
                            <li>Weight : 1kg</li>
                            <li>Color : Wooden , Whtie , Blue , Orange</li>
                        </ul>
                    </div>
                    <div id="content2">
                        <div class="max-w-[680px] flex items-start justify-between gap-y-8 gap-x-10 flex-wrap">
                            <div>
                                <span class="text-primary sm:text-lg leading-none block">Shop Name</span>
                                <h4 class="font-medium mt-2 sm:mt-3 text-xl sm:text-2xl leading-none">John Furniture
                                    House</h4>
                                <ul class="mt-4 sm:mt-6 grid gap-3 sm:text-lg">
                                    <li>Vendor : John Smith Doe</li>
                                    <li>Shop : West New York, NY, 1234589</li>
                                    <li>Mail : johnmsmith@gmail.com</li>
                                    <li>Call : +11 - 01234 5678</li>
                                </ul>
                            </div>
                            <div>
                                <span class="text-primary sm:text-lg leading-none block">Shop Name</span>
                                <h4 class="font-medium mt-2 sm:mt-3 text-xl sm:text-2xl leading-none">Furniture Gallery
                                </h4>
                                <ul class="mt-4 sm:mt-6 grid gap-3 sm:text-lg">
                                    <li>Vendor : John Smith Doe</li>
                                    <li>Shop : West New York, NY, 1234589</li>
                                    <li>Mail : johnmsmith@gmail.com</li>
                                    <li>Call : +11 - 01234 5678</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="content3">
                        <div class="max-w-[905px] flex items-start xl:justify-between gap-8 flex-wrap">

                            <div class="sm:max-w-[260px] w-full">
                                <svg class="fill-current text-[#E8E9EA] dark:text-white-light" width="60"
                                    height="51" viewBox="0 0 60 51" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M0 25.5539C0 20.8097 0.974729 16.5328 2.92419 12.723C4.94585 8.91332 7.87004 5.89429 11.6968 3.66596C15.5235 1.36575 20.1083 0.143763 25.4513 0V11.2135C20.9025 11.2135 17.509 12.4715 15.2708 14.9873C13.1047 17.5032 12.0217 21.0254 12.0217 25.5539V28.1416H24.3682V51H0V25.5539ZM60 11.2135C55.4513 11.2135 52.0578 12.4715 49.8195 14.9873C47.6534 17.5032 46.5704 21.0254 46.5704 25.5539V28.1416H58.917V51H34.5487V25.5539C34.5487 20.8097 35.5235 16.5328 37.4729 12.723C39.4946 8.91332 42.4188 5.89429 46.2455 3.66596C50.0722 1.36575 54.657 0.143763 60 0V11.2135Z" />
                                </svg>
                                <ul class="flex items-center gap-2 mt-4 sm:mt-6">
                                    <li>
                                        <svg width="15" height="14" viewBox="0 0 15 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1622 13.6923L7.181 11.201L3.19978 13.6922C3.05515 13.7839 2.86858 13.7769 2.72931 13.6758C2.59043 13.5751 2.52673 13.4001 2.56864 13.2337L3.70764 8.67717L0.150459 5.6612C0.0189569 5.55107 -0.0324041 5.37191 0.0206119 5.2088C0.0736279 5.04526 0.220726 4.93062 0.391668 4.9187L5.03447 4.59449L6.79065 0.23853C6.91968 -0.07951 7.44233 -0.07951 7.57136 0.23853L9.32754 4.59449L13.9703 4.9187C14.1413 4.93062 14.2884 5.04526 14.3414 5.2088C14.3944 5.37191 14.3431 5.55107 14.2115 5.6612L10.6543 8.67723L11.7933 13.2337C11.8353 13.4001 11.7716 13.5752 11.6327 13.6759C11.4905 13.7791 11.3045 13.7814 11.1622 13.6923Z"
                                                fill="#EE9818" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="15" height="14" viewBox="0 0 15 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1622 13.6923L7.181 11.201L3.19978 13.6922C3.05515 13.7839 2.86858 13.7769 2.72931 13.6758C2.59043 13.5751 2.52673 13.4001 2.56864 13.2337L3.70764 8.67717L0.150459 5.6612C0.0189569 5.55107 -0.0324041 5.37191 0.0206119 5.2088C0.0736279 5.04526 0.220726 4.93062 0.391668 4.9187L5.03447 4.59449L6.79065 0.23853C6.91968 -0.07951 7.44233 -0.07951 7.57136 0.23853L9.32754 4.59449L13.9703 4.9187C14.1413 4.93062 14.2884 5.04526 14.3414 5.2088C14.3944 5.37191 14.3431 5.55107 14.2115 5.6612L10.6543 8.67723L11.7933 13.2337C11.8353 13.4001 11.7716 13.5752 11.6327 13.6759C11.4905 13.7791 11.3045 13.7814 11.1622 13.6923Z"
                                                fill="#EE9818" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="15" height="14" viewBox="0 0 15 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1622 13.6923L7.181 11.201L3.19978 13.6922C3.05515 13.7839 2.86858 13.7769 2.72931 13.6758C2.59043 13.5751 2.52673 13.4001 2.56864 13.2337L3.70764 8.67717L0.150459 5.6612C0.0189569 5.55107 -0.0324041 5.37191 0.0206119 5.2088C0.0736279 5.04526 0.220726 4.93062 0.391668 4.9187L5.03447 4.59449L6.79065 0.23853C6.91968 -0.07951 7.44233 -0.07951 7.57136 0.23853L9.32754 4.59449L13.9703 4.9187C14.1413 4.93062 14.2884 5.04526 14.3414 5.2088C14.3944 5.37191 14.3431 5.55107 14.2115 5.6612L10.6543 8.67723L11.7933 13.2337C11.8353 13.4001 11.7716 13.5752 11.6327 13.6759C11.4905 13.7791 11.3045 13.7814 11.1622 13.6923Z"
                                                fill="#EE9818" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg width="15" height="14" viewBox="0 0 15 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1622 13.6923L7.181 11.201L3.19978 13.6922C3.05515 13.7839 2.86858 13.7769 2.72931 13.6758C2.59043 13.5751 2.52673 13.4001 2.56864 13.2337L3.70764 8.67717L0.150459 5.6612C0.0189569 5.55107 -0.0324041 5.37191 0.0206119 5.2088C0.0736279 5.04526 0.220726 4.93062 0.391668 4.9187L5.03447 4.59449L6.79065 0.23853C6.91968 -0.07951 7.44233 -0.07951 7.57136 0.23853L9.32754 4.59449L13.9703 4.9187C14.1413 4.93062 14.2884 5.04526 14.3414 5.2088C14.3944 5.37191 14.3431 5.55107 14.2115 5.6612L10.6543 8.67723L11.7933 13.2337C11.8353 13.4001 11.7716 13.5752 11.6327 13.6759C11.4905 13.7791 11.3045 13.7814 11.1622 13.6923Z"
                                                fill="#EE9818" />
                                        </svg>
                                    </li>
                                    <li>
                                        <svg class="fill-current dark:text-white" width="15" height="14"
                                            viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.6075 13.6923L7.62632 11.201L3.64509 13.6922C3.50046 13.7839 3.3139 13.7769 3.17462 13.6758C3.03574 13.5751 2.97204 13.4001 3.01395 13.2337L4.15295 8.67717L0.595772 5.6612C0.464269 5.55107 0.412908 5.37191 0.465924 5.2088C0.51894 5.04526 0.666039 4.93062 0.836981 4.9187L5.47978 4.59449L7.23596 0.23853C7.365 -0.07951 7.88764 -0.07951 8.01667 0.23853L9.77285 4.59449L14.4157 4.9187C14.5866 4.93062 14.7337 5.04526 14.7867 5.2088C14.8397 5.37191 14.7884 5.55107 14.6569 5.6612L11.0997 8.67723L12.2387 13.2337C12.2806 13.4001 12.2169 13.5752 12.078 13.6759C11.9358 13.7791 11.7498 13.7814 11.6075 13.6923Z"
                                                fill-opacity="0.3" />
                                        </svg>
                                    </li>
                                    <li class="dark:text-gray-100">( 125 )</li>
                                </ul>
                                <h6 class="font-semibold leading-none mt-[10px] text-lg">Merlina Quexy</h6>
                                <p class="sm:text-lg mt-3">Furnixar's products have transformed my living space with
                                    their stylish designs and impeccable craftsmanship.</p>
                            </div>

                        </div>
                    </div>
                    <div id="content4">
                        <div class="mt-5 sm:mt-6">
                            <h4 class="text-xl sm:text-2xl leading-none font-medium">For Shipping</h4>
                            <p class="sm:text-lg mt-3">Shipping times may vary based on your location and the selected
                                delivery option. Please review our shipping policies for details on processing times,
                                charges, and tracking updates. Contact us for any shipping-related inquiries or
                                assistance.</p>
                        </div>
                        <div class="mt-5 sm:mt-6">
                            <h4 class="text-xl sm:text-2xl leading-none font-medium">For Shipping</h4>
                            <p class="sm:text-lg mt-3">Shipping times may vary based on your location and the selected
                                delivery option. Please review our shipping policies for details on processing times,
                                charges, and tracking updates. Contact us for any shipping-related inquiries or
                                assistance.</p>
                        </div>
                        <div class="mt-5 sm:mt-6">
                            <h4 class="text-xl sm:text-2xl leading-none font-medium">For Shipping</h4>
                            <p class="sm:text-lg mt-3">Shipping times may vary based on your location and the selected
                                delivery option. Please review our shipping policies for details on processing times,
                                charges, and tracking updates. Contact us for any shipping-related inquiries or
                                assistance.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Suggested Products --}}
    <div class="s-py-50-100">
        <div class="container-fluid">
            <div class="max-w-[547px] mx-auto text-center">
                <h6 class="text-2xl sm:text-3xl md:text-4xl leading-none font-bold">
                    Suggested Products
                </h6>
                <p class="mt-3">
                    Discover unique items that complement your style and enhance your lifestyle.
                </p>
            </div>
            <div
                class="max-w-[1720px] mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 sm:gap-8 pt-8 md:pt-[50px]">
                @forelse($this->productRecommendations as $product)
                    <x-shop.product-card :product="$product" />
                @empty
                    <div class="col-span-1 sm:col-span-2 md:col-span-2 lg:col-span-3 xl:col-span-4 text-center">
                        <p class="text-lg text-gray-500">No suggested products available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>


</div>

@assets
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"
        data-navigate-track></script>
    <style data-navigate-track>
        model-viewer[ar-tracking="not-tracking"]>#ar-failure {
            height: 100vh;
            width: 100vw;
            box-shadow: inset 0 0 30px 10px rgba(255, 0, 0, 0.8);
        }

        #ar-status-message {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 2rem;
            text-align: center;
            background: rgba(0, 0, 0, 0.75);
            padding: 1rem;
            border-radius: 12px;
            z-index: 100;
            width: 80vw;
            max-width: 90vw;
        }

        #calibration-animation {
            font-size: 3rem;
            margin-top: 1rem;
            animation: tiltPhone 2s infinite ease-in-out;
            transform-origin: center center;
            display: inline-block;
        }

        #dimension-label {
            position: fixed;
            bottom: 1rem;
            left: 1rem;
            display: none;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            font-size: 0.8125rem;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            font-family: 'Roboto Mono', monospace;
            z-index: 10;
        }

        @keyframes tiltPhone {
            0% {
                transform: rotate(-10deg);
            }

            50% {
                transform: rotate(10deg);
            }

            100% {
                transform: rotate(-10deg);
            }
        }
    </style>
@endassets

@script
    <script type="module">
        const viewer = document.querySelector("#chairViewer");
        const arStatusMessage = document.querySelector("#ar-status-message");
        const dimensionLabel = document.querySelector("#dimension-label");

        if (!viewer) return;

        viewer.addEventListener("ar-tracking", (event) => {
            if (event.detail.status === "not-tracking") {
                arStatusMessage.textContent = "Searching for a surface...";
                arStatusMessage.style.display = "block";
                dimensionLabel.style.display = "none";
            } else {
                arStatusMessage.style.display = "none";
                dimensionLabel.style.display = "block";
            }
        });

        viewer.addEventListener("ar-status", (event) => {
            const status = event.detail.status;

            switch (status) {
                case "not-presenting":
                    arStatusMessage.textContent = "AR session ended.";
                    dimensionLabel.style.display = "none";
                    break;
                case "session-started":
                    arStatusMessage.innerHTML = `
                        <div id="calibration-animation">📱</div>
                        Move your device slowly to detect a surface.<br>
                        Ensure good lighting and a flat surface.
                    `;
                    arStatusMessage.style.display = "block";
                    break;
                case "object-placed":
                    arStatusMessage.style.display = "none";
                    dimensionLabel.style.display = "block";
                    break;
                case "failed":
                    alert("AR session failed. Try again.");
                    dimensionLabel.style.display = "none";
                    break;
                default:
                    arStatusMessage.textContent = "Unknown AR status.";
                    break;
            }
        });
    </script>
@endscript
