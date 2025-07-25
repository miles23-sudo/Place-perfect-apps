<div>
    <x-shop.section class="cart-main-area" title="Cart">
        <h3 class="cart-page-title">Your cart items</h3>
        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="table-content table-responsive cart-table-content">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Item Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($this->cartItems as $item)
                                <tr>
                                    <td class="product-thumbnail">
                                        @if ($item->product->images)
                                            <img class="img-responsive ml-15px"
                                                src="{{ asset('storage/' . $item->product->images[0]) }}"
                                                alt="{{ $item->product->name }}" />
                                        @endif
                                    </td>
                                    <td class="product-name">
                                        {{ $item->product_name }}
                                    </td>
                                    <td class="product-price-cart">
                                        <span class="amount">
                                            ₱{{ number_format($item->product->price, 2) }}
                                        </span>
                                    </td>
                                    <td class="product-quantity" x-data="{
                                        quantity: {{ $item->quantity }},
                                        clamp(val) {
                                            return Math.min(100, Math.max(1, val));
                                        },
                                        updateQuantity() {
                                            this.quantity = this.clamp(this.quantity);
                                            @this.call('updateQuantity', {{ $item->id }}, this.quantity);
                                        }
                                    }" x-init="$watch('quantity', value => updateQuantity())">
                                        <div class="d-flex align-items-center border" wire:ignore>
                                            <button type="button" class="btn btn-light bg-transparent w-auto px-2"
                                                @click="quantity = clamp(quantity - 1)">
                                                -
                                            </button>
                                            <input type="text" class="border-0 rounded-0 p-0 text-center"
                                                x-model.number.lazy="quantity" />
                                            <button type="button" class="btn btn-light bg-transparent w-auto px-2"
                                                @click="quantity = clamp(quantity + 1)">
                                                +
                                            </button>
                                        </div>
                                    </td>
                                    <td class="product-subtotal">₱{{ $item->total }}</td>
                                    <td class="product-remove">
                                        <a href="javascript:void(0);" @click="$wire.removeItem({{ $item->id }})">
                                            <i class="icon-close"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Your cart is empty.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cart-shiping-update-wrapper">
                            <div class="cart-shiping-update">
                                <a href="{{ route('shop') }}">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-12">
                <div class="grand-totall">
                    <div class="title-wrap">
                        <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                    </div>
                    <h5>Total products <span>$260.00</span></h5>
                    <div class="total-shipping">
                        <h5>Total shipping</h5>
                        <ul>
                            <li><input type="checkbox" /> Standard <span>$20.00</span></li>
                            <li><input type="checkbox" /> Express <span>$30.00</span></li>
                        </ul>
                    </div>
                    <h4 class="grand-totall-title">Grand Total <span>$260.00</span></h4>
                    <a href="#">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </x-shop.section>
</div>
