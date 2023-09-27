<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="row">
            <div class="d-flex col-12 col-lg-6 justify-content-center">
                <img src="../img/mg-store.png" class="img-fluid i" alt="">
            </div>
            <div class="col-12 col-lg-6">
                <h2 class="text-center mb-3">Sign-in</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="email mb-3">
                        <label class="sr-only fw-500" for="signin-email">Email <span
                                class="text-danger">*</span></label>
                        <input id="email" name="email" type="email" class="form-control signin-email" placeholder="Email address">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="password mb-3">
                        <label class="sr-only fw-500" for="password">Password <span
                                class="text-danger">*</span></label>
                        <input id="password" name="password" type="password" class="form-control signin-password" placeholder="Password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="extra mt-3 row justify-content-between">
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="RememberPassword">
                                    <label class="form-check-label" for="RememberPassword"> Remember me </label>
                                </div>
                            </div>
                            <div class="col-6">
                                @if (Route::has('password.request'))
                                <div class="forgot-password text-end">
                                    <a class="text-body" href="{{ route('password.request') }}">
                                        {{ __('Forgot password?') }}
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn secondary-bg w-100 cta-color" wire:click="login">Log In</button>
                    </div>
                </form>
                <!-- Session Status -->
            </div>
        </div>
    </div>
    
</x-guest-layout>
