<div>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row breadcrumb_box  align-items-center">
                        <div class="col-lg-6 col-md-6 col-sm-12 text-center text-md-start">
                            <h2 class="breadcrumb-title">
                                Register
                            </h2>
                        </div>
                        <div class="col-lg-6  col-md-6 col-sm-12">
                            <ul class="breadcrumb-list text-center text-md-end">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Register</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="login-register-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="pb-3">
                        <div class="h1 text-black fw-bold">
                            Sign Up
                        </div>
                        <div class="text-muted">
                            Create an account to enjoy a personalized shopping experience.
                        </div>
                    </div>
                    <div class="login-register-wrapper">
                        <div class="login-form-container">
                            <div class="login-register-form">
                                <form wire:submit="submit">
                                    <div class="mb-3">
                                        <input class="mb-1" type="text" placeholder="Name" wire:model="name" />
                                        @error('name')
                                            <span class="small text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input class="mb-1" type="email" placeholder="Email" wire:model="email" />
                                        @error('email')
                                            <span class="small text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input class="mb-1" type="password" placeholder="Password"
                                            wire:model="password" />
                                        @error('password')
                                            <span class="small text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <input class="mb-1" type="password" placeholder="Confirm Password"
                                            wire:model="password_confirmation" />
                                        @error('password_confirmation')
                                            <span class="small text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="button-box">
                                        <button type="submit">
                                            <span wire:loading.remove wire:target="submit">Continue to Register</span>
                                            <span wire:loading wire:target="submit">Registering...</span>
                                        </button>
                                        @session('message')
                                            <div class="mt-3 fw-bold text-black">
                                                {{ session('message') }}
                                            </div>
                                        @endsession

                                    </div>
                                    <div class="mt-3 d-flex flex-column space-x-2">
                                        <a href="{{ route('auth.login') }}">Already have an account? </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
