<div class="flex-1 h-full max-w-6xl p-5 mx-auto overflow-hidden bg-background rounded-3xl shadow-xl dark:bg-gray-800">
    <div class="flex flex-col overflow-y-auto md:flex-row">
        <!-- Image Section -->
        <div class="h-32 md:h-auto md:w-1/2 sm:block">
            <img aria-hidden="true" class="object-fill w-full h-full dark:hidden" src="{{ asset('img/mg-store.png') }}" alt="MG Image" />
        </div>
        
        <!-- Form Section -->
        <div class="flex items-center justify-center p-6 sm:p-12 sm:w-full sm:max-w-none md:w-1/2 max-w-md mx-auto">
            <div class="w-full">
                <h1 class="mb-4 text-3xl font-semibold text-slate-700 flex justify-center">Login</h1>
                    <form wire:submit.prevent="save">
                        @csrf
                        <label class="block text-sm">
                            <span class="text-slate-700 font-bold">Username <span class="text-red-700">*</span></span>
                            <x-input class="appearance-none" wire:model="username" :placeholder="__('juandelacruz')"/>
                            @error('username') <x-input-error :messages="__($message)" /> @enderror
                        </label>
                        <!-- Password Input -->
                        <label class="block mt-4 text-sm">
                            <span class="text-slate-700 font-bold">Password <span class="text-red-700">*</span></span>
                            <x-input wire:model="password" :type="__('password')" :placeholder="__('***************')"/>
                            @error('password') <x-input-error :messages="__($message)" /> @enderror
                        </label>

                        <!-- Login Button -->
                        <x-button wire:click="save" :name="__('Log in')" />

                        <!-- Divider Line -->
                        <hr class="my-8 border-accent" />

                        <!-- Forgot Password Link -->
                        <p class="mt-2">
                            <a class="text-sm font-medium text-cta hover:underline" href="./forgot-password.html">
                                Forgot your password?
                            </a>
                        </p>
                </form>
            </div>
        </div>
    </div>
</div>
