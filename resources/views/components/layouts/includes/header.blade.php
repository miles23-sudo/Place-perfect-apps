<div class="header section">
    <div class="header-bottom d-none d-lg-block">
        <div class="container position-relative">
            <div class="row align-self-center">
                <div class="col-auto align-self-center">
                    <div class="header-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('sites/images/logo/logo.png') }}" alt="{{ config('app.name') }}" />
                        </a>
                    </div>
                </div>
                <div class="col align-self-center">
                    <div class="header-actions">
                        <div class="header-bottom-set dropdown">
                            <button class="dropdown-toggle header-action-btn" data-bs-toggle="dropdown"><i
                                    class="icon-user"></i></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                @auth
                                    <li>
                                        <a class="dropdown-item" href="{{ route('customer.profile') }}">My Profile</a>
                                    </li>
                                    <li>
                                        <form action="{{ route('customer.logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                @else
                                    <li>
                                        <a class="dropdown-item" href="{{ route('auth.login') }}">Sign in</a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                        <a href="#offcanvas-cart"
                            class="header-action-btn header-action-btn-cart offcanvas-toggle pr-0">
                            <i class="icon-handbag"></i>
                            <span class="header-action-num">01</span>
                            <span class="cart-amount">₱30.00</span>
                        </a>
                        <a href="#offcanvas-mobile-menu"
                            class="header-action-btn header-action-btn-menu offcanvas-toggle d-lg-none">
                            <i class="icon-menu"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom d-lg-none sticky-nav bg-white">
        <div class="container position-relative">
            <div class="row align-self-center">
                <div class="col-auto align-self-center">
                    <div class="header-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('sites/images/logo/logo.png') }}" alt="Site Logo" />
                        </a>
                    </div>
                </div>
                <div class="col align-self-center">
                    <div class="header-actions">
                        <div class="header-bottom-set dropdown">
                            <button class="dropdown-toggle header-action-btn" data-bs-toggle="dropdown"><i
                                    class="icon-user"></i></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                @auth
                                    <li>
                                        <a class="dropdown-item" href="{{ route('customer.profile') }}">My Profile</a>
                                    </li>
                                    <li>
                                        <form action="{{ route('customer.logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                @else
                                    <li>
                                        <a class="dropdown-item" href="{{ route('auth.login') }}">Sign in</a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                        <a href="#offcanvas-cart"
                            class="header-action-btn header-action-btn-cart offcanvas-toggle pr-0">
                            <i class="icon-handbag"></i>
                            <span class="header-action-num">01</span>
                            <span class="cart-amount">₱30.00</span>
                        </a>
                        <a href="#offcanvas-mobile-menu"
                            class="header-action-btn header-action-btn-menu offcanvas-toggle d-lg-none">
                            <i class="icon-menu"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-black d-none d-lg-block sticky-nav">
        <div class="container position-relative">
            <div class="row">
                <div class="col-md-12 align-self-center">
                    <div class="main-menu">
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('shop') }}">Shop</a></li>
                            <li><a href="{{ route('categories') }}">Categories</a></li>
                            <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
    <button class="offcanvas-close"></button>
    <div class="inner customScroll">
        <div class="offcanvas-menu mb-20px">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('shop') }}">Shop</a></li>
                <li><a href="{{ route('categories') }}">Categories</a></li>
                <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
            </ul>
        </div>
    </div>
</div>

<div id="offcanvas-cart" class="offcanvas offcanvas-cart">
    <div class="inner">
        <div class="head">
            <span class="title">Cart</span>
            <button class="offcanvas-close">×</button>
        </div>
        <div class="body customScroll">
            <ul class="minicart-product-list">
                <li>
                    <a href="single-product.html" class="image"><img
                            src="{{ asset('sites/images/product-image/1.jpg') }}" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="single-product.html" class="title">Walnut Cutting Board</a>
                        <span class="quantity-price">1 x <span class="amount">$91.86</span></span>
                        <a href="#" class="remove">×</a>
                    </div>
                </li>
                <li>
                    <a href="single-product.html" class="image"><img
                            src="{{ asset('sites/images/product-image/2.jpg') }}" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="single-product.html" class="title">Lucky Wooden Elephant</a>
                        <span class="quantity-price">1 x <span class="amount">$453.28</span></span>
                        <a href="#" class="remove">×</a>
                    </div>
                </li>
                <li>
                    <a href="single-product.html" class="image"><img
                            src="{{ asset('sites/images/product-image/3.jpg') }}" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="single-product.html" class="title">Fish Cut Out Set</a>
                        <span class="quantity-price">1 x <span class="amount">$87.34</span></span>
                        <a href="#" class="remove">×</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="foot">
            <div class="sub-total">
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="text-start">Total :</td>
                            <td class="text-end theme-color">$632.48</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="buttons">
                <a href="#" class="btn btn-dark btn-hover-primary mb-30px">view cart</a>
                <a href="#" class="btn btn-outline-dark current-btn">checkout</a>
            </div>
            <p class="minicart-message">Free Shipping on All Orders Over $100!</p>
        </div>
    </div>
</div>

<div class="offcanvas-overlay"></div>
