<div>
    <div class="flex">
        <div class="hidden w-1/2 md:block lg:flex-1">
            <img class="object-cover h-full" src="{{ asset('sites/img/bg-auth.jpg') }}" alt="register">
        </div>
        <div
            class="w-full md:w-1/2 lg:max-w-lg xl:max-w-3xl lg:w-full py-16 px-[20px] sm:px-8 lg:p-16 xl:p-24 relative z-10 flex items-center overflow-hidden">
            <form class="max-w-md mx-auto md:mx-0" wire:submit='register'>
                <h2 class="text-4xl font-bold leading-none">Create New Account</h2>
                <p class="text-lg mt-[15px]">
                    Buy & sale your exclusive product only on Furnixar
                </p>
                <div class="mt-7">
                    <label class="text-base sm:text-lg font-medium leading-none mb-2.5 block dark:text-white">
                        Name
                    </label>
                    <input
                        class="w-full h-12 p-4 duration-300 bg-white border outline-none md:h-14 dark:bg-transparent border-bdr-clr focus:border-primary"
                        type="text" placeholder="Enter your name" wire:model.lazy='name'>
                    @error('name')
                        <div class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-5">
                    <label class="text-base sm:text-lg font-medium leading-none mb-2.5 block dark:text-white">
                        Phone Number
                    </label>
                    <input
                        class="w-full h-12 p-4 duration-300 bg-white border outline-none md:h-14 dark:bg-transparent border-bdr-clr focus:border-primary"
                        type="tel" placeholder="Enter your phone number" wire:model.lazy='phone_number'>
                    @error('phone_number')
                        <div class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-5">
                    <label class="text-base sm:text-lg font-medium leading-none mb-2.5 block dark:text-white">
                        Email
                    </label>
                    <input
                        class="w-full h-12 p-4 duration-300 bg-white border outline-none md:h-14 dark:bg-transparent border-bdr-clr focus:border-primary"
                        type="email" placeholder="Enter your email address" wire:model.lazy='email'>
                    @error('email')
                        <div class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-5">
                    <label
                        class="text-base sm:text-lg font-medium leading-none mb-2.5 block dark:text-white">Password</label>
                    <input
                        class="w-full h-12 md:h-14 bg-white dark:bg-transparent border border-bdr-clr focus:border-primary p-4 outline-none duration-300 placeholder:text-xl placeholder:transform placeholder:translate-y-[10px]"
                        type="password" placeholder="* * * * * * * *" wire:model='password'>
                    @error('password')
                        <div class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-7">
                    <label class="flex items-center gap-2 iam-agree">
                        <input class="hidden appearance-none" type="checkbox" wire:model.lazy='remember_me'>
                        <span
                            class="w-[18px] h-[18px] rounded-[5px] border-2 border-title dark:border-white flex items-center justify-center duration-300">
                            <svg class="duration-300 opacity-0 fill-current text-title dark:text-white" width="9"
                                height="8" viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.05203 7.04122C2.87283 7.04122 2.69433 6.97322 2.5562 6.83864L0.532492 4.8553C0.253409 4.58189 0.249159 4.13351 0.522576 3.85372C0.796701 3.57393 1.24578 3.57039 1.52416 3.84309L3.05203 5.34122L7.61512 0.868804C7.89491 0.595387 8.34328 0.59822 8.6167 0.87872C8.89082 1.1578 8.88657 1.60689 8.60749 1.8803L3.54787 6.83864C3.40974 6.97322 3.23124 7.04122 3.05203 7.04122Z" />
                            </svg>
                        </span>
                        <span
                            class="text-base sm:text-lg text-title dark:text-white leading-none sm:leading-none select-none inline-block transform translate-y-[3px]">Remember
                            Me</span>
                    </label>
                    @error('remember_me')
                        <div class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-theme-solid mt-[15px]" data-text="Register">
                        <span>Register</span>
                    </button>
                </div>
                <p class="text-lg mt-[15px]">Already have an account ?
                    <a href="{{ route('auth.login') }}" class="inline-block ml-1 font-medium text-primary">Login</a>
                </p>
            </form>
        </div>
    </div>
</div>
