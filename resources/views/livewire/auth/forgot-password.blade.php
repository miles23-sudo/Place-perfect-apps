<div>
    <div class="flex">
        <div class="w-1/2 hidden md:block lg:flex-1">
            <img class="h-full object-cover" src="{{ asset('sites/img/bg-auth.jpg') }}" alt="forget password">
        </div>
        <div
            class="w-full md:w-1/2 lg:max-w-lg xl:max-w-3xl lg:w-full py-16 px-[20px] sm:px-8 lg:p-16 xl:p-24 relative z-10 flex items-center overflow-hidden">
            <form class="mx-auto md:mx-0 max-w-md" wire:submit='sendResetLink'>
                <h2 class="leading-none text-4xl font-bold">
                    Forgot Password
                </h2>
                <p class="text-lg mt-[15px]">
                    Don’t worry! Just enter your email address and we’ll send you a link to reset your password.
                </p>
                <div class="mt-7">
                    <label
                        class="text-base sm:text-lg font-medium leading-none mb-2.5 block dark:text-white">Email</label>
                    <input
                        class="w-full h-12 md:h-14 bg-white dark:bg-transparent border border-bdr-clr focus:border-primary p-4 outline-none duration-300"
                        type="email" placeholder="Enter your email address" wire:model.lazy="email">
                    @error('email')
                        <div class="mt-1 text-sm text-red-600 dark:text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit"
                    class="btn btn-theme-solid !text-white hover:!text-primary before:!z-[-1] mt-[15px]"
                    wire:loading.attr="disabled" wire:target="sendResetLink">
                    <p class="m-0" wire:loading.remove wire:target="sendResetLink">
                        Send Reset Link
                    </p>
                    <p class="m-0" wire:loading wire:target="sendResetLink">
                        Processing...
                    </p>
                </button>
                <p class="text-lg mt-[15px]">Remembered your password?
                    <a href="{{ route('auth.login') }}" class="inline-block ml-1 font-medium text-primary">Login</a>
                </p>
            </form>
        </div>
    </div>
</div>
