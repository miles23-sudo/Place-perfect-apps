<div>
    <!-- Banner Start -->
    <div class="flex items-center gap-4 flex-wrap bg-overlay p-14 sm:p-16 before:bg-title before:bg-opacity-70"
        style="background-image:url('{{ asset('sites/img/shortcode/breadcumb.jpg') }}');">
        <div class="text-center w-full">
            <h2 class="text-white text-8 md:text-[40px] font-normal leading-none text-center">Shop</h2>
            <ul
                class="flex items-center justify-center gap-[10px] text-base md:text-lg leading-none font-normal text-white mt-3 md:mt-4">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>/</li>
                <li class="text-primary">Shop</li>
            </ul>
        </div>
    </div>

    <div class="s-py-100">
        <div class="container-fluid">
            <!-- Shop Header -->
            <div
                class="flex items-start justify-between gap-8 max-w-[1720px] mx-auto flex-col lg:flex-row border-b border-bdr-clr dark:border-bdr-clr-drk pb-8 md:pb-[50px]">
                <div>
                    <h4 class="font-medium leading-none text-xl sm:text-2xl mb-5 sm:mb-6">Choose Category</h4>
                    <div class="flex flex-wrap gap-[10px] md:gap-[15px]">
                        <a class="btn btn-theme-outline btn-sm shop1-button" href="#"
                            data-text="Sofa & Chair"><span>Sofa & Chair</span></a>
                        <a class="btn btn-theme-outline btn-sm shop1-button" href="#"
                            data-text="Full Interior"><span>Full Interior</span></a>
                        <a class="btn btn-theme-outline btn-sm shop1-button" href="#"
                            data-text="Lamp & Vase"><span>Lamp & Vase</span></a>
                        <a class="btn btn-theme-outline btn-sm shop1-button" href="#"
                            data-text="Table"><span>Table</span></a>
                        <a class="btn btn-theme-outline btn-sm shop1-button" href="#"
                            data-text="Wood Design"><span>Wood Design</span></a>
                    </div>
                </div>
                <div class="max-w-[562px] w-full grid sm:grid-cols-2 gap-8 md:gap-12">
                    <div>
                        <div class="grid grid-cols-2 gap-[15px]">
                            <div
                                class="py-[10px] px-5 border border-title dark:border-white-light flex items-center justify-center gap-[5px]">
                                <span class="text-title dark:text-white font-medium leading-none">Min:</span>
                                <div class="relative">
                                    <span
                                        class="text-title dark:text-white font-medium leading-none absolute left-0 top-1/2 block transform -translate-y-1/2">$</span>
                                    <input
                                        class="pl-[10px] w-full appearance-none bg-transparent text-title dark:text-white font-medium leading-none placeholder:text-title dark:placeholder:text-white placeholder  placeholder:font-medium placeholder:leading-none outline-none "
                                        type="number" placeholder="0" value="0">
                                </div>
                            </div>
                            <div
                                class="py-[10] px-5 border border-title dark:border-white-light flex items-center justify-center gap-[5px]">
                                <span class="text-title dark:text-white font-medium leading-none">Max:</span>
                                <div class="relative">
                                    <span
                                        class="text-title dark:text-white  font-medium leading-none absolute left-0 top-1/2 block transform -translate-y-1/2">$</span>
                                    <input
                                        class="pl-[10px] w-full appearance-none bg-transparent text-title dark:text-white font-medium leading-none placeholder:text-title dark:placeholder:text-white  placeholder:font-medium placeholder:leading-none outline-none "
                                        type="number" placeholder="100" value="100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-medium leading-none text-xl sm:text-2xl mb-5 sm:mb-6">Choose Brand</h4>
                        <select class="outline-select small-select">
                            <option value="1">Navana Furniture</option>
                            <option value="2">RFL Furniture</option>
                            <option value="2">Gazi Furniture</option>
                            <option value="2">Plastic Furniture</option>
                            <option value="2">Luxury Furniture</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="max-w-[1720px] mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 sm:gap-8 pt-8 md:pt-[50px]"
                data-aos="fade-up" data-aos-delay="200">

                <!-- Product 1 -->
                <div class="group">
                    <div class="relative overflow-hidden">
                        <a href="#">
                            <img class="w-full transform group-hover:scale-110 duration-300"
                                src="{{ asset('sites/img/shortcode/product-card/pdct-01.jpg') }}" alt="shop">
                        </a>
                        <div
                            class="absolute z-10 top-7 left-7 pt-[10px] pb-2 px-3 bg-[#1CB28E] rounded-[30px] font-primary text-[14px] text-white font-semibold leading-none">
                            Hot Sale
                        </div>
                    </div>
                    <div class="md:px-2 lg:px-4 xl:px-6 lg:pt-6 pt-5 flex gap-4 md:gap-5 flex-col">
                        <h4 class="font-medium leading-none dark:text-white text-lg">$25.75</h4>
                        <div>
                            <h5 class="font-normal dark:text-white text-xl leading-[1.5]">
                                <a href="#" class="text-underline">White
                                    Minimal Chair1</a>
                            </h5>
                            <div class="text-sm text-gray-500 mt-1">( 1,230 )</div>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="group">
                    <div class="relative overflow-hidden">
                        <a href="#">
                            <img class="w-full transform group-hover:scale-110 duration-300"
                                src="{{ asset('sites/img/shortcode/product-card/pdct-02.jpg') }}" alt="shop">
                        </a>
                        <div
                            class="absolute z-10 top-7 left-7 pt-[10px] pb-2 px-3 bg-[#9739E1] rounded-[30px] font-primary text-[14px] text-white font-semibold leading-none">
                            NEW
                        </div>
                    </div>
                    <div class="md:px-2 lg:px-4 xl:px-6 lg:pt-6 pt-5 flex gap-4 md:gap-5 flex-col">
                        <h4 class="font-medium leading-none dark:text-white text-lg">$122.75</h4>
                        <div>
                            <h5 class="font-normal dark:text-white text-xl leading-[1.5]">
                                <a href="#" class="text-underline">Preminu
                                    Luxury Sofa</a>
                            </h5>
                            <div class="text-sm text-gray-500 mt-1">( 1,230 )</div>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="group">
                    <div class="relative overflow-hidden">
                        <a href="#">
                            <img class="w-full transform group-hover:scale-110 duration-300"
                                src="{{ asset('sites/img/gallery/shop-01/shop-01.jpg') }}" alt="shop">
                        </a>
                        <div
                            class="absolute z-10 top-7 left-7 py-[11px] px-3 bg-[#E13939] rounded-[30px] font-primary text-base text-white font-semibold leading-none">
                            10% OFF
                        </div>
                    </div>
                    <div class="md:px-2 lg:px-4 xl:px-6 lg:pt-6 pt-5 flex gap-4 md:gap-5 flex-col">
                        <h4 class="font-medium leading-none dark:text-white text-lg">$140.99</h4>
                        <div>
                            <h5 class="font-normal dark:text-white text-xl leading-[1.5]">
                                <a href="#" class="text-underline">Table With
                                    Pops2</a>
                            </h5>
                            <div class="text-sm text-gray-500 mt-1">( 1,230 )</div>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="group">
                    <div class="relative overflow-hidden">
                        <a href="#">
                            <img class="w-full transform group-hover:scale-110 duration-300"
                                src="{{ asset('sites/img/gallery/shop-01/shop-02.jpg') }}" alt="shop">
                        </a>
                    </div>
                    <div class="md:px-2 lg:px-4 xl:px-6 lg:pt-6 pt-5 flex gap-4 md:gap-5 flex-col">
                        <h4 class="font-medium leading-none dark:text-white text-lg">$122.75</h4>
                        <div>
                            <h5 class="font-normal dark:text-white text-xl leading-[1.5]">
                                <a href="#" class="text-underline">Luxury Lamp for Wall2</a>
                            </h5>
                            <div class="text-sm text-gray-500 mt-1">( 1,230 )</div>
                        </div>
                    </div>
                </div>

                <!-- Product 5 -->
                <div class="group">
                    <div class="relative overflow-hidden">
                        <a href="#">
                            <img class="w-full transform group-hover:scale-110 duration-300"
                                src="{{ asset('sites/img/gallery/shop-01/shop-03.jpg') }}" alt="shop">
                        </a>
                    </div>
                    <div class="md:px-2 lg:px-4 xl:px-6 lg:pt-6 pt-5 flex gap-4 md:gap-5 flex-col">
                        <h4 class="font-medium leading-none dark:text-white text-lg">$140.99</h4>
                        <div>
                            <h5 class="font-normal dark:text-white text-xl leading-[1.5]">
                                <a href="#" class="text-underline">White
                                    Minimal Chair2</a>
                            </h5>
                            <div class="text-sm text-gray-500 mt-1">( 1,230 )</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="text-center mt-7 md:mt-12">
                <div class="mt-10 md:mt-12 flex items-center justify-center gap-[10px]">
                    <a href="#" class="text-title dark:text-white text-xl"><span
                            class="lnr lnr-arrow-left"></span></a>
                    <a href="#"
                        class="w-8 sm:w-10 h-8 sm:h-10 bg-title bg-opacity-5 flex items-center justify-center leading-none text-base sm:text-lg font-medium text-title transition-all duration-300 hover:bg-opacity-100 hover:text-white dark:bg-white dark:bg-opacity-5 dark:text-white dark:hover:bg-opacity-100 dark:hover:text-title">01</a>
                    <a href="#"
                        class="w-8 sm:w-10 h-8 sm:h-10 bg-title bg-opacity-5 flex items-center justify-center leading-none text-base sm:text-lg font-medium text-title transition-all duration-300 hover:bg-opacity-100 hover:text-white dark:bg-white dark:bg-opacity-5 dark:text-white dark:hover:bg-opacity-100 dark:hover:text-title">02</a>
                    <a href="#"
                        class="w-8 sm:w-10 h-8 sm:h-10 bg-title bg-opacity-5 flex items-center justify-center leading-none text-base sm:text-lg font-medium text-title transition-all duration-300 hover:bg-opacity-100 hover:text-white dark:bg-white dark:bg-opacity-5 dark:text-white dark:hover:bg-opacity-100 dark:hover:text-title">03</a>
                    <a href="#" class="text-title dark:text-white text-3xl sm:text-4xl transform">...</a>
                    <a href="#"
                        class="w-8 sm:w-10 h-8 sm:h-10 bg-title bg-opacity-5 flex items-center justify-center leading-none text-base sm:text-lg font-medium text-title transition-all duration-300 hover:bg-opacity-100 hover:text-white dark:bg-white dark:bg-opacity-5 dark:text-white dark:hover:bg-opacity-100 dark:hover:text-title">09</a>
                    <a href="#"
                        class="w-8 sm:w-10 h-8 sm:h-10 bg-title bg-opacity-5 flex items-center justify-center leading-none text-base sm:text-lg font-medium text-title transition-all duration-300 hover:bg-opacity-100 hover:text-white dark:bg-white dark:bg-opacity-5 dark:text-white dark:hover:bg-opacity-100 dark:hover:text-title">10</a>

                    <a href="#" class="text-title dark:text-white text-xl"><span
                            class="lnr lnr-arrow-right"></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
