<div>
    <div class="flex">
        <div class="w-1/2 hidden md:block lg:flex-1">
            <img class="h-full object-cover" src="{{ asset('sites/img/bg-auth.jpg') }}" alt="forget password">
        </div>
        <div
            class="w-full md:w-1/2 lg:max-w-lg xl:max-w-3xl lg:w-full py-16 px-[20px] sm:px-8 lg:p-16 xl:p-24 relative z-10 flex items-center overflow-hidden">
            <form class="mx-auto md:mx-0 max-w-md" wire:submit='resetPassword'>
                <h2 class="leading-none text-4xl font-bold">
                    Reset Password
                </h2>
                <p class="text-lg mt-[15px]">
                    You are about to reset the password for <span class="font-medium">{{ $email }}</span>
                </p>
                <div class="w-full mt-7">
                    <label class="text-base sm:text-lg font-medium leading-none mb-2.5 block dark:text-white">New
                        Password</label>
                    <input
                        class="w-full h-12 md:h-14 bg-white dark:bg-transparent border border-bdr-clr focus:border-primary p-4 outline-none duration-300"
                        type="password" placeholder="Enter your new password" wire:model.lazy="new_password">
                    @error('new_password')
                        <div class="mt-1 text-sm text-red-600 dark:text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="w-full mt-7">
                    <label class="text-base sm:text-lg font-medium leading-none mb-2.5 block dark:text-white">Confirm
                        Password</label>
                    <input
                        class="w-full h-12 md:h-14 bg-white dark:bg-transparent border border-bdr-clr focus:border-primary p-4 outline-none duration-300"
                        type="password" placeholder="Confirm your new password" wire:model.lazy="confirm_password">
                    @error('confirm_password')
                        <div class="mt-1 text-sm text-red-600 dark:text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit"
                    class="btn btn-theme-solid !text-white hover:!text-primary before:!z-[-1] mt-[15px]"
                    wire:loading.attr="disabled" wire:target="resetPassword">
                    <p class="m-0" wire:loading.remove wire:target="resetPassword">
                        Reset Password
                    </p>
                    <p class="m-0" wire:loading wire:target="resetPassword">
                        Processing...
                    </p>
                </button>
            </form>
        </div>
    </div>
</div>
