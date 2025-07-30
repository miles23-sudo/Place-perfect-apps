<div>
    <div class="bg-[#F8F5F0] dark:bg-dark-secondary py-5 md:py-[30px]">
        <div class="container-fluid">
            <ul
                class="flex items-center gap-[10px] text-base md:text-lg leading-none font-normal text-title dark:text-white max-w-[1720px] mx-auto flex-wrap">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>/</li>
                <li><a href="{{ route('shop') }}">Shop</a></li>
                <li>/</li>
                <li class="text-primary">Classic Relaxable Chair</li>
            </ul>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Product Slider Start -->
    <div class="s-py-50" data-aos="fade-up">
        <div class="container-fluid">
            <div class="max-w-[1720px] mx-auto flex justify-between gap-10 flex-col lg:flex-row">
                <div class="w-full lg:w-[58%]">
                    <div class="relative product-dtls-wrapper">
                        <button
                            class="absolute top-5 left-0 p-2 bg-[#E13939] text-lg leading-none text-white font-medium z-50">-10%</button>
                        <div class="product-dtls-slider ">
                            <div><img src="{{ asset('sites/img/gallery/product-detls/product-01.jpg') }}" class="w-full"
                                    alt="product"></div>
                            <div><img src="{{ asset('sites/img/gallery/product-detls/product-02.jpg') }}"
                                    alt="product"></div>
                            <div><img src="{{ asset('sites/img/gallery/product-detls/product-03.jpg') }}"
                                    alt="product"></div>
                            <div><img src="{{ asset('sites/img/gallery/product-detls/product-04.jpg') }}"
                                    alt="product"></div>
                            <div><img src="{{ asset('sites/img/gallery/product-detls/product-01.jpg') }}"
                                    alt="product"></div>
                            <div><img src="{{ asset('sites/img/gallery/product-detls/product-02.jpg') }}"
                                    alt="product"></div>
                        </div>
                        <div class="product-dtls-nav">
                            <div><img src="{{ asset('sites/img/gallery/product-detls/product-01.jpg') }}"
                                    alt="product"></div>
                            <div><img src="{{ asset('sites/img/gallery/product-detls/product-02.jpg') }}"
                                    alt="product"></div>
                            <div><img src="{{ asset('sites/img/gallery/product-detls/product-03.jpg') }}"
                                    alt="product"></div>
                            <div><img src="{{ asset('sites/img/gallery/product-detls/product-04.jpg') }}"
                                    alt="product"> </div>
                            <div><img src="{{ asset('sites/img/gallery/product-detls/product-01.jpg') }}"
                                    alt="product"></div>
                            <div><img src="{{ asset('sites/img/gallery/product-detls/product-02.jpg') }}"
                                    alt="product"></div>
                        </div>
                    </div>
                </div>
                <div class="lg:max-w-[635px] w-full">
                    <div class="pb-4 sm:pb-6 border-b border-bdr-clr dark:border-bdr-clr-drk">
                        <h2 class="font-semibold leading-none md:text-4xl">
                            Classic Relaxable Chair
                        </h2>
                        <div class="flex gap-4 items-center mt-[15px]">
                            <span class="text-2xl sm:text-3xl text-primary leading-none block">
                                $85.00
                            </span>
                        </div>

                        <p class="sm:text-lg mt-5 md:mt-7">
                            Experience the epitome of relaxation with our Classic Relaxable Chair. Crafted with plush
                            cushioning and ergonomic design, it offers unparalleled comfort for lounging or reading. Its
                            timeless style seamlessly blends with any decor, while the sturdy construction ensures
                            durability for years to come.
                        </p>
                    </div>
                    <div class="py-4 sm:py-6 border-b border-bdr-clr dark:border-bdr-clr-drk" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="inc-dec flex items-center gap-2">
                            <button
                                class="dec w-8 h-8 bg-[#E8E9EA] dark:bg-dark-secondary flex items-center justify-center">
                                <svg class="fill-current text-title dark:text-white" width="14" height="2"
                                    viewBox="0 0 14 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.4361 0.203613H12.0736L7.81774 0.203615H13.8729V1.80309H7.81774L3.50809 1.80309H1.87053L6.18017 1.80309H0.125V0.203615H6.18017L10.4361 0.203613Z" />
                                </svg>
                            </button>
                            <input
                                class="w-6 h-auto outline-none bg-transparent text-base mg:text-lg leading-none text-title dark:text-white text-center"
                                type="text" value="1">
                            <button
                                class="inc  w-8 h-8 bg-[#E8E9EA] dark:bg-dark-secondary flex items-center justify-center">
                                <svg class="fill-current text-title dark:text-white" width="14" height="14"
                                    viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.18017 0.110352H7.81774V6.16553H13.8729V7.76501H7.81774V13.8963H6.18017V7.76501H0.125V6.16553H6.18017V0.110352Z" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex gap-4 mt-4 sm:mt-6">
                            <a href="{{ route('cart') }}" class="btn btn-solid" data-text="Add to Cart">
                                <span>Add to Cart</span>
                            </a>
                            <a href="#" class="btn btn-outline" data-text="Add to Wishlist">
                                <span>Add to Wishlist</span>
                            </a>
                            <a href="#" class="btn btn-outline" data-text="View in AR">
                                <span>View in AR</span>
                            </a>
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
                            <a class="btn btn-theme-outline btn-xs" href="#"
                                data-text="Lamp"><span>Lamp</span></a>
                        </div>
                    </div>
                    <div class="pt-4 sm:pt-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="flex items-center gap-6">
                            <h6 class="font-normal text-lg">Share : </h6>
                            <div class="flex gap-6">
                                <a href="#"
                                    class="text-paragraph duration-300 dark:text-white hover:text-primary dark:hover:text-primary">
                                    <svg class="fill-current" width="9" height="17" viewBox="0 0 9 17"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6.85187 2.88048H8.3125V0.327504C7.60589 0.249301 6.89543 0.211267 6.18454 0.213583C5.69283 0.185244 5.2009 0.265194 4.74322 0.447828C4.28554 0.630463 3.87319 0.911363 3.53508 1.27084C3.19696 1.63032 2.94126 2.05967 2.78589 2.52881C2.63052 2.99795 2.57925 3.49553 2.63567 3.98665V6.23546H0.3125V9.09033H2.63567V16.2674H5.4843V9.09033H7.7144L8.06849 6.23546H5.4843V4.26918C5.48543 3.44439 5.70674 2.88048 6.85187 2.88048Z" />
                                    </svg>
                                </a>
                                <a href="#"
                                    class="text-paragraph duration-300 dark:text-white hover:text-primary dark:hover:text-primary">
                                    <svg class="fill-current" width="21" height="17" viewBox="0 0 21 17"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20.3125 1.93807C19.56 2.26226 18.7641 2.47762 17.9495 2.5775C18.8075 2.07421 19.4491 1.27744 19.7528 0.338011C18.9492 0.809117 18.0701 1.14092 17.1534 1.31907C16.5909 0.726685 15.8612 0.315117 15.0591 0.137768C14.257 -0.0395802 13.4195 0.0254805 12.6553 0.324511C11.891 0.623542 11.2354 1.14273 10.7734 1.81471C10.3114 2.48668 10.0644 3.28041 10.0644 4.09289C10.061 4.40344 10.0927 4.7134 10.1589 5.017C8.52829 4.93856 6.93277 4.52093 5.47658 3.79139C4.02038 3.06186 2.73628 2.03683 1.70816 0.783282C1.18069 1.67484 1.01735 2.73179 1.25147 3.73836C1.48559 4.74493 2.09952 5.62522 2.96794 6.19953C2.31904 6.18223 1.68386 6.01099 1.11593 5.70024V5.74404C1.117 6.6799 1.44419 7.58683 2.04242 8.3122C2.64065 9.03756 3.4734 9.53706 4.40052 9.72665C4.04967 9.81785 3.68811 9.86253 3.32535 9.85951C3.06466 9.86431 2.8042 9.84131 2.54851 9.79089C2.81297 10.5956 3.3235 11.2993 4.00969 11.805C4.69587 12.3107 5.5239 12.5935 6.37955 12.6143C4.92709 13.7358 3.13616 14.3434 1.29315 14.3399C0.965406 14.3422 0.637852 14.3236 0.3125 14.2845C2.18785 15.4772 4.37257 16.1075 6.60256 16.0991C8.13765 16.1094 9.65951 15.8181 11.0798 15.2422C12.5 14.6662 13.7904 13.8171 14.8759 12.7441C15.9614 11.671 16.8204 10.3955 17.403 8.99161C17.9857 7.58769 18.2804 6.08333 18.27 4.56589C18.27 4.38632 18.27 4.21406 18.2552 4.04179C19.0647 3.47007 19.7619 2.75716 20.3125 1.93807Z" />
                                    </svg>
                                </a>
                                <a href="#"
                                    class="text-paragraph duration-300 dark:text-white hover:text-primary dark:hover:text-primary">
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.6744 5.43486C17.6603 4.70332 17.5234 3.97955 17.2696 3.29456C17.0457 2.70824 16.7035 2.17572 16.265 1.73104C15.8265 1.28636 15.3012 0.93931 14.7229 0.712057C14.047 0.455155 13.3329 0.316424 12.6112 0.301775C11.678 0.257327 11.3823 0.24707 9.01876 0.24707C6.65526 0.24707 6.35954 0.257327 5.42966 0.298356C4.70792 0.31274 3.99386 0.45148 3.31803 0.708638C2.73547 0.931712 2.20843 1.28188 1.77422 1.73434C1.33244 2.17515 0.990246 2.70785 0.771257 3.2957C0.519468 3.97954 0.383746 4.70167 0.369845 5.43145C0.32262 6.37624 0.3125 6.67597 0.3125 9.0727C0.3125 11.4694 0.32262 11.768 0.363098 12.7094C0.377246 13.4409 0.514129 14.1647 0.767883 14.8497C0.99196 15.4361 1.33431 15.9687 1.77303 16.4134C2.21176 16.8581 2.73721 17.2051 3.31578 17.4322C3.99239 17.6893 4.70719 17.8281 5.42966 17.8425C6.35842 17.8835 6.65414 17.8938 9.01763 17.8938C11.3811 17.8938 11.6768 17.8835 12.6056 17.8425C13.3274 17.8282 14.0414 17.6895 14.7172 17.4322C15.296 17.2054 15.8216 16.8585 16.2604 16.4138C16.6991 15.9691 17.0414 15.4363 17.2651 14.8497C17.5185 14.1646 17.6554 13.4409 17.6699 12.7094C17.7104 11.768 17.7205 11.4683 17.7205 9.0727C17.7205 6.67711 17.7205 6.37738 17.6767 5.436L17.6744 5.43486ZM16.1115 12.6399C16.106 13.1992 16.0048 13.7533 15.8124 14.2776C15.6673 14.6582 15.4453 15.0038 15.1606 15.2923C14.876 15.5808 14.535 15.8058 14.1595 15.9529C13.6422 16.1476 13.0956 16.2501 12.5438 16.2561C11.6251 16.2971 11.3496 16.3074 9.02663 16.3074C6.70361 16.3074 6.42476 16.2971 5.50949 16.2561C4.95766 16.2505 4.41096 16.1479 3.89373 15.9529C3.51595 15.8122 3.17429 15.5871 2.89413 15.2942C2.60588 15.0096 2.38386 14.6635 2.24423 14.281C2.05182 13.7567 1.95025 13.2027 1.94401 12.6433C1.90353 11.7122 1.89341 11.433 1.89341 9.0784C1.89341 6.72384 1.90353 6.4412 1.94401 5.5135C1.94948 4.95417 2.05068 4.40005 2.2431 3.87579C2.38162 3.49439 2.60385 3.14989 2.89301 2.86832C3.17358 2.57595 3.51511 2.35088 3.8926 2.20959C4.40995 2.015 4.95658 1.91244 5.50837 1.90644C6.42701 1.86541 6.70249 1.85515 9.0255 1.85515C11.3485 1.85515 11.6274 1.86541 12.5426 1.90644C13.0945 1.91203 13.6412 2.0146 14.1584 2.20959C14.5362 2.35022 14.8779 2.57538 15.158 2.86832C15.4462 3.15288 15.6683 3.499 15.8079 3.88149C16.0009 4.40415 16.1036 4.95662 16.1115 5.51464C16.152 6.44576 16.1621 6.72498 16.1621 9.07954C16.1621 11.4341 16.152 11.7099 16.1115 12.641V12.6399Z" />
                                        <path
                                            d="M9.01976 4.53613C8.13511 4.53613 7.27032 4.80206 6.53476 5.3003C5.7992 5.79853 5.2259 6.5067 4.88736 7.33523C4.54881 8.16377 4.46023 9.07547 4.63282 9.95503C4.80541 10.8346 5.23141 11.6425 5.85695 12.2767C6.48249 12.9108 7.27948 13.3426 8.14713 13.5176C9.01479 13.6926 9.91414 13.6028 10.7314 13.2596C11.5488 12.9164 12.2473 12.3352 12.7388 11.5896C13.2303 10.8439 13.4926 9.96723 13.4926 9.07043C13.4923 7.86795 13.021 6.71481 12.1822 5.86453C11.3435 5.01425 10.2059 4.53643 9.01976 4.53613ZM9.01976 12.0112C8.446 12.0112 7.88513 11.8387 7.40807 11.5156C6.93101 11.1925 6.55918 10.7332 6.33961 10.1958C6.12005 9.65846 6.0626 9.06717 6.17454 8.49671C6.28647 7.92625 6.56275 7.40225 6.96846 6.99097C7.37417 6.57969 7.89107 6.29961 8.4538 6.18614C9.01653 6.07267 9.59982 6.13091 10.1299 6.35349C10.66 6.57607 11.1131 6.953 11.4318 7.43661C11.7506 7.92023 11.9207 8.48879 11.9207 9.07043C11.9204 9.85028 11.6147 10.5981 11.0707 11.1496C10.5267 11.701 9.78905 12.0109 9.01976 12.0112Z" />
                                        <path
                                            d="M14.7141 4.35722C14.7141 4.56674 14.6529 4.77156 14.5381 4.94577C14.4233 5.11999 14.2602 5.25576 14.0693 5.33594C13.8784 5.41613 13.6684 5.4371 13.4658 5.39623C13.2631 5.35535 13.077 5.25446 12.9309 5.10631C12.7849 4.95815 12.6854 4.76939 12.6451 4.5639C12.6048 4.3584 12.6254 4.14539 12.7045 3.95181C12.7836 3.75824 12.9175 3.5928 13.0892 3.47639C13.261 3.35999 13.463 3.29785 13.6696 3.29785C13.9466 3.29785 14.2123 3.40947 14.4082 3.60814C14.6041 3.80681 14.7141 4.07626 14.7141 4.35722Z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Slider End -->

    <!-- Description Start -->
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
    <!-- Description End -->

    {{-- Suggested Products --}}
    <div class="s-py-50-100">
        <div class="container-fluid">
            <div class="max-w-[547px] mx-auto text-center">
                <h6 class="text-2xl sm:text-3xl md:text-4xl leading-none font-bold">Suggested Products</h6>
                <p class="mt-3">
                    Explore complementary options that enhance your experience. Discover related products
                    curated just for you. </p>
            </div>
            <div
                class="max-w-[1720px] mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 sm:gap-8 pt-8 md:pt-[50px]">

                <!-- Single Product -->
                <div class="group">
                    <div class="relative overflow-hidden">
                        <a href="#">
                            <img class="w-full transform group-hover:scale-110 duration-300"
                                src="{{ asset('sites/img/gallery/shop-01/shop-03.jpg') }}" alt="shop">
                        </a>
                    </div>
                    <div class="md:px-2 lg:px-4 xl:px-6 lg:pt-6 pt-5 flex gap-4 md:gap-5 flex-col">
                        <h4 class="font-medium leading-none dark:text-white text-lg">$155.12</h4>
                        <div>
                            <h5 class="font-normal dark:text-white text-xl leading-[1.5]">
                                <a href="#" class="text-underline">
                                    Cat toy
                                </a>
                            </h5>
                            <ul class="flex items-center gap-2 mt-1">
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
                                <li class="dark:text-gray-100">
                                    ( 1,230 )
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="group">
                    <div class="relative overflow-hidden">
                        <a href="#">
                            <img class="w-full transform group-hover:scale-110 duration-300"
                                src="{{ asset('sites/img/gallery/shop-01/shop-06.jpg') }}" alt="shop">
                        </a>
                        <div
                            class="absolute z-10 top-7 left-7 pt-[10px] pb-2 px-3 bg-[#E13939] rounded-[30px] font-primary text-[14px] text-white font-semibold leading-none">
                            AR Available
                        </div>
                    </div>
                    <div class="md:px-2 lg:px-4 xl:px-6 lg:pt-6 pt-5 flex gap-4 md:gap-5 flex-col">
                        <h4 class="font-medium leading-none dark:text-white text-lg">$122.75 <span
                                class="text-title/50 line-through pl-2 inline-block">$140.99</span></h4>
                        <div>
                            <h5 class="font-normal dark:text-white text-xl leading-[1.5]">
                                <a href="#" class="text-underline">
                                    Luxury Lamp for Wall
                                </a>
                            </h5>
                            <p class="text-[#6B7280] dark:text-[#9CA3AF] text-sm leading-[1.5]">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque
                                volutpat mattis eros, sed convallis turpis.
                            </p>
                        </div>
                    </div>
                </div>

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
