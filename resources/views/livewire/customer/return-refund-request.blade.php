<div>
    <x-shop.section :title="'Retturn & Refund Request'">
        <form class="w-full max-w-[1720px] mx-auto p-4 sm:p-6 lg:p-8 my-profile-navtab" wire:submit="submitRequest">
            <h2 class="text-base font-bold sm:text-lg md:text-xl">
                Order #{{ $order_id }} - Return & Refund Request
            </h2>
            <p class="mb-4 text-sm text-gray-600 sm:mb-6 sm:text-base dark:text-gray-400">
                Please provide a reason for your request and any additional details that may help us process your
                request.
            </p>

            <div class="grid gap-4 sm:gap-5 md:gap-6">
                <div>
                    <label
                        class="block mb-2 text-sm leading-none sm:mb-3 sm:text-base md:text-lg text-title dark:text-white">
                        Return/Refund Reason <span class="text-xs text-red-500 sm:text-sm dark:text-red-400">*</span>
                    </label>
                    <textarea
                        class="w-full min-h-[100px] sm:min-h-[120px] bg-white dark:bg-dark-secondary border border-[#E3E5E6] text-sm sm:text-base text-title dark:text-white focus:border-primary p-3 sm:p-4 outline-none duration-300 resize-y"
                        placeholder="Please describe the issue (e.g., damaged item, wrong delivery)" wire:model="return_reason"></textarea>
                    @error('return_reason')
                        <div class="mt-1 text-xs text-red-600 sm:text-sm dark:text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-2">
                    <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-cancel="uploading = false"
                        x-on:livewire-upload-error="uploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <label
                            class="block mb-2 text-sm leading-none sm:mb-3 sm:text-base md:text-lg text-title dark:text-white">
                            Return Photos <span class="text-xs text-red-500 sm:text-sm dark:text-red-400">*</span>
                        </label>
                        <input type="file" wire:model="return_photos" accept=".png,.jpg,.jpeg,image/png,image/jpeg"
                            multiple>
                        <div x-show="uploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    @error('return_photos')
                        <div class="mt-1 text-xs text-red-600 sm:text-sm dark:text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                    @error('return_photos.*')
                        <div class="mt-1 text-xs text-red-600 sm:text-sm dark:text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="flex flex-wrap gap-2 mt-4 sm:gap-3 md:mt-6">
                    <button type="submit"
                        class="btn btn-sm sm:btn-md btn-theme-solid !text-white hover:!text-primary before:!z-[-1]"
                        wire:loading.attr="disabled" wire:target="processCheckout, payment_proof">
                        <p class="m-0" wire:loading.remove wire:target="processCheckout">
                            Submit Request
                        </p>
                        <p class="m-0" wire:loading wire:target="processCheckout">
                            Processing...
                        </p>
                    </button>
                </div>
        </form>

    </x-shop.section>
</div>
