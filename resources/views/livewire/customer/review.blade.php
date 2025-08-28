<div>
    <x-shop.section :title="'Reviews'">
        <div class="max-w-[1720px] mx-auto p-4 md:p-6 lg:p-8 my-profile-navtab">

            <h2 class="text-lg font-bold">Your Reviews</h2>
            <p class="mb-6 text-gray-600 dark:text-gray-400">Share your thoughts on the products you've purchased.
                ({{ $order_id }})</p>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 xl:grid-cols-3 lg:gap-8">

                @foreach ($this->getOrder->items as $item)
                    <div
                        class="overflow-hidden transition-all duration-300 bg-white border border-gray-100 rounded-md shadow-lg dark:bg-dark-secondary hover:shadow-xl dark:border-gray-700">
                        <div
                            class="relative overflow-hidden bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900">
                            <img src="{{ asset('storage/' . $item->product->images[0]) }}" alt="Product Image"
                                class="object-cover w-full h-48 transition-transform duration-300 hover:scale-105" />
                            <div
                                class="absolute px-2 py-1 text-xs font-medium text-gray-600 bg-white rounded-full shadow-sm top-3 right-3 dark:bg-gray-800 dark:text-gray-300">
                                {{ $item->product->productCategory->name }}
                            </div>
                        </div>
                        <div class="p-5 space-y-4">
                            <div class="space-y-2">
                                <h3 class="text-lg font-bold leading-tight text-gray-900 dark:text-white">
                                    {{ $item->product->name }}
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ str($item->product->short_description)->limit(100) }}
                                </p>
                                <div class="flex items-center gap-2">
                                    <span class="text-xl font-bold" style="color: #BB976D;">
                                        ₱{{ $item->price }}
                                    </span>
                                    <span class="text-sm text-gray-400">
                                        ({{ $item->quantity }}x)
                                    </span>
                                </div>
                            </div>
                            @if ($this->productAlreadyReviewed($item->product->id))
                                <!-- Rating Section -->
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Rate this product: <span class="text-red-500">*</span>
                                    </label>
                                    <div x-data="{
                                        rating: {{ $rating[$item->product->id] ?? 5 }},
                                        hoverRating: 0,
                                        updateRating(value) {
                                            this.rating = value;
                                            $wire.set('rating.{{ $item->product->id }}', value);
                                        }
                                    }" class="flex items-center gap-1">
                                        <template x-for="star in 5" :key="star">
                                            <button
                                                class="w-8 h-8 text-2xl transition-all duration-200 transform hover:scale-110"
                                                :class="star <= (hoverRating || rating) ?
                                                    'text-amber-400 hover:text-amber-500' :
                                                    'text-gray-300 dark:text-gray-600 hover:text-amber-400'"
                                                disabled>
                                                ★
                                            </button>
                                        </template>
                                        <span x-text="`${rating} ${rating === 1 ? 'star' : 'stars'}`"
                                            class="ml-2 text-sm text-gray-500 dark:text-gray-400"></span>
                                    </div>
                                </div>

                                <!-- Review Section -->
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Your Review: <span class="text-red-500">*</span>
                                    </label>
                                    <textarea
                                        class="w-full h-24 p-3 placeholder-gray-400 transition-all duration-200 border border-gray-200 resize-none dark:border-gray-600 rounded-xl focus:ring-2 focus:border-transparent dark:bg-gray-800 dark:text-white"
                                        style="--tw-ring-color: #BB976D; --tw-ring-opacity: 0.5;"
                                        placeholder="Share your experience with this product... (minimum 10 characters)"
                                        wire:model.blur="review.{{ $item->product->id }}" maxlength="1000" disabled></textarea>
                                </div>
                                The review for this product has already been submitted.
                            @else
                                <!-- Rating Section -->
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Rate this product: <span class="text-red-500">*</span>
                                    </label>
                                    <div x-data="{
                                        rating: {{ $rating[$item->product->id] ?? 5 }},
                                        hoverRating: 0,
                                        updateRating(value) {
                                            this.rating = value;
                                            $wire.set('rating.{{ $item->product->id }}', value);
                                        }
                                    }" class="flex items-center gap-1">
                                        <template x-for="star in 5" :key="star">
                                            <button @click="updateRating(star)" @mouseenter="hoverRating = star"
                                                @mouseleave="hoverRating = 0"
                                                class="w-8 h-8 text-2xl transition-all duration-200 transform hover:scale-110"
                                                :class="star <= (hoverRating || rating) ?
                                                    'text-amber-400 hover:text-amber-500' :
                                                    'text-gray-300 dark:text-gray-600 hover:text-amber-400'">
                                                ★
                                            </button>
                                        </template>
                                        <span x-text="`${rating} ${rating === 1 ? 'star' : 'stars'}`"
                                            class="ml-2 text-sm text-gray-500 dark:text-gray-400"></span>
                                    </div>
                                    @error('rating.' . $item->product->id)
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Review Section -->
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Your Review: <span class="text-red-500">*</span>
                                    </label>
                                    <textarea
                                        class="w-full h-24 p-3 placeholder-gray-400 transition-all duration-200 border border-gray-200 resize-none dark:border-gray-600 rounded-xl focus:ring-2 focus:border-transparent dark:bg-gray-800 dark:text-white"
                                        style="--tw-ring-color: #BB976D; --tw-ring-opacity: 0.5;"
                                        placeholder="Share your experience with this product... (minimum 10 characters)"
                                        wire:model.blur="review.{{ $item->product->id }}" maxlength="1000"></textarea>
                                    <div class="flex items-center justify-between">
                                        @error('review.' . $item->product->id)
                                            <span class="text-sm text-red-500">{{ $message }}</span>
                                        @enderror
                                        <span class="text-xs text-gray-400">
                                            {{ strlen($review[$item->product->id] ?? '') }}/1000
                                        </span>
                                    </div>
                                </div>

                                <button
                                    class="w-full text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 transform hover:scale-[1.02] shadow-md hover:shadow-lg"
                                    style="background: linear-gradient(to right, #BB976D, #A3845A);"
                                    onmouseover="this.style.background='linear-gradient(to right, #A3845A, #8E7450)'"
                                    onmouseout="this.style.background='linear-gradient(to right, #BB976D, #A3845A)'"
                                    wire:click="submitReview({{ $item->product->id }})">
                                    <span wire:loading.remove
                                        wire:target="submitReview({{ $item->product->id }})">Submit
                                        Review</span>
                                    <span wire:loading
                                        wire:target="submitReview({{ $item->product->id }})">Submitting</span>
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </x-shop.section>
</div>
